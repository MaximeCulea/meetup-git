<?php

namespace BEA\ComposerInstaller;

use Composer\Composer;
use Composer\Installer\PackageEvent;
use Composer\Json\JsonFile;
use Composer\Package\CompletePackage;

class ManageRequiredPlugins {

	/**
	 * Add plugin install via composer to the .gitignore
	 *
	 * @param PackageEvent $event composer event
	 *
	 * @return bool
	 */
	public static function postPackageInstall( PackageEvent $event ) {

		$package = $event->getOperation()->getPackage();
		if( ! self::isAllowedPackageType( $package ) ) {
			return false;
		}

		$plugin_directory = self::getDirectoryType( $event->getComposer(), $package );
		if( empty( $plugin_directory ) ) {
			return false;
		}

		$plugin_name = self::getPluginName( $package );
		$gitignorePath = self::getGitignoreFile( $event->getComposer() );

		$rules = [];
		$rules[] = str_replace( '{$name}', $plugin_name, $plugin_directory );

		if ( self::findMarker( $gitignorePath, $plugin_name ) ) {
			return false;
		}

		return self::insertWithMarkers( $gitignorePath, $plugin_name, $rules );
	}

	/**
	 * Remove plugin install via composer to the .gitignore
	 *
	 * @param PackageEvent $event composer event
	 *
	 * @return bool
	 */
	public static function postPackageUninstall( PackageEvent $event ) {

		$package = $event->getOperation()->getPackage();
		if( ! self::isAllowedPackageType( $package ) ) {
			return false;
		}

		$plugin_name = self::getPluginName( $package );
		$gitignorePath = self::getGitignoreFile( $event->getComposer() );

		if ( ! self::findMarker( $gitignorePath, $plugin_name ) ) {
			return false;
		}

		return self::removeWithMarkers( $gitignorePath, $plugin_name );
	}

	/**
	 * Check if the current package's type is supported
	 *
	 * @param CompletePackage $package
	 *
	 * @return bool
	 */
	protected static function isAllowedPackageType( $package ) {
		return in_array( $package->getType(), self::getAllowedPackageTypes() );
	}

	/**
	 * Get a list of allowed package type.
	 *
	 * @return array
	 */
	protected static function getAllowedPackageTypes() {
		return [ 'wordpress-muplugin', 'wordpress-plugin', 'wordpress-theme' ];
	}

	/**
	 * Extract a plugin's name from a composer package
	 *
	 * @param CompletePackage $package
	 *
	 * @return string|bool
	 */
	protected static function getPluginName( $package ) {

		// Look first for custom name in extra
		$package_extra = $package->getExtra();
		if ( ! empty( $package_extra['installer-name'] ) ) {
			return $package_extra['installer-name'];
		}

		// Fallback to package's name
		$package_name = explode( '/', $package->getName() );
		if( ! is_array( $package_name ) || 2 > count( $package_name ) ) {
			return false;
		}

		return $package_name[1];
	}

	/**
	 * Get the directory name for the package's type
	 *
	 * @param Composer $composer composer event
	 * @param CompletePackage $package
	 *
	 * @return string|bool
	 */
	protected static function getDirectoryType( $composer, $package ) {
		$installerPaths = self::getInstallerPaths( $composer );
		return
			( ! empty( $installerPaths[ $package->getType() ] ) )
			? $installerPaths[ $package->getType() ]
			: false;
	}

	/**
	 * Get installer paths for WordPress packages.
	 *
	 * @param Composer $composer
	 *
	 * @return array
	 */
	protected static function getInstallerPaths( $composer ) {
		$defaultPaths = [
			'wordpress-theme' => 'content/themes/{$name}',
			'wordpress-plugin' => 'content/plugins/{$name}',
			'wordpress-muplugin' => 'content/mu-plugins/{$name}',
		];

		$composerFile = self::getComposerJsonFile( $composer )->read();
		if ( empty( $composerFile->extra['installer-paths'] ) ) {
			return $defaultPaths;
		}

		$paths = [];
		foreach ( $composerFile->extra['installer-paths'] as $path => $type ) {
			if ( is_array( $type ) ) {
				$type = reset( $type );
			}

			$type = str_replace( 'type:', '', $type );
			$paths[ $type ] = $path;
		}

		return array_merge( $defaultPaths, $paths );
	}

