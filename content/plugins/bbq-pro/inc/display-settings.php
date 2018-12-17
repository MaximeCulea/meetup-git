<?php // BBQ Pro - Display Settings

if (!defined('ABSPATH')) exit;

function bbq_action_links($links, $file) {
	if ($file == BBQ_FILE) {
		$bbq_links = '<a href="'. get_admin_url() .'admin.php?page=bbq_settings">'. esc_html__('Settings', 'bbq-pro') .'</a>';
		array_unshift($links, $bbq_links);
	}
	return $links;
}

function bbq_menu_pages() {
	
	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page(esc_html__('BBQ Pro', 'bbq-pro'), esc_html__('BBQ Pro', 'bbq-pro'), 'manage_options', 'bbq_settings', 'bbq_display_settings', 'dashicons-admin-generic'); // avoid duplicate menu item: menu function = submenu function
	
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	add_submenu_page('bbq_settings', esc_html__('Settings', 'bbq-pro'), esc_html__('Settings', 'bbq-pro'), 'manage_options', 'bbq_settings', 'bbq_display_settings'); // avoid duplicate menu item: parent slug = menu slug
	add_submenu_page('bbq_settings', esc_html__('Firewall', 'bbq-pro'), esc_html__('Firewall', 'bbq-pro'), 'manage_options', 'bbq_patterns', 'bbq_display_patterns');
	add_submenu_page('bbq_settings', esc_html__('Tools',    'bbq-pro'), esc_html__('Tools',    'bbq-pro'), 'manage_options', 'bbq_tools',    'bbq_display_tools');
	add_submenu_page('bbq_settings', esc_html__('License',  'bbq-pro'), esc_html__('License',  'bbq-pro'), 'manage_options', 'bbq_license',  'bbq_display_license');
}

function bbq_display_settings() { 
	
	$status = get_option('bbq_license_status'); 
	
	?>
	
	<div class="wrap">
		<h1 class="bbq-title"><?php esc_html_e('BBQ Pro', 'bbq-pro'); ?> <span><?php echo BBQ_VERSION; ?></span></h1>
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			
			<?php if ($status === 'valid' || BBQ_CODE) :
			
			settings_fields('bbq_options');
			do_settings_sections('bbq_options');
			submit_button();
			
			else : ?>
			
			<h2><?php esc_html_e('Welcome to BBQ Pro!', 'bbq-pro'); ?></h2>
			<p class="intro"><a href="<?php echo admin_url('admin.php?page=bbq_license'); ?>"><?php esc_html_e('Enter your License Key to enable BBQ Pro &raquo;', 'bbq-pro'); ?></a></p>
			
			<?php endif; ?>
			
		</form>
	</div>
	
<?php }


