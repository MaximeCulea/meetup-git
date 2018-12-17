<?php // BBQ Pro - Display Patterns

if (!defined('ABSPATH')) exit;

function bbq_patterns_tabs() {
	
	$tabs = array(
		'basic'    => esc_html__('Basic', 'bbq-pro'),
		'advanced' => esc_html__('Advanced', 'bbq-pro'),
		'custom'   => esc_html__('Custom', 'bbq-pro'),
	);
	
	return apply_filters('bbq_patterns_tabs', $tabs);
}

function bbq_display_patterns() {
	
	$status = get_option('bbq_license_status');
	
	$active_tab = isset($_GET['tab']) && array_key_exists($_GET['tab'], bbq_patterns_tabs()) ? $_GET['tab'] : 'basic'; ?>
	
	<div class="wrap">
		
		<h1 class="bbq-title"><?php esc_html_e('BBQ Pro', 'bbq-pro'); ?> <span><?php echo BBQ_VERSION; ?></span></h1>
		
		<?php if ($status === 'valid' || BBQ_CODE) : ?>
		
		<h2 class="nav-tab-wrapper">
			<?php foreach (bbq_patterns_tabs() as $tab_id => $tab_name) {
				
				$tab_url = add_query_arg(array('settings-updated' => false, 'tab' => $tab_id));
				
				$active = $active_tab == $tab_id ? ' nav-tab-active' : '';
				
				echo '<a href="'. esc_url($tab_url) .'" title="'. esc_attr($tab_name) .'" class="nav-tab'. $active .'">'. esc_html($tab_name) .'</a>';
			} ?>
		</h2>
		
		<p class="bbq-intro-text">
			
			<a class="bbq-toggle-all" href="#"><?php esc_html_e('Toggle all panels', 'bbq-pro'); ?></a>. 
			
			<?php echo esc_html__('Visit the', 'bbq-pro') .' <strong>'. esc_html__('Help', 'bbq-pro') .'</strong> '. esc_html__('tab above for complete documentation.', 'bbq-pro'); ?>
		</p>
		
		<form method="post" action="">
			
			<?php bbq_get_patterns($active_tab); ?>
			
			<?php wp_nonce_field('bbq-update-patterns', 'bbq-update-patterns', false); ?>
			
			<input class="button button-primary bbq-submit-button" type="submit" value="<?php esc_attr_e('Save Changes', 'bbq-pro'); ?>" />
		</form>
		
		<?php else : ?>
		
		<h2><?php esc_html_e('Welcome to BBQ Pro!', 'bbq-pro'); ?></h2>
		<p class="intro"><a href="<?php echo admin_url('admin.php?page=bbq_license'); ?>"><?php esc_html_e('Enter your License Key to enable BBQ Pro &raquo;', 'bbq-pro'); ?></a></p>
		
		<?php endif; ?>
		
	</div>
<?php
}

function bbq_get_patterns($active_tab) {
	global $bbq_patterns; 
	
	foreach ($bbq_patterns as $key => $value) {
		
		if ($active_tab !== $key) continue;
		
		foreach ($value as $k => $v) : 
			
			if (empty($v) && $key !== 'custom') continue; ?>
			
			<div class="metabox-holder">
				<div class="bbq-section postbox">
					
					<h3><?php bbq_section_name($k); bbq_active_count($v, $active_tab); ?></h3>
					
					<div class="bbq-toggle">
						
						<table class="bbq-patterns bbq-patterns-<?php echo $k; ?> bbq-patterns-<?php echo $active_tab; ?>">
							
							<?php bbq_list_header($k, $v); 
							
							$v = array_values($v);
							
							$i = 1; $n = count($v); $clone = false; 
							
							if (!empty($v)) {
								
								foreach ($v as $id => $item) { 
									
									$enable = false; $count = 0; $pattern = ''; 
									
									if (isset($item['enable']))  $enable  = (bool) $item['enable'];
									if (isset($item['count']))   $count   = (int) $item['count'];
									if (isset($item['pattern'])) $pattern = htmlentities($item['pattern'], ENT_QUOTES, get_option('blog_charset', 'UTF-8'));
									
									if (!$clone && $i === $n && $key === 'custom') { 
										
										bbq_clone_markup($active_tab, $k, $i);
										$clone = true; 
									} ?>
									
									<tr>
										<td><input type="checkbox" name="<?php echo $active_tab .'['. $k .']['. $id .'][enable]'; ?>" <?php checked($enable); ?> value="1" class="bbq-enable" /></td>
										
										<td><input type="text" size="30" name="<?php echo $active_tab .'['. $k .']['. $id .'][pattern]'; ?>" value="<?php echo $pattern; ?>" class="bbq-pattern" /></td>
										
										<?php bbq_pattern_test($k, $pattern); ?>
										
										<td><input type="text" size="30" name="<?php echo $active_tab .'['. $k .']['. $id .'][count]'; ?>" value="<?php echo $count; ?>" class="bbq-count <?php bbq_count_class($count); ?>" /></td>
									</tr>
									
								<?php $i++; 
								}
								
							} else {
								
								if ($key === 'custom') bbq_clone_markup($active_tab, $k, $i);
							} ?>
						
						</table>
						
						<?php if ($key == 'custom') : ?>
						<button class="bbq-add-field button button-secondary" data-type="<?php echo $k; ?>"><?php esc_html_e('Add Pattern', 'bbq-pro'); ?></button>
						<?php endif; ?>
					
					</div>
					
				</div>
			</div>
			
		<?php endforeach;
		
	}
}

