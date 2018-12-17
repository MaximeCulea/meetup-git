<?php // BBQ Pro - Uninstall Remove Options

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

delete_option('bbq_options');
delete_option('bbq_patterns');
delete_option('bbq_license_key');
delete_option('bbq_license_status');
