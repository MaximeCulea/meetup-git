<?php
/*
	Plugin Name: BBQ Pro
	Plugin URI: https://plugin-planet.com/bbq-pro/
	Description: The fastest WordPress firewall plugin. Advanced protection against malicious requests.
	Tags: security, protect, firewall, php, eval, malicious, url, request, blacklist
	Author: Jeff Starr
	Contributors: specialk
	Author URI: https://plugin-planet.com/
	Donate link: https://monzillamedia.com/donate.html
	Requires at least: 4.1
	Tested up to: 4.9
	Stable tag: 2.1
	Version: 2.1
	Requires PHP: 5.2
	Text Domain: bbq-pro
	Domain Path: /languages
	
	License: The BBQ Pro license is comprised of two parts:
	
		* Part 1: Its PHP code is licensed under the GPL (v2 or later), like WordPress. More info @ http://www.gnu.org/licenses/
	
		* Part 2: Everything else (e.g., CSS, HTML, JavaScript, images, design) is licensed according to the purchased license. More info @ https://plugin-planet.com/bbq-pro/
	
	Without prior written consent from Monzilla Media, you must NOT directly or indirectly: license, sub-license, sell, resell, or provide for free any aspect or component of Part 2.
	
	Further license information is available in the plugin directory, /license/, and online @ https://plugin-planet.com/wp/files/bbq-pro/license.txt
	
	Upgrades: Your purchase of BBQ Pro includes free lifetime upgrades, which include new features, bug fixes, and other improvements. 
	
	Copyright 2018 Monzilla Media. All rights reserved.
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('BBQ_Pro')) {
	
	final class BBQ_Pro {
		
		private static $instance;
		
		public static function instance() {
			if (!isset(self::$instance) && !(self::$instance instanceof BBQ_Pro)) {
				
				self::$instance = new BBQ_Pro;
				self::$instance->constants();
				self::$instance->includes();
				
				add_action('admin_init',     array(self::$instance, 'check_bbq'));
				add_action('admin_init',     array(self::$instance, 'check_version'));
				add_action('plugins_loaded', array(self::$instance, 'load_i18n'));
				
				add_filter('plugin_action_links', 'bbq_action_links', 10, 2);
				
				add_action('admin_enqueue_scripts', 'bbq_enqueue_resources_admin');
				add_action('admin_print_scripts', 'bbq_print_js_vars_admin');
				
				add_action('admin_init', 'bbq_update_patterns');
				add_action('admin_init', 'bbq_register_settings');
				add_action('admin_init', 'bbq_reset_defaults');
				add_action('admin_menu', 'bbq_menu_pages');
				
			}
			return self::$instance;
		}
		
		public static function options() {
			
			$ip_server = isset($_SERVER['SERVER_ADDR']) ? sanitize_text_field($_SERVER['SERVER_ADDR']) : '';
			$ip_remote = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';
			
			$bbq_options = array(
				'basic_rules'     => true,
				'advanced_rules'  => false,
				'custom_rules'    => false,
				'logged_users'    => false,
				'limit_request'   => false,
				'strict_mode'     => false,
				'redirect_url'    => '',
				'custom_message'  => '403 Forbidden',
				'status_code'     => '403 Forbidden',
				'remove_disabled' => false,
				'whitelist_ips'   => self::default_ips(),
			);
			
			return apply_filters('bbq_options', $bbq_options);
			
		}
		
		public static function default_ips() {
			
			$ip_server = isset($_SERVER['SERVER_ADDR']) ? sanitize_text_field($_SERVER['SERVER_ADDR']) : '';
			$ip_remote = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';
			
			$ip_securi = '162.216.19.183';
			$ip_wprocket = '167.114.255.163, 167.114.238.112, 167.114.236.135, 167.114.234.234';
			
			$ips = $ip_server .', '. $ip_remote .', '. $ip_securi .', '. $ip_wprocket;
			
			return apply_filters('banhammer_default_ips', $ips);
			
		}
		
		public static function patterns() {
			require_once plugin_dir_path(__FILE__) .'inc/bbq-patterns.php';
			return apply_filters('bbq_patterns', bbq_patterns());
		}
		
		private function constants() {
			if (!defined('BBQ_REQUIRE')) define('BBQ_REQUIRE', '4.1');
			if (!defined('BBQ_VERSION')) define('BBQ_VERSION', '2.1');
			if (!defined('BBQ_NAME'))    define('BBQ_NAME',    'BBQ Pro');
			if (!defined('BBQ_AUTHOR'))  define('BBQ_AUTHOR',  'Jeff Starr');
			if (!defined('BBQ_HOME'))    define('BBQ_HOME',    'https://plugin-planet.com');
			if (!defined('BBQ_CODE'))    define('BBQ_CODE',    false);
			
			if (!defined('BBQ_URL'))     define('BBQ_URL',     plugin_dir_url(__FILE__));
			if (!defined('BBQ_DIR'))     define('BBQ_DIR',     plugin_dir_path(__FILE__));
			if (!defined('BBQ_FILE'))    define('BBQ_FILE',    plugin_basename(__FILE__));
			if (!defined('BBQ_SLUG'))    define('BBQ_SLUG',    basename(dirname(__FILE__)));
		}
		
		private function includes() {
			require_once BBQ_DIR .'inc/enqueue-resources.php';
			require_once BBQ_DIR .'inc/register-settings.php';
			require_once BBQ_DIR .'inc/display-settings.php';
			require_once BBQ_DIR .'inc/display-patterns.php';
			require_once BBQ_DIR .'inc/display-tools.php';
			require_once BBQ_DIR .'updates/bbq-updates.php';
			require_once BBQ_DIR .'inc/contextual-help.php';
			require_once BBQ_DIR .'inc/status-codes.php';
		}
		
		public function check_bbq() {
			if (function_exists('bbq_core')) {
				if (is_plugin_active(BBQ_FILE)) {
					deactivate_plugins(BBQ_FILE);
					$msg  = '<strong>'. BBQ_NAME .'</strong> '. esc_html__('should not be run with the free version of BBQ (there is no need for both plugins). ', 'bbq-pro');
					$msg .= esc_html__('Please return to the', 'bbq-pro') .' <a href="'. admin_url('plugins.php') .'">'. esc_html__('WP Admin Area', 'bbq-pro') .'</a> '. esc_html__('to deactivate the free version and try again.', 'bbq-pro');
					wp_die($msg);
				}
			}
		}
		
		public function check_version() {
			$wp_version = get_bloginfo('version');
			if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
				if (version_compare($wp_version, BBQ_REQUIRE, '<')) {
					if (is_plugin_active(BBQ_FILE)) {
						deactivate_plugins(BBQ_FILE);
						$msg  = '<strong>'. BBQ_NAME .'</strong> '. esc_html__('requires WordPress ', 'bbq-pro') . BBQ_REQUIRE . esc_html__(' or higher, and has been deactivated. ', 'bbq-pro');
						$msg .= esc_html__('Please return to the', 'bbq-pro') .' <a href="'. admin_url('update-core.php') .'">'. esc_html__('WP Admin Area', 'bbq-pro') .'</a> '. esc_html__('to upgrade WordPress and try again.', 'bbq-pro');
						wp_die($msg);
					}
				}
			}
		}
		
		public function load_i18n() {
			
			$domain = 'bbq-pro';
			
			$locale = apply_filters('bbq_i18n_locale', get_locale(), $domain);
			
			$dir    = trailingslashit(WP_LANG_DIR);
			
			$file   = $domain .'-'. $locale .'.mo';
			
			$path_1 = $dir . $file;
			
			$path_2 = $dir . $domain .'/'. $file;
			
			$path_3 = $dir .'plugins/'. $file;
			
			$path_4 = $dir .'plugins/'. $domain .'/'. $file;
			
			$paths = array($path_1, $path_2, $path_3, $path_4);
			
			foreach ($paths as $path) {
				
				if ($loaded = load_textdomain($domain, $path)) {
					
					return $loaded;
					
				} else {
					
					return load_plugin_textdomain($domain, false, BBQ_SLUG .'/languages');
					
				}
				
			}
			
		}
		
		public function __clone() {
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'bbq-pro'), BBQ_VERSION);
		}
		
		public function __wakeup() {
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'bbq-pro'), BBQ_VERSION);
		}
		
	}
}

if (class_exists('BBQ_Pro')) {
	
	$bbq_options  = get_option('bbq_options',  BBQ_Pro::options());
	$bbq_patterns = get_option('bbq_patterns', BBQ_Pro::patterns());
	
	$bbq_options  = apply_filters('bbq_get_options',  $bbq_options);
	$bbq_patterns = apply_filters('bbq_get_patterns', $bbq_patterns);
	
	if (!function_exists('bbq_pro')) {
		
		function bbq_pro() {
			
			if (is_admin()) return BBQ_Pro::instance();
		}
	}
	
	bbq_pro();
	
}

if (
	(isset($bbq_options['basic_rules'])    && $bbq_options['basic_rules']) || 
	(isset($bbq_options['advanced_rules']) && $bbq_options['advanced_rules']) || 
	(isset($bbq_options['custom_rules'])   && $bbq_options['custom_rules'])) {
	
	if (!is_admin() || (is_admin() && !$bbq_options['logged_users'])) {
		
		require_once plugin_dir_path(__FILE__) .'inc/bbq-core.php';
		
	}
}

if (class_exists('BBQ_Core')) {
	
	if (!function_exists('bbq__core')) {
		
		function bbq__core() {
			
			return BBQ_Core::instance();
			
		}
	}
	
	bbq__core();
	
}