function bbq_update_patterns() {
	global $bbq_patterns, $bbq_options;
	
	if (isset($_POST['bbq-update-patterns']) && wp_verify_nonce($_POST['bbq-update-patterns'], 'bbq-update-patterns')) {
		
		if (!current_user_can('manage_options')) exit;
		
		foreach ($_POST as $type => $array) {
			
			if (strpos($type, 'bbq-update-patterns') !== false) {
				
				$nonce = $_POST[$type];
				
				unset($_POST[$type]);
				
			}
			
			if (is_array($array)) {
				
				foreach ($array as $key => $value) {
					
					foreach ($value as $k => $v) {
						
						if ($k === 'bbqid') {
							
							unset($_POST[$type][$key][$k]);
							
						}
					}
					
					if (isset($bbq_options['remove_disabled']) && $bbq_options['remove_disabled']) {
						
						foreach ($value as $k => $v) {
							
							if (!isset($v['enable']) || !$v['enable'] || empty($v['pattern'])) {
								
								unset($_POST[$type][$key][$k]);
							}
						}
					}
				}
			}
		}
		
		$bbq_patterns = array_merge($bbq_patterns, stripslashes_deep($_POST));
		
		$success = update_option('bbq_patterns', $bbq_patterns, true);
		
		$_POST['bbq-update-patterns'] = (isset($nonce) && !empty($nonce)) ? $nonce : '';
	}
}



