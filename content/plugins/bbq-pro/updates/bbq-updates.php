<?php // BBQ Pro - License & Activation

if (!class_exists('EDD_SL_Plugin_Updater')) {
	include(BBQ_DIR .'updates/bbq-updater.php');
}

function bbq_plugin_updater() {
	
	$license_key = trim(get_option('bbq_license_key'));
	
	$edd_updater = new EDD_SL_Plugin_Updater(
		BBQ_HOME, 
		BBQ_FILE, 
		array(
			'license'   => $license_key,
			'item_name' => BBQ_NAME,
			'author'    => BBQ_AUTHOR,
			'version'   => BBQ_VERSION,
			'url'       => BBQ_HOME,
		)
	);
}
add_action('admin_init', 'bbq_plugin_updater', 0);



function bbq_display_license() {
	
	$license = get_option('bbq_license_key');
	$status  = get_option('bbq_license_status');
	
	?>
	
	<div class="wrap">
		
		<h1 class="bbq-title"><?php esc_html_e('BBQ Pro', 'bbq-pro'); ?> <span><?php echo BBQ_VERSION; ?></span></h1>
		
		<h2><?php esc_html_e('BBQ Pro License', 'bbq-pro'); ?></h2>
		
		<p>
			<?php echo esc_html__('Activate your license to enable BBQ Pro and free automatic updates.', 'bbq-pro'); ?> 
			<a id="bbq-toggle-steps" class="bbq-toggle-steps" href="#bbq-toggle-steps" title="<?php esc_attr_e('Show/hide instructions', 'bbq-pro'); ?>"><?php esc_html_e('View the steps&nbsp;&raquo;', 'bbq-pro'); ?></a>
		</p>
		<div class="bbq-license-steps bbq-toggle default-hidden">
			<p><?php esc_html_e('Follow these steps to activate your license:', 'bbq-pro'); ?></p>
			<ol>
				<li><a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/get-license-key/"><?php esc_html_e('Get your License Key', 'bbq-pro'); ?></a></li>
				<li><?php esc_html_e('Enter your license in the field, &ldquo;License Key&rdquo;', 'bbq-pro'); ?></li>
				<li><?php esc_html_e('Click &ldquo;Save Changes&rdquo;', 'bbq-pro'); ?></li>
				<li><?php esc_html_e('Click &ldquo;Activate License&rdquo;', 'bbq-pro'); ?></li>
			</ol>
			<p>
				<?php esc_html_e('If you need help,', 'bbq-pro'); ?> 
				<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/install-plugin/"><?php esc_html_e('check out this guide', 'bbq-pro'); ?></a> <?php esc_html_e('and/or', 'bbq-pro'); ?> 
				<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/get-license-key/#contact"><?php esc_html_e('contact us', 'bbq-pro'); ?></a>.
			</p>
		</div>
		
		<h3 class="bbq-activate-license"><?php esc_html_e('Activate License', 'bbq-pro'); ?></h3>
		
		<form method="post" action="options.php">
			
			<?php settings_fields('bbq_license_settings'); ?>
			
			<table class="form-table">
				<tbody>
					<?php if ($status === 'valid' || BBQ_CODE) : ?>
						
						<tr valign="top">
							<th scope="row" valign="top"><?php esc_html_e('License Key', 'bbq-pro'); ?></th>
							<td>
								<input id="bbq_license_key" name="bbq_license_key" type="hidden" value="<?php echo esc_attr($license); ?>" />
								<div class="bbq-license-activated">
									<code><?php echo esc_attr($license); ?></code><br /><small><?php esc_html_e('Your BBQ Pro License is active.', 'bbq-pro'); ?></small>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" valign="top"><?php esc_html_e('License Status', 'bbq-pro'); ?></th>
							<td>
								<input type="submit" class="button-secondary" name="bbq_license_deactivate" value="<?php esc_attr_e('Deactivate License', 'bbq-pro'); ?>" />
								<?php wp_nonce_field('bbq_license_nonce', 'bbq_license_nonce'); ?>
							</td>
						</tr>
						
					<?php else : ?>
						
						<?php if (empty($license)) : ?>
						
						<tr valign="top">
							<th scope="row" valign="top"><?php esc_html_e('License Key', 'bbq-pro'); ?></th>
							<td>
								<input id="bbq_license_key" name="bbq_license_key" type="text" class="regular-text" value="<?php echo esc_attr($license); ?>" /><br />
								<small><label class="description" for="bbq_license_key"><?php esc_html_e('Enter your License Key', 'bbq-pro'); ?></label></small>
							</td>
						</tr>
						
						<?php else : ?>
						
						<tr valign="top">
							<th scope="row" valign="top"><?php esc_html_e('License Key', 'bbq-pro'); ?></th>
							<td>
								<input id="bbq_license_key" name="bbq_license_key" type="text" class="regular-text" value="<?php echo esc_attr($license); ?>" /><br />
								<div class="bbq-license-deactivated">
									<small><label class="description" for="bbq_license_key"><?php esc_html_e('Your license is inactive. To activate, click &ldquo;Activate License&rdquo;', 'bbq-pro'); ?></label></small>
								</div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row" valign="top"><?php esc_html_e('License Status', 'bbq-pro'); ?></th>
							<td>
								<input type="submit" class="button-secondary" name="bbq_license_activate" value="<?php esc_attr_e('Activate License', 'bbq-pro'); ?>" />
								<?php wp_nonce_field('bbq_license_nonce', 'bbq_license_nonce'); ?>
							</td>
						</tr>
						
						<?php endif; ?>
						
					<?php endif; ?>
				</tbody>
			</table>
			
			<?php submit_button(); ?>
			
			<p><a href="<?php echo admin_url('admin.php?page=bbq_settings'); ?>"><?php esc_html_e('Visit BBQ Pro Settings &raquo;', 'bbq-pro'); ?></a></p>
		</form>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('.default-hidden').hide();
				$('.bbq-toggle-steps').click(function(e){ e.preventDefault(); $('.bbq-license-steps').slideToggle(300); });
			});
		</script>
		
	<?php 
}