	/**
	 * Get the root composer file.
	 *
	 * @param Composer $composer
	 *
	 * @return JsonFile|bool
	 */
	protected static function getComposerJsonFile( $composer ) {
		$path = $composer->getConfig()->getConfigSource()->getName();
		if ( ! file_exists( $path ) ) {
			return false;
		}

		return new JsonFile( $path );
	}

	/**
	 * Get the .gitignore file path
	 *
	 * @param Composer $composer
	 *
	 * @return string
	 */
	protected static function getGitignoreFile( $composer ) {
		return dirname( $composer->getConfig()->get( 'vendor-dir' ) ) . '/.gitignore';
	}

	/**
	 * @param string $filename  file to insert to
	 * @param string $marker    delimiter marker
	 *
	 * @return bool
	 */
	protected static function findMarker( $filename, $marker ) {
		if ( ! file_exists( $filename ) ) {
			return false;
		}

		$lines = explode( "\n", implode( '', file( $filename ) ) );
		$marker = "# BEGIN {$marker} #";
		foreach ( $lines as $line ) {
			if ( false !== strpos( $line, $marker ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Insert lines of text into a file
	 *
	 * Extract from wp-admin/includes/misc.php L102
	 *
	 * @param string $filename  file to insert to
	 * @param string $marker    delimiter marker
	 * @param array  $insertion array of lines to insert to the file
	 *
	 * @return bool
	 */
	protected static function insertWithMarkers( $filename, $marker, $insertion ) {
		if (!file_exists( $filename ) || is_writeable( $filename ) ) {
			if (!file_exists( $filename ) ) {
				$markerdata = '';
			} else {
				$markerdata = explode( "\n", implode( '', file( $filename ) ) );
			}

			if ( !$f = @fopen( $filename, 'w' ) )
				return false;

			$foundit = false;
			if ( $markerdata ) {
				$state = true;
				foreach ( $markerdata as $n => $markerline ) {
					if (strpos($markerline, '# BEGIN ' . $marker . ' #') !== false)
						$state = false;
					if ( $state ) {
						if ( $n + 1 < count( $markerdata ) )
							fwrite( $f, "{$markerline}\n" );
						else
							fwrite( $f, "{$markerline}" );
					}
					if (strpos($markerline, '# END ' . $marker . ' #') !== false) {
						fwrite( $f, "# BEGIN {$marker} #\n" );
						if ( is_array( $insertion ))
							foreach ( $insertion as $insertline )
								fwrite( $f, "{$insertline}\n" );
						fwrite( $f, "# END {$marker} #\n" );
						$state = true;
						$foundit = true;
					}
				}
			}
			if (!$foundit) {
				fwrite( $f, "\n# BEGIN {$marker} #\n" );
				foreach ( $insertion as $insertline )
					fwrite( $f, "{$insertline}\n" );
				fwrite( $f, "# END {$marker} #\n" );
			}
			fclose( $f );
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Delete marker bloc from a file
	 *
	 * @param string $filename  file to delete from
	 * @param string $marker    delimiter marker
	 *
	 * @return bool
	 */
	protected static function removeWithMarkers( $filename, $marker ) {
		if (!file_exists( $filename ) || is_writeable( $filename ) ) {
			if (!file_exists( $filename ) ) {
				$markerdata = '';
			} else {
				$start = null;
				$end   = null;

				$markerdata = explode( "\n", implode( '', file( $filename ) ) );
				foreach ( $markerdata as $n => $markerline ) {
					if( false !== strpos($markerline, '# BEGIN ' . $marker . ' #') ) {
						$start = $n;
					}

					if( false !== strpos($markerline, '# END ' . $marker . ' #') ) {
						$end = $n;
						break;
					}
				}
			}

			if ( !$f = @fopen( $filename, 'w' ) )
				return false;

			$foundit = false;
			if ( $markerdata ) {
				foreach ( $markerdata as $n => $markerline ) {
					if( $n < $start || $n > $end ) {
						fwrite( $f, "{$markerline}\n" );
					}
				}
			}
			fclose( $f );
			return true;
		} else {
			return false;
		}
	}
}