function bbq_patterns_admin_notice() {
	
	$screen = get_current_screen();
	
	if ($screen->id === 'bbq-pro_page_bbq_patterns') {
		
		if (isset($_POST['bbq-update-patterns'])) {
			
			if (wp_verify_nonce($_POST['bbq-update-patterns'], 'bbq-update-patterns')) : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('BBQ Patterns updated successfully.', 'bbq-pro'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made.', 'bbq-pro'); ?></strong></p></div>
				
			<?php endif;
		}
	}
}
add_action('admin_notices', 'bbq_patterns_admin_notice');



function bbq_section_name($k) {
	
	if ($k == 'query_string') $section = esc_html__('Query String', 'bbq-pro');
	if ($k == 'request_uri')  $section = esc_html__('Request URI', 'bbq-pro');
	if ($k == 'user_agent')   $section = esc_html__('User Agent', 'bbq-pro');
	if ($k == 'ip_address')   $section = esc_html__('IP Address', 'bbq-pro');
	if ($k == 'referrer')     $section = esc_html__('Referrer', 'bbq-pro');
	
	echo $section; 
}

function bbq_list_header($k, $v) { 
	
	if (!empty($v)) : ?>

	<tr class="bbq-header">
		
		<td><input type="checkbox" class="bbq-select-all" data-type="<?php echo $k; ?>" title="<?php esc_attr_e('Toggle patterns (enable/disable)', 'bbq-pro'); ?>" /></td>
		
		<td><?php esc_html_e('Pattern', 'bbq-pro'); ?></td>
		
		<?php if ($k === 'query_string' || $k === 'request_uri') : ?><td><?php esc_html_e('Test', 'bbq-pro'); ?></td><?php endif; ?>
		
		<td class="bbq-toggle-count" data-type="<?php echo $k; ?>"><?php esc_html_e('Count', 'bbq-pro'); ?></td>
	</tr>
	
<?php endif;
}

function bbq_clone_markup($active_tab, $k, $i) { ?>
	
	<tr class="bbq-clone bbq-clone-<?php echo $k; ?>" data-id="<?php echo $i - 1; ?>">
		
		<td><input type="checkbox" name="<?php echo $active_tab .'['. $k .'][bbqid][enable]'; ?>" checked="checked" value="1" class="bbq-enable" /></td>
		
		<td><input type="text" size="30" name="<?php echo $active_tab .'['. $k .'][bbqid][pattern]'; ?>" value="" class="bbq-pattern" /></td>
		
		<?php bbq_pattern_test($k, '', true); ?>
		
		<td><input type="text" size="30" name="<?php echo $active_tab .'['. $k .'][bbqid][count]'; ?>" value="0" class="bbq-count bbq-count-00" /></td>
	</tr>
	
<?php 
}

function bbq_pattern_test($k, $pattern, $clone = false) {
	
	$var = '';
	$markup = ''; 
	$display = false;
	$random = rand(1, 999);
	$base = esc_url(home_url('/'. $random));
	
	if ($clone) $pattern = '';
	if ($k === 'query_string') $var = '?';
	if ($k === 'query_string' || $k === 'request_uri') $display = true;
	
	if ($display) $markup = '<td><a target="_blank" rel="noopener noreferrer" href="'. $base . $var . $pattern .'" class="bbq-test">'. esc_html__('Test', 'bbq-pro') .'</a></td>';
	
	echo $markup;
}

function bbq_count_class($count) {
	
	// 0 5 10 20 40 80 160 320 640 1280 2560 5120 10240 20480 40960 81920 163840 327680 655360 1310720 2621440
	
	$count = intval($count);
	$class = 'bbq-count-00';
	
	if     ($count >= 0  && $count < 5)   $class = 'bbq-count-00';
	elseif ($count >= 5  && $count < 10)  $class = 'bbq-count-05';
	elseif ($count >= 10 && $count < 20)  $class = 'bbq-count-10';
	elseif ($count >= 20 && $count < 40)  $class = 'bbq-count-15';
	elseif ($count >= 40 && $count < 80)  $class = 'bbq-count-20';
	elseif ($count >= 80 && $count < 160) $class = 'bbq-count-25';
	
	elseif ($count >= 160  && $count < 320)  $class = 'bbq-count-30';
	elseif ($count >= 320  && $count < 640)  $class = 'bbq-count-35';
	elseif ($count >= 640  && $count < 1280) $class = 'bbq-count-40';
	elseif ($count >= 1280 && $count < 2560) $class = 'bbq-count-45';
	elseif ($count >= 2560 && $count < 5120) $class = 'bbq-count-50';
	
	elseif ($count >= 5120  && $count < 10240)  $class = 'bbq-count-55';
	elseif ($count >= 10240 && $count < 20480)  $class = 'bbq-count-60';
	elseif ($count >= 20480 && $count < 40960)  $class = 'bbq-count-65';
	elseif ($count >= 40960 && $count < 81920)  $class = 'bbq-count-70';
	elseif ($count >= 81920 && $count < 163840) $class = 'bbq-count-75';
	
	elseif ($count >= 163840  && $count < 327680)  $class = 'bbq-count-80';
	elseif ($count >= 327680  && $count < 655360)  $class = 'bbq-count-85';
	elseif ($count >= 655360  && $count < 1310720) $class = 'bbq-count-90';
	elseif ($count >= 1310720 && $count < 2621440) $class = 'bbq-count-95';
	
	elseif ($count >= 2621440) $class = 'bbq-count-100';
	
	echo $class;
}



function bbq_active_count($patterns, $type) {
	
	global $bbq_options;
	
	$count = 0;
	$total = 0;
	
	foreach ($patterns as $pattern) {
		
		if (isset($pattern['enable']) && $pattern['enable']) $count++;
		$total++;
	}
	
	if ((!$bbq_options['basic_rules'] && $type === 'basic') || (!$bbq_options['advanced_rules'] && $type === 'advanced') || (!$bbq_options['custom_rules'] && $type === 'custom')) $count = 0;
	
	$return = ' <span class="bbq-pattern-count">'. $count .' active / '. $total .' total</span>';
	
	echo $return;
}