function bbq_license_admin_notice() {
	
	$screen = get_current_screen();
	
	if ($screen->id === 'bbq-pro_page_bbq_license') {
		
		if (isset($_GET['settings-updated'])) { 
			
			if ($_GET['settings-updated']) : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Updated!', 'bbq-pro'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made.', 'bbq-pro'); ?></strong></p></div>
				
			<?php endif;
		}
	}
}
add_action('admin_notices', 'bbq_license_admin_notice');



function bbq_license_register_option() {
	register_setting('bbq_license_settings', 'bbq_license_key', 'bbq_sanitize_option');
}
add_action('admin_init', 'bbq_license_register_option');



function bbq_sanitize_option($new) {
	$old = get_option('bbq_license_key');
	if ($old && $old != $new) delete_option('bbq_license_status');
	return $new;
}



function bbq_activate_license() {
	if (isset($_POST['bbq_license_activate'])) {
	 	if (!check_admin_referer('bbq_license_nonce', 'bbq_license_nonce')) return;
		
		$license = trim(get_option('bbq_license_key'));
		$api_params = array('edd_action' => 'activate_license', 'license' => $license, 'item_name' => urlencode(BBQ_NAME));
		
		$add_args = add_query_arg($api_params, BBQ_HOME);
		$response = wp_remote_get(esc_url_raw($add_args), array('timeout' => 15, 'sslverify' => false));
		
		if (is_wp_error($response)) return false;
		
		$license_data = json_decode(wp_remote_retrieve_body($response));
		update_option('bbq_license_status', $license_data->license);
	}
}
add_action('admin_init', 'bbq_activate_license');



function bbq_deactivate_license() {
	if (isset($_POST['bbq_license_deactivate'])) {
	 	if (!check_admin_referer('bbq_license_nonce', 'bbq_license_nonce')) return;
		
		$license = trim(get_option('bbq_license_key'));
		$api_params = array('edd_action' => 'deactivate_license', 'license' => $license, 'item_name' => urlencode(BBQ_NAME));
		
		$add_args = add_query_arg($api_params, BBQ_HOME);
		$response = wp_remote_get(esc_url_raw($add_args), array('timeout' => 15, 'sslverify' => false));
		
		if (is_wp_error($response)) return false;
		
		$license_data = json_decode(wp_remote_retrieve_body($response));
		if ($license_data->license == 'deactivated') delete_option('bbq_license_status');
	}
}
add_action('admin_init', 'bbq_deactivate_license');



function bbq_check_license() {
	$license = get_option('bbq_license_key');
	$api_params = array( 
		'edd_action' => 'check_license', 
		'license'    => $license, 
		'item_name'  => urlencode(BBQ_NAME) 
	);
	
	$add_args = add_query_arg($api_params, BBQ_HOME);
	$response = wp_remote_get(esc_url_raw($add_args), array('timeout' => 15, 'sslverify' => false));
	
	if (is_wp_error($response)) return false;
	
	$license_data = json_decode(wp_remote_retrieve_body($response));
	if ($license_data->license == 'valid') {
		set_transient('license_status', 'valid', 60 * 60 * 24);
	} else {
		set_transient('license_status', 'invalid', 60 * 60 * 24);
	}
	$license_status = get_transient('license_status');
	return $license_status;
	exit;
}


