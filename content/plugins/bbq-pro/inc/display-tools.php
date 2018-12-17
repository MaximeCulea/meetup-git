<?php // BBQ Pro - Display Tools

function bbq_display_tools() { 
	
	$status = get_option('bbq_license_status');
	
	?>
	
	<div class="wrap">
		
		<h1 class="bbq-title"><?php esc_html_e('BBQ Pro', 'bbq-pro'); ?> <span><?php echo BBQ_VERSION; ?></span></h1>
		
		<?php if ($status === 'valid' || BBQ_CODE) : ?>
		
		<h2><?php esc_html_e('BBQ Tools', 'bbq-pro'); ?></h2>
		
		<p><?php echo esc_html__('Visit the', 'bbq-pro') .' <strong>'. esc_html__('Help', 'bbq-pro') .'</strong> '. esc_html__('tab above for complete documentation.', 'bbq-pro'); ?></p>
		
		<form method="post" action="">
			
			<div class="bbq-tools-section">
				<h3><?php esc_html_e('Reset Settings', 'bbq-pro'); ?></h3>
				<ul>
					<li><label class="bbq-label inline-block"><input type="checkbox" value="1" name="bbq-reset-settings" /> <?php esc_html_e('Reset Plugin Settings', 'bbq-pro'); ?></label></li>
				</ul>
			</div>
			
			<div class="bbq-tools-section">
				<h3><?php esc_html_e('Reset Patterns', 'bbq-pro'); ?></h3>
				<ul>
					<li><label class="bbq-label inline-block"><input type="checkbox" value="1" name="bbq-reset-basic" />    <?php esc_html_e('Reset Basic Patterns', 'bbq-pro'); ?></label></li>
					<li><label class="bbq-label inline-block"><input type="checkbox" value="1" name="bbq-reset-advanced" /> <?php esc_html_e('Reset Advanced Patterns', 'bbq-pro'); ?></label></li>
					<li><label class="bbq-label inline-block"><input type="checkbox" value="1" name="bbq-reset-custom" />   <?php esc_html_e('Reset Custom Patterns', 'bbq-pro'); ?></label></li>
				</ul>
			</div>
			
			<div class="bbq-tools-section">
				<h3><?php esc_html_e('Reset Counts', 'bbq-pro'); ?></h3>
				<ul>
					<li><label class="bbq-label inline-block"><input type="checkbox" value="1" name="bbq-reset-count" /> <?php esc_html_e('Reset Pattern Counts', 'bbq-pro'); ?></label></li>
				</ul>
			</div>
			
			<?php wp_nonce_field('bbq-reset-defaults', 'bbq-reset-defaults', false); ?>
			
			<input class="button button-primary bbq-reset-button" type="submit" value="<?php esc_attr_e('Reset', 'bbq-pro'); ?>" />
		</form>
		
		<?php else : ?>
		
		<h2><?php esc_html_e('Welcome to BBQ Pro!', 'bbq-pro'); ?></h2>
		<p class="intro"><a href="<?php echo admin_url('admin.php?page=bbq_license'); ?>"><?php esc_html_e('Enter your License Key to enable BBQ Pro &raquo;', 'bbq-pro'); ?></a></p>
		
		<?php endif; ?>
		
	</div>
	
	<script type="text/javascript">
		jQuery('.bbq-reset-button').click(function() {
			if (confirm('<?php esc_html_e('Reset selected items?', 'bbq-pro'); ?>')) jQuery('form').submit();
		});
	</script>
	
<?php }

function bbq_reset_defaults() {
	global $bbq_options, $bbq_patterns;
	
	if (isset($_POST['bbq-reset-defaults']) && wp_verify_nonce($_POST['bbq-reset-defaults'], 'bbq-reset-defaults')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$default_options  = BBQ_Pro::options();
		$default_patterns = BBQ_Pro::patterns();
		
		if (isset($_POST['bbq-reset-settings']))  $bbq_options = $default_options;
		
		if (isset($_POST['bbq-reset-basic']))    $bbq_patterns['basic']    = $default_patterns['basic']; 
		if (isset($_POST['bbq-reset-advanced'])) $bbq_patterns['advanced'] = $default_patterns['advanced'];
		if (isset($_POST['bbq-reset-custom']))   $bbq_patterns['custom']   = $default_patterns['custom'];
		
		if (isset($_POST['bbq-reset-count'])) {
			
			foreach ($bbq_patterns as $key => $value) {
				
				foreach ($value as $k => $v) {
					
					foreach ($v as $id => $array) {
						
						$bbq_patterns[$key][$k][$id]['count'] = 0;
						
					}
				}
			}
		}
		
		$options  = update_option('bbq_options',  $bbq_options);
		$patterns = update_option('bbq_patterns', $bbq_patterns);
		
	}
}



function bbq_tools_admin_notice() {
	
	$screen = get_current_screen();
	
	if ($screen->id === 'bbq-pro_page_bbq_tools') {
		
		if (isset($_POST['bbq-reset-defaults'])) {
			
			if (wp_verify_nonce($_POST['bbq-reset-defaults'], 'bbq-reset-defaults')) : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Reset successful.', 'bbq-pro'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made.', 'bbq-pro'); ?></strong></p></div>
				
			<?php endif;
		}
	}
}
add_action('admin_notices', 'bbq_tools_admin_notice');


