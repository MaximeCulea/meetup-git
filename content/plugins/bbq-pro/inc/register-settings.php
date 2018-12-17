<?php // BBQ Pro - Register Settings

if (!defined('ABSPATH')) exit;

function bbq_register_settings() {
	
	// register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting('bbq_options', 'bbq_options', 'bbq_validate_options');
	
	// add_settings_section( $id, $title, $callback, $page ); 
	add_settings_section('general_settings', esc_html__('Grillin&rsquo; &amp; Chillin&rsquo;', 'bbq-pro'), 'bbq_callback_general', 'bbq_options');
	
	// add_settings_field( $id, $title, $callback, $page, $section, $args );
	add_settings_field('basic_rules',     esc_html__('Basic Rules',    'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'basic_rules',     'label' => esc_html__('Enable BBQ&rsquo;s Basic Rules', 'bbq-pro')));
	add_settings_field('advanced_rules',  esc_html__('Advanced Rules', 'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'advanced_rules',  'label' => esc_html__('Enable BBQ&rsquo;s Advanced Rules', 'bbq-pro')));
	add_settings_field('custom_rules',    esc_html__('Custom Rules',   'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'custom_rules',    'label' => esc_html__('Enable BBQ&rsquo;s Custom Rules', 'bbq-pro')));
	
	add_settings_field('logged_users',    esc_html__('Logged-in Users', 'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'logged_users',    'label' => esc_html__('Disable BBQ for logged-in users', 'bbq-pro')));
	add_settings_field('limit_request',   esc_html__('Limit Requests',  'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'limit_request',   'label' => esc_html__('Limit URL requests to 255 characters', 'bbq-pro')));
	add_settings_field('strict_mode',     esc_html__('Strict Mode',     'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'strict_mode',     'label' => esc_html__('Enable Strict Mode (see Help tab for details)', 'bbq-pro')));
	
	add_settings_field('redirect_url',    esc_html__('Redirect URL',   'bbq-pro'), 'bbq_callback_text',     'bbq_options', 'general_settings', array('id' => 'redirect_url',    'label' => esc_html__('Redirect URL (leave blank for no redirect)', 'bbq-pro')));
	add_settings_field('custom_message',  esc_html__('Custom Message', 'bbq-pro'), 'bbq_callback_textarea', 'bbq_options', 'general_settings', array('id' => 'custom_message',  'label' => esc_html__('Custom Message (leave blank for no message)', 'bbq-pro')));
	add_settings_field('status_code',     esc_html__('Status Code',    'bbq-pro'), 'bbq_callback_select',   'bbq_options', 'general_settings', array('id' => 'status_code',     'label' => esc_html__('Status code', 'bbq-pro')));
	
	add_settings_field('remove_disabled', esc_html__('Remove Disabled', 'bbq-pro'), 'bbq_callback_checkbox', 'bbq_options', 'general_settings', array('id' => 'remove_disabled', 'label' => esc_html__('Remove disabled patterns', 'bbq-pro')));
	add_settings_field('whitelist_ips',   esc_html__('Whitelist IPs',   'bbq-pro'), 'bbq_callback_textarea', 'bbq_options', 'general_settings', array('id' => 'whitelist_ips',   'label' => esc_html__('IPs that never should be blocked (comma separated)', 'bbq-pro')));

}

function bbq_callback_general() {
	
	echo '<p>'. esc_html__('Thanks for using', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/bbq-pro/">'. esc_html__('BBQ Pro', 'bbq-pro') .'</a>. ';
	echo esc_html__('Visit the', 'bbq-pro') .' <strong>'. esc_html__('Help', 'bbq-pro') .'</strong> '. esc_html__('tab above for complete documentation.', 'bbq-pro') .'</p>';
	echo bbq_check_enabled();
}

function bbq_check_enabled() {
	
	global $bbq_options, $bbq_patterns;
	
	$enable = false;
	$class  = 'bbq-disabled';
	$status = esc_html__('BBQ is Disabled', 'bbq-pro');
	
	if (
		(isset($bbq_options['basic_rules'])    && $bbq_options['basic_rules']) || 
		(isset($bbq_options['advanced_rules']) && $bbq_options['advanced_rules']) || 
		(isset($bbq_options['custom_rules'])   && $bbq_options['custom_rules'])) {
		
		if (!empty($bbq_patterns)) {
			
			foreach ($bbq_patterns as $key => $value) {
				
				foreach ($value as $k => $v) {
					
					foreach ($v as $id => $array) {
						
						if ($bbq_options[$key.'_rules'] && isset($array['enable']) && $array['enable']) {
							
							$enable = true;
							break 3;
						}
					}
				}
			}
		}
	}
	
	if ($enable) {
		
		$class  = 'bbq-enabled';
		$status = esc_html__('BBQ is Enabled', 'bbq-pro');
	}
	
	return '<div class="bbq-status '. $class .'">'. $status .'</div>';
}

function bbq_validate_options($input) {
	global $bbq_options;
	
	$allowed_tags = wp_kses_allowed_html('post');
	
	if (!isset($input['basic_rules'])) $input['basic_rules'] = null;
	$input['basic_rules'] = ($input['basic_rules'] == 1 ? 1 : 0);
	
	if (!isset($input['advanced_rules'])) $input['advanced_rules'] = null;
	$input['advanced_rules'] = ($input['advanced_rules'] == 1 ? 1 : 0);
	
	if (!isset($input['custom_rules'])) $input['custom_rules'] = null;
	$input['custom_rules'] = ($input['custom_rules'] == 1 ? 1 : 0);
	
	if (!isset($input['logged_users'])) $input['logged_users'] = null;
	$input['logged_users'] = ($input['logged_users'] == 1 ? 1 : 0);
	
	if (!isset($input['limit_request'])) $input['limit_request'] = null;
	$input['limit_request'] = ($input['limit_request'] == 1 ? 1 : 0);
	
	if (!isset($input['strict_mode'])) $input['strict_mode'] = null;
	$input['strict_mode'] = ($input['strict_mode'] == 1 ? 1 : 0);
	
	if (isset($input['redirect_url'])) $input['redirect_url'] = esc_url($input['redirect_url']);
	
	if (isset($input['custom_message'])) $input['custom_message'] = wp_kses(stripslashes_deep($input['custom_message']), $allowed_tags);
	
	$status_codes = bbq_status_codes();
	if (!isset($input['status_code'])) $input['status_code'] = null;
	if (!in_array($input['status_code'], $status_codes)) $input['status_code'] = null;
	
	if (!isset($input['remove_disabled'])) $input['remove_disabled'] = null;
	$input['remove_disabled'] = ($input['remove_disabled'] == 1 ? 1 : 0);
	
	if (isset($input['whitelist_ips'])) $input['whitelist_ips'] = esc_textarea($input['whitelist_ips']);
	
	return $input;
}

function bbq_callback_text($args) {
	global $bbq_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbq_options[$id]) ? sanitize_text_field($bbq_options[$id]) : '';
	
	echo '<input class="regular-text" name="bbq_options['. $id .']" type="text" size="40" value="'. $value .'" />';
	echo '<label class="bbq-label" for="bbq_options['. $id .']">'. $label .'</label>';
}

function bbq_callback_textarea($args) {
	global $bbq_options;
	
	$allowed_tags = wp_kses_allowed_html('post');
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbq_options[$id]) ? wp_kses(stripslashes_deep($bbq_options[$id]), $allowed_tags) : '';
	
	echo '<textarea name="bbq_options['. $id .']" rows="3" cols="50">'. $value .'</textarea>';
	echo '<label class="bbq-label" for="bbq_options['. $id .']">'. $label .'</label>';
}

function bbq_callback_checkbox($args) {
	global $bbq_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$checked = isset($bbq_options[$id]) ? checked($bbq_options[$id], 1, false) : '';
	
	echo '<input name="bbq_options['. $id .']" type="checkbox" value="1" '. $checked .' /> ';
	echo '<label class="bbq-label inline-block" for="bbq_options['. $id .']">'. $label .'</label>';
}

function bbq_callback_select($args) {
	global $bbq_options;
	
	$status_codes = bbq_status_codes();
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($bbq_options[$id]) ? sanitize_text_field($bbq_options[$id]) : '';
	
	echo '<select name="bbq_options['. $id .']">';
	
	foreach ($status_codes as $code) {
		echo '<option '. selected($code, $value, false) .' value="'. $code .'">'. $code .'</option>';
	}
	echo '</select><label class="bbq-label inline-block padding-left" for="bbq_options['. $id .']">'. $label .'</label>';
}


