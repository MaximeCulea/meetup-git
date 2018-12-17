<?php
/*
 Plugin Name: Fix error reporting Strick Standars of WP
 Plugin URI: http://www.beapi.fr
 Description: Pass Error Reporting to E_STRICT
 Author: BeAPI
 Author URI: http://www.beapi.fr
 Version: 0.2

 ----
 Copyright 2015 Amaury Balmer (amaury@beapi.fr)
 ----
 */

if ( defined( 'WP_DEBUG' ) && true === constant( 'WP_DEBUG' ) ) {
	error_reporting( E_ALL ^ E_STRICT );
}
