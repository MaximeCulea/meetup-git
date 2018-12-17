<?php // BBQ Pro - Enqueue Resources

if (!defined('ABSPATH')) exit;

function bbq_enqueue_resources_admin() {

	if (isset($_GET['page']) && ($_GET['page'] == 'bbq_settings' || $_GET['page'] == 'bbq_patterns' || $_GET['page'] == 'bbq_tools' || $_GET['page'] == 'bbq_license')) {
		
		wp_enqueue_style('bbq_admin', BBQ_URL .'css/admin-styles.css');
		
		if ($_GET['page'] != 'bbq_license') {
		
			wp_enqueue_script('bbq_admin', BBQ_URL .'js/admin-scripts.js');
		}
	}
}

function bbq_print_js_vars_admin() {
	
	$protocol = is_ssl() ? 'https://' : 'http://'; ?>
		
	<script type="text/javascript">var bbq_home_url = <?php echo "'". esc_url(home_url('/')) ."'"; ?>;</script>
	
<?php 
}


