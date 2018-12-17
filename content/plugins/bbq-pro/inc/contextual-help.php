<?php // BBQ Pro - Contextual Help

if (!defined('ABSPATH')) exit;


function bbq_get_help_sidebar() {
	return '<p><strong>'. esc_html__('More Information', 'bbq-pro') .'</strong></p>'.
		
		'<p>'. 
			esc_html__('Visit the', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/docs/bbq/">'. esc_html__('BBQ Docs', 'bbq-pro') .'</a> '. esc_html__('at Plugin Planet.', 'bbq-pro') .
		'</p>'.
		
		'<p>'. 
			esc_html__('Report an issue in the', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/forum/bbq/">'. esc_html__('BBQ Support Forum', 'bbq-pro') .'</a>. 
			<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/#contact">'. esc_html__('Contact the plugin developer', 'bbq-pro') .'</a> '. esc_html__('for help.', 'bbq-pro') .
		'</p>'.
		
		'<p><strong>'. esc_html__('Support BBQ!', 'bbq-pro') .'</strong></p>'.
		
		'<ul>'.
		'<li><a target="_blank" rel="noopener noreferrer" href="https://monzillamedia.com/donate.html">'. esc_html__('Make a donation&nbsp;&raquo;', 'bbq-pro') .'</a></li>'.
		'<li><a target="_blank" rel="noopener noreferrer" href="https://wordpress.org/support/plugin/block-bad-queries/reviews/?rate=5#new-post">'. esc_html__('Give 5&#10025; Rating&nbsp;&raquo;', 'bbq-pro') .'</a></li>'.
		'</ul>'.
		
		'<div id="fb-root"></div>
		<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; 
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3"; fjs.parentNode.insertBefore(js, fjs); }(document, "script", "facebook-jssdk"));</script>
		<div class="share-button fb-share-button" data-href="https://plugin-planet.com/bbq-pro/" data-layout="button"></div>'.
		
		'<div class="share-button twitter-share-button"><a href="https://twitter.com/perishable" class="twitter-follow-button" data-show-count="false" data-dnt="true"></a></div>'.
		
		'<div class="share-button twitter-share-button">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://plugin-planet.com/bbq-pro/" data-text="Grillin&rsquo; and Chillin&rsquo; with BBQ Pro." 
			data-via="perishable" data-count="none" data-hashtags="wordpress,security,plugin" data-dnt="true">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";
			if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
		</div><br />';
}


function bbq_settings_contextual_help() {
	
	$screen = get_current_screen();
	
	if ($screen->id != 'toplevel_page_bbq_settings') return;
	
	$screen->set_help_sidebar(bbq_get_help_sidebar());
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-intro',
			'title' => esc_attr__('Introduction', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Welcome to BBQ Pro', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro is a lightweight and flexible firewall that protects your site from bad HTTP requests. ', 'bbq-pro') .
					esc_html__('You can customize BBQ Pro via', 'bbq-pro') .' <a href="'. esc_url(admin_url('admin.php?page=bbq_settings')) .'">'. esc_html__('BBQ Settings', 'bbq-pro') .'</a>, '. 
					esc_html__('and you can fine-tune blocked requests via', 'bbq-pro') .' <a href="'. esc_url(admin_url('admin.php?page=bbq_patterns')) .'">'. esc_html__('BBQ Patterns', 'bbq-pro') .'</a>.'.
				'</p>'.
				
				'<p><strong>'. esc_html__('Useful BBQ Resources', 'bbq-pro') .'</strong></p>'.
				
				'<ul>'.
					'<li><a target="_blank" rel="noopener noreferrer" href="'. esc_url(BBQ_URL .'readme.txt') .'">'.      esc_html__('View the plugin&rsquo;s readme.txt',      'bbq-pro') .'</a></li>'.
					'<li><a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/wp/wp-login.php">'. esc_html__('Log in to your account at Plugin Planet', 'bbq-pro') .'</a></li>'.
					'<li><a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/forum/bbq/">'.      esc_html__('Get help in the Support Forum',           'bbq-pro') .'</a></li>'.
					'<li><a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/#contact">'.        esc_html__('Contact the plugin developer for help',   'bbq-pro') .'</a></li>'.
				'</ul>'.
				
				'<p><strong>'. esc_html__('About the Developer', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro is developed by', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://twitter.com/perishable">'. esc_html__('Jeff Starr', 'bbq-pro') .'</a>, '.
					esc_html__('10-year WordPress veteran and', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://wp-tao.com/wordpress-themes-book/">'. esc_html__('book author', 'bbq-pro') .'</a>.'.
				'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-enable-disable',
			'title' => esc_attr__('Enable/Disable', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Enable/Disable Indicator', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. esc_html__('When BBQ is active, the text &ldquo;BBQ is Enabled&rdquo; is displayed in green. When disabled, the text &ldquo;BBQ is Disabled&rdquo; is displayed in red.', 'bbq-pro') .'</p>'.
				
				'<p><strong>'. esc_html__('More Information', 'bbq-pro') .'</strong></p>'. 
				
				'<p>'. 
					esc_html__('Each set of rules (Basic, Advanced, and Custom) consists of numerous individual patterns. Each of these patterns may be enabled or disabled via the &ldquo;Patterns&rdquo; screen. ', 'bbq-pro') .
					esc_html__('At least one pattern must be active in order for the Enable/Disable Indicator to display as &ldquo;Enabled&rdquo;. ', 'bbq-pro') .
				'</p>'.
				
				'<p>'. 
					esc_html__('So for example, let&rsquo;s say that only the Basic Rules are enabled for your site (i.e., the Advanced and Custom Rules are disabled). ', 'bbq-pro') .
					esc_html__('That is perfectly fine, but now let&rsquo;s say that all of the patterns for the Basic Rules are disabled (i.e., unchecked boxes for all patterns). ', 'bbq-pro') .
					esc_html__('If this were the case, the Enable/Disable Indicator would display as disabled (red). Then if we enable any basic-rule pattern(s), the Indicator would display as enabled (green).', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: enabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-enable-basic',
			'title' => esc_attr__('Basic Rules', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Basic Rules', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting enables BBQ&rsquo;s basic security rules. The Basic Rules are virtually identical to those provided in the', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://wordpress.org/plugins/block-bad-queries/">'. esc_html__('free version of BBQ', 'bbq-pro') .'</a>. '.
					esc_html__('They are well-tested with WordPress and will protect your site against some of the most common types of malicious attacks and exploits. ', 'bbq-pro') .
					esc_html__('You can fine-tune the Basic Rules by visiting the &ldquo;Basic&rdquo; tab on the', 'bbq-pro') .
								' <a href="'. esc_url(admin_url('admin.php?page=bbq_patterns')) .'">'. esc_html__('Patterns', 'bbq-pro') .'</a> '. esc_html__('screen.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: enabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-advanced-rules',
			'title' => esc_attr__('Advanced Rules', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Advanced Rules', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting enables BBQ&rsquo;s Advanced Rules. This includes further protection against a variety of malicious attacks. ', 'bbq-pro') .
					esc_html__('The Advanced Rules primarily are derived from the', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/5g-blacklist-2013/">'. esc_html__('5G Firewall', 'bbq-pro')         .'</a>, '.
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/6g/">'.                esc_html__('6G Firewall', 'bbq-pro')         .'</a>, '. esc_html__('and other', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/category/security/">'. esc_html__('security techniques', 'bbq-pro') .'</a>.'.
				'</p>'.
				
				'<p>'. 
					esc_html__('The Advanced Rules are disabled by default because they are not as widely tested as BBQ&rsquo;s Basic Rules. ', 'bbq-pro') .
					esc_html__('If you enable the Advanced Rules, it is recommended that you test your pages thoroughly. ', 'bbq-pro') .
					esc_html__('If you discover any issue, you can fine-tune specific patterns by visiting the &ldquo;Advanced&rdquo; tab on the', 'bbq-pro') .
								' <a href="'. esc_url(admin_url('admin.php?page=bbq_patterns')) .'">'. esc_html__('Patterns', 'bbq-pro') .'</a> '. esc_html__('screen, ', 'bbq-pro') . 
					esc_html__('or you can disable the Advanced Rules altogether via this setting.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-custom-rules',
			'title' => esc_attr__('Custom Rules', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Custom Rules', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting enables BBQ&rsquo;s Custom Rules. This enables you to add your own custom rules to BBQ. ', 'bbq-pro') .
					esc_html__('To do so, visit the &ldquo;Custom&rdquo; tab on the', 'bbq-pro') .' <a href="'. esc_url(admin_url('admin.php?page=bbq_patterns')) .'">'. esc_html__('Patterns', 'bbq-pro') .'</a> '. 
					esc_html__('screen. ', 'bbq-pro') . 
					esc_html__('If you enable any Custom Rules, it is recommended that you test your pages thoroughly.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-logged-users',
			'title' => esc_attr__('Logged-in Users', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Logged-in Users', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting disables all BBQ protection for any URL requests that are made by logged-in users. ', 'bbq-pro') .
					esc_html__('The assumption here is that users who have successfully logged in to your site will not be making malicious URL requests. ', 'bbq-pro') .
					esc_html__('While this may be true for individual admins and trusted teams, it may not be true for sites with many registered users.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-limit-requests',
			'title' => esc_attr__('Limit Requests', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Limit Requests', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('Malicious URL requests often exceed 255 characters, however some services require long URLs in order to function. ', 'bbq-pro') .
					esc_html__('Enable this setting to block requests that exceed 255 characters in length. Advisable if you are sure that your site does not use any long URLs. ', 'bbq-pro') .
					esc_html__('If you are unsure, leave this setting disabled.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-strict-mode',
			'title' => esc_attr__('Strict Mode', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Strict Mode', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('By default, BBQ Pro checks each request &ldquo;as-is&rdquo;, without decoding any encoded characters. ', 'bbq-pro') .
					esc_html__('For example, if a request contains', 'bbq-pro') .' <em>'. esc_html__('unencoded', 'bbq-pro') .'</em> '. 
					esc_html__('square brackets', 'bbq-pro') .', <code>[</code> '. esc_html__('and', 'bbq-pro') .' <code>]</code>, '. 
					esc_html__('BBQ will block the request because unencoded square brackets are considered', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/stop-using-unsafe-characters-in-urls/">'. esc_html__('unsafe', 'bbq-pro') .'</a>. '. 
					esc_html__('On the other hand, if the request contains', 'bbq-pro') .' <em>'. esc_html__('encoded', 'bbq-pro') .'</em> '. 
					esc_html__('square brackets,', 'bbq-pro') .' <code>%5B</code> '. esc_html__('and', 'bbq-pro') .' <code>%5D</code>, '. 
					esc_html__('BBQ will not block the request because encoded characters are considered safe.', 'bbq-pro') .
				'</p>'.
				
				'<p>'. 
					esc_html__('When enabled, Strict Mode instructs BBQ to block both unencoded and encoded variations of all active patterns. So in our example, requests containing square brackets will be blocked, ', 'bbq-pro') . 
					esc_html__('regardless of whether or not the brackets are encoded. Likewise for every active pattern, when Strict Mode is enabled, active patterns will be blocked even if they are encoded. ', 'bbq-pro') .
				'</p>'.
				
				'<p>'. esc_html__('If in doubt, leave Strict Mode disabled. Strict Mode exists for advanced users who want to customize their firewall for maximum protection.', 'bbq-pro') .
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-redirect-url',
			'title' => esc_attr__('Redirect URL', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Redirect URL', 'bbq-pro') .'</strong></p>'. 
				
				'<p>'. 
					esc_html__('By default, when BBQ blocks a bad request, it exits and returns a &ldquo;403 Forbidden&rdquo; status code. ', 'bbq-pro') .
					esc_html__('If you would rather redirect the bad request to a specific location, you may enter the URL here. ', 'bbq-pro') .
					esc_html__('See also the setting, &ldquo;Status Code&rdquo; to choose an appropriate status code. ', 'bbq-pro') .
				'</p>'.
				
				'<p>'. 
					esc_html__('When using this option to redirect blocked requests, a 301 (permanent redirect) or 302 (temporary/found) status code is required. ', 'bbq-pro') .
					esc_html__('If a code other than 301 or 302 is specified, a 302 code will be used. Leave blank for no redirect.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: blank (no redirect)', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-custom-message',
			'title' => esc_attr__('Custom Message', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Custom Message', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('By default, when BBQ blocks a bad request, it exits and returns a &ldquo;403 Forbidden&rdquo; status code. ', 'bbq-pro') .
					esc_html__('If you would like to display a custom message, you may enter it here (you may use text and/or markup). ', 'bbq-pro') .
					esc_html__('You may use', 'bbq-pro') .' <code>%s</code> '. esc_html__('to display the matching pattern. ', 'bbq-pro') .
					esc_html__('See also the setting, &ldquo;Status Code&rdquo; to choose an appropriate status code.', 'bbq-pro') .
				'</p>'.
				
				'<p><strong>'. esc_html__('Note:', 'bbq-pro') .'</strong> '. esc_html__('If enabled, the setting &ldquo;Redirect URL&rdquo; overrides any custom message.', 'bbq-pro') .'</p>'.
				
				'<p><em>'. esc_html__('Default: blank (no custom message)', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-status-code',
			'title' => esc_attr__('Status Code', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Status Code', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting determines how BBQ responds to blocked requests. ', 'bbq-pro') .
					esc_html__('By default, BBQ responds to blocked requests with a &ldquo;403 &ndash; Forbidden&rdquo; status code, which is recommended. ', 'bbq-pro') .
					esc_html__('You are free to change the default 403 response to whatever makes sense for your site.', 'bbq-pro') .
				'</p>'.
				
				'<p>
					<strong>'. esc_html__('Note:', 'bbq-pro') .'</strong> '. esc_html__('If you are', 'bbq-pro') .' <em>'. esc_html__('redirecting', 'bbq-pro') .'</em> '.
					esc_html__('blocked requests, you must use a 301 or 302 status code (see the setting &ldquo;Redirect URL&rdquo;). ', 'bbq-pro') .
					esc_html__('It is important to understand that status codes may impact SEO. If in doubt, use the default setting (recommended).', 'bbq-pro') .
				'</p>'.
				
				'<p><a target="_blank" rel="noopener noreferrer" href="http://en.wikipedia.org/wiki/List_of_HTTP_status_codes">'. esc_html__('Learn more about HTTP status codes', 'bbq-pro') .'&nbsp;&raquo;</a></p>'.
				
				'<p><em>'. esc_html__('Default: 403 Forbidden', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-remove-disabled',
			'title' => esc_attr__('Remove Disabled', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Remove Disabled', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('Enable this setting to remove any disabled (unselected)', 'bbq-pro') .' <a href="'. esc_url(admin_url('admin.php?page=bbq_patterns')) .'">'. esc_html__('BBQ Patterns', 'bbq-pro') .'</a>. '.
					esc_html__('After enabling this setting, visit the BBQ Patterns and click the &ldquo;Save Changes&rdquo; button for each section (Basic, Advanced, and Custom). ', 'bbq-pro') .
					esc_html__('If you are unsure about this setting, leave it disabled.', 'bbq-pro') .
				'</p>'.
				
				'<p>
					<strong>'. esc_html__('Note:', 'bbq-pro') .'</strong> '. 
					esc_html__('To restore default settings and patterns, either visit the', 'bbq-pro') .' <a href="'. esc_url(admin_url('admin.php?page=bbq_tools')) .'">'. esc_html__('Tools', 'bbq-pro') .'</a> '.
					esc_html__('screen or uninstall and reinstall the plugin.', 'bbq-pro') .
				'</p>'.
				
				'<p><em>'. esc_html__('Default: disabled', 'bbq-pro') .'</em></p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq_whitelist_ips',
			'title' => esc_attr__('Whitelist IPs', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Whitelist IPs', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('This setting enables you to whitelist (always allow) access from a list of IP addresses. ', 'bbq-pro') .
					esc_html__('This is useful if your site uses a forward/reverse proxy, load balancer, caching, etc. ', 'bbq-pro') .
					esc_html__('If you are unsure, leave this setting blank. To add an IP address, you can use any of the following notations:', 'bbq-pro') .
				'</p>'.
				
				'<ul>'. 
					'<li>'. esc_html__('Individual IP address, like', 'bbq-pro') .' <code>173.203.204.22</code></li>'. 
					'<li>'. esc_html__('Sequential range of IP addresses, like', 'bbq-pro') .' <code>173.203.</code></li>'. 
					'<li>'. esc_html__('CIDR range of IP addresses, like', 'bbq-pro') .' <code>173.203.204.22/24</code></li>'. 
				'</ul>'.
				
				'<p>
					<strong>'. esc_html__('Important:', 'bbq-pro') .'</strong> '. 
					esc_html__('Separate multiple IP/strings with commas. ', 'bbq-pro') . 
					esc_html__('IPs added to this section are matched against the IP that is reported with each request. ', 'bbq-pro') .
					esc_html__('For new installs, the plugin automatically adds your server IP address, if it is available. ', 'bbq-pro') . 
					esc_html__('If you are using anything like caching, load-balancing, or reverse proxy, make sure to add their respective IPs to the whitelist.', 'bbq-pro') . 
				'</p>'.
				
				'<p><em>'. esc_html__('Default: your server IP address, local IP address, Securi Sitecheck IP, WP Rocket IPs', 'bbq-pro') .'</em></p>'	
		)
	);
	
	do_action('bbq_settings_contextual_help', $screen);
}
add_action('load-toplevel_page_bbq_settings', 'bbq_settings_contextual_help');










function bbq_patterns_contextual_help() {
	
	$screen = get_current_screen();
	
	if ($screen->id != 'bbq-pro_page_bbq_patterns') return;
	
	$screen->set_help_sidebar(bbq_get_help_sidebar());
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-patterns',
			'title' => esc_attr__('BBQ Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('BBQ Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. esc_html__('The Patterns screen provides three sets of BBQ Patterns: Basic, Advanced, and Custom. Each set of patterns is available under its own tab. Here is an overview:', 'bbq-pro') .'</p>'.
				
				'<ul>
					<li>
						<strong>'. esc_html__('Basic Patterns', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Basically the same patterns that are used in the free version of the plugin. ', 'bbq-pro') .
						esc_html__('They are well-tested and recommended for all sites.', 'bbq-pro') .
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('Advanced Patterns', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Protect against a wide variety of malicious requests and exploits. ', 'bbq-pro') .
						esc_html__('They primarily are derived from the', 'bbq-pro') .
						' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/5g-blacklist-2013/">'. esc_html__('5G Firewall', 'bbq-pro') .'</a> '. esc_html__('and', 'bbq-pro') .
						' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/6g/">'. esc_html__('6G Firewall', 'bbq-pro') .'</a>.'.
					'</li>'.
					
					'<li><strong>'. esc_html__('Custom Patterns', 'bbq-pro') .'</strong> &ndash; '. esc_html__('Enable you to add your own custom rules to BBQ Pro.', 'bbq-pro') .'</li>'.
				'</ul>'.
				
				'<p>'. esc_html__('All BBQ patterns may be enabled, disabled, or customized as follows:', 'bbq-pro') .'</p>'.
				
				'<ul>'.
					'<li><strong>'. esc_html__('Modify a pattern', 'bbq-pro') .'</strong> &ndash; '. esc_html__('To modify a pattern, make any desired changes and click &ldquo;Save Changes&rdquo;. ', 'bbq-pro') .'</li>'.
					'<li><strong>'. esc_html__('Add a pattern', 'bbq-pro')    .'</strong> &ndash; '. esc_html__('To add your own pattern, visit the &ldquo;Custom&rdquo; tab and click &ldquo;Add Pattern&rdquo;. ', 'bbq-pro') .'</li>'.
					'<li>
						<strong>'. esc_html__('Remove a pattern', 'bbq-pro') .'</strong> &ndash; '. esc_html__('To remove a pattern, first enable the setting &ldquo;Remove Disabled&rdquo;. ', 'bbq-pro') . 
						esc_html__('Then deselect any unwanted patterns and click &ldquo;Save Changes&rdquo; to remove them.', 'bbq-pro') .
					'</li>'.
				'</ul>'.
				
				'<p><strong>'. esc_html__('Tip:', 'bbq-pro') .' </strong>'. esc_html__('visit the plugin settings to enable or disable each of the three types of patterns.', 'bbq-pro') .'</p><br />'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-toggle',
			'title' => esc_attr__('Toggle Panels', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Toggle Panels', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('To help manage your patterns, you can toggle each panel by clicking on its title. ', 'bbq-pro') . 
					esc_html__('For example, to toggle the &ldquo;Query String&rdquo; panel, click on the title, &ldquo;Query String&rdquo;. Likewise for each of the other panels.', 'bbq-pro') .
				'</p>'.
				
				'<p><strong>'. esc_html__('Tip:', 'bbq-pro') .' </strong>'. esc_html__('click the link &ldquo;Toggle all panels&rdquo; to toggle all panels.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-enable',
			'title' => esc_attr__('Enable Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Enable Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. esc_html__('Check the checkbox for any pattern to enable it. Conversely, uncheck the checkbox for any pattern to disable it. Remember to click &ldquo;Save Changes&rdquo;.', 'bbq-pro') .'</p>'.
				
				'<p>
					<strong>'. esc_html__('Important:', 'bbq-pro') .' </strong>'. 
					esc_html__('when the setting &ldquo;Remove Disabled&rdquo; is enabled, all unselected/unchecked patterns will be removed. ', 'bbq-pro') .
					esc_html__('This is useful for cleaning up unwanted patterns. At any time you can visit', 'bbq-pro') .
								' <a href="'. esc_url(admin_url('admin.php?page=bbq_tools')) .'">'. esc_html__('BBQ Tools', 'bbq-pro') .'</a> '. 
					esc_html__('to restore default patterns and settings.', 'bbq-pro') .
				'</p>'.
				
				'<p><strong>'. esc_html__('Tip:', 'bbq-pro') .' </strong>'. esc_html__('check the top checkbox of any panel to automatically select all checkboxes in that panel.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-count',
			'title' => esc_attr__('Pattern Count', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Pattern Count', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro records the number of times each pattern is used to block a request. ', 'bbq-pro') . 
					esc_html__('This can be useful for troubleshooting, monitoring traffic, and fine-tuning your firewall. ', 'bbq-pro') .
					esc_html__('To change the count value for any pattern, edit the count field and click &ldquo;Save Changes&rdquo;. ', 'bbq-pro') .
				'</p>'.
				
				'<p><strong>'. esc_html__('Tip:', 'bbq-pro') .' </strong>'. esc_html__('click the &ldquo;Count&rdquo; table heading to toggle (show/hide) the pattern counts.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-test',
			'title' => esc_attr__('Test Pattern', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Test Pattern', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('To test any defined pattern, click on its &ldquo;Test&rdquo; button. ', 'bbq-pro') . 
					esc_html__('Doing so will make an URI request that includes the defined pattern (opens in new tab or window). ', 'bbq-pro') . 
					esc_html__('This increases the pattern count and enables you to see exactly what happens when the pattern is included in a request. ', 'bbq-pro') .
				'</p>'.
				
				'<p>
					<strong>'. 
					esc_html__('Note:', 'bbq-pro') .' </strong>'. 
					esc_html__('test buttons are available only for patterns defined under &ldquo;Query String&rdquo; or &ldquo;Request URI&rdquo;. ', 'bbq-pro') .
					esc_html__('To test User Agent Patterns, check out the handy tool at', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://www.hurl.it/">'. esc_html__('hurl.it', 'bbq-pro') .'</a>.'.
				'</p>'.
				
				'<p><strong>'. esc_html__('Tip:', 'bbq-pro') .' </strong>'. esc_html__('you can set the status code that BBQ sends for blocked requests by visiting &ldquo;Status Code&rdquo; in the plugin settings.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-basic',
			'title' => esc_attr__('Basic Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Basic Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro&rsquo;s Basic Patterns are the same patterns that are used in the free version of the plugin. ', 'bbq-pro') . 
					esc_html__('They are well-tested and recommended for all WordPress-powered sites. There are three types of Basic Patterns:', 'bbq-pro') .
				'</p>'.
				
				'<ul>
					<li>
						<strong>'. esc_html__('Query String', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the query-string portion of each URI request. ', 'bbq-pro') .
						esc_html__('For example, if the requested URI is', 'bbq-pro') .' <code>http://example.com/path/?id=123</code>, '. 
						esc_html__('the query-string is', 'bbq-pro') .' <code>id=123</code>.'.
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('Request URI', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the requested URI, not including the query string. ', 'bbq-pro') .
						esc_html__('For example, if the requested URI is', 'bbq-pro') .' <code>http://example.com/path/?id=123</code>, '. 
						esc_html__('patterns defined in this section are tested against', 'bbq-pro') .' <code>example.com/path/</code>.'.
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('User Agent', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the reported user agent for each URI request. ', 'bbq-pro') .
						esc_html__('User agents are faked easily, however many bad requests continue to report well-known and malicious agents that should be blocked whenever possible.', 'bbq-pro') .
					'</li>'.
				'</ul>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-advanced',
			'title' => esc_attr__('Advanced Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Advanced Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro&rsquo;s Advanced Patterns protect against a wide variety of malicious requests and exploits. They primarily are derived from the', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/5g-blacklist-2013/">'. esc_html__('5G Firewall', 'bbq-pro')         .'</a>, '.
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/6g/">'.                esc_html__('6G Firewall', 'bbq-pro')         .'</a>, '. esc_html__('and other', 'bbq-pro') .
								' <a target="_blank" rel="noopener noreferrer" href="https://perishablepress.com/category/security/">'. esc_html__('security techniques', 'bbq-pro') .'</a>. '.
					esc_html__('There are three types of Advanced Patterns:', 'bbq-pro') .
				'</p>'.
				
				'<ul>
					<li>
						<strong>'. esc_html__('Query String', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the query-string portion of each URI request. ', 'bbq-pro') .
						esc_html__('For example, if the requested URI is', 'bbq-pro') .' <code>http://example.com/path/?id=123</code>, '. 
						esc_html__('the query-string is', 'bbq-pro') .' <code>id=123</code>.'.
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('Request URI', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the requested URI, not including the query string. ', 'bbq-pro') .
						esc_html__('For example, if the requested URI is', 'bbq-pro') .' <code>http://example.com/path/?id=123</code>, '. 
						esc_html__('patterns defined in this section are tested against', 'bbq-pro') .' <code>example.com/path/</code>.'.
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('User Agent', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the reported user agent for each URI request. ', 'bbq-pro') .
						esc_html__('User agents are faked easily, however many bad requests continue to report well-known and malicious agents that should be blocked whenever possible.', 'bbq-pro') .'</li>'.
				'</ul>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-custom',
			'title' => esc_attr__('Custom Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Custom Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. 
					esc_html__('BBQ Pro&rsquo;s Custom Patterns enable you to add your own custom rules to BBQ Pro. ', 'bbq-pro') . 
					esc_html__('In addition to the three types of patterns used for Basic and Advanced Patterns (i.e., Query String, Request URI, and User Agent), BBQ&rsquo;s Custom Patterns include:', 'bbq-pro') .
				'</p>'.
				
				'<ul>
					<li>
						<strong>'. esc_html__('IP Address', 'bbq-pro') .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are matched against the IP address that is reported with each request. ', 'bbq-pro') .
						esc_html__('Patterns defined here should contain only numbers and dots, for example:', 'bbq-pro') .' <code>123.456.789</code>. '. 
						esc_html__('Note that these patterns are treated as regular expressions, ', 'bbq-pro') .
						esc_html__('such that a pattern of', 'bbq-pro') .' <code>123.</code> '. 
						esc_html__('will match every IP that begins with', 'bbq-pro') .' <code>123.</code>. '. esc_html__('So exercise caution for best results.', 'bbq-pro') .
					'</li>'.
					
					'<li>
						<strong>'. esc_html__('Referrer', 'bbq-pro')  .'</strong> &ndash; '. 
						esc_html__('Patterns defined in this section are tested against the reported referrer. ', 'bbq-pro') .
						esc_html__('For example, if you keep getting bad requests from the site', 'bbq-pro') .' <code>http://example.com/</code>, '. 
						esc_html__('you can add the URL in this section to block them.', 'bbq-pro') .
					'</li>'.
				'</ul>'.
				
				'<p>
					<strong>'. esc_html__('Tip:', 'bbq-pro') .'</strong> '. 
					esc_html__('to test User Agent Patterns and Referrer Patterns, check out', 'bbq-pro') .' <a target="_blank" rel="noopener noreferrer" href="https://www.hurl.it/">'. esc_html__('hurl.it', 'bbq-pro') .'</a>.'.
				'</p>'
		)
	);
	
	do_action('bbq_patterns_contextual_help', $screen);
}
add_action('load-bbq-pro_page_bbq_patterns', 'bbq_patterns_contextual_help');










function bbq_tools_contextual_help() {
	
	$screen = get_current_screen();
	
	if ($screen->id != 'bbq-pro_page_bbq_tools') return;
	
	$screen->set_help_sidebar(bbq_get_help_sidebar());
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-tools',
			'title' => esc_attr__('BBQ Tools', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('BBQ Tools', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('BBQ Tools enable the following tasks:', 'bbq-pro') .'</p>'.
				
				'<ul>'.
					'<li><strong>'. esc_html__('Reset Settings', 'bbq-pro') .'</strong> &ndash; '. esc_html__('reset all plugin options to their default settings', 'bbq-pro') .'</li>'.
					'<li><strong>'. esc_html__('Reset Patterns', 'bbq-pro') .'</strong> &ndash; '. esc_html__('reset all patterns to default values, and reset all counts to zero', 'bbq-pro') .'</li>'.
					'<li><strong>'. esc_html__('Reset Counts', 'bbq-pro') .'</strong> &ndash; '. esc_html__('reset all pattern counts to zero', 'bbq-pro') .'</li>'.
				'</ul>'.
				
				'<p><strong>'. esc_html__('Note:', 'bbq-pro') .' </strong>'. esc_html__('resetting BBQ patterns also resets their associated count values to zero.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-reset-settings',
			'title' => esc_attr__('Reset Settings', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Reset Settings', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('To reset BBQ settings to their default values, check the box &ldquo;Reset Plugin Settings&rdquo; and click the &ldquo;Reset&rdquo; button.', 'bbq-pro') .'</p>'.
				
				'<p><strong>'. esc_html__('Note:', 'bbq-pro') .' </strong>'. esc_html__('uninstalling BBQ Pro via the Plugin screen will remove all of the plugin&rsquo;s settings, patterns, and data.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-reset-patterns',
			'title' => esc_attr__('Reset Patterns', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Reset Patterns', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. esc_html__('Resetting BBQ patterns ensures that your firewall is current with the latest set of default patterns, which includes any changes made in updated versions of the plugin.', 'bbq-pro') .'</p>'.
				'<p>'. esc_html__('To reset BBQ patterns to their default values, check one or more of the following boxes:', 'bbq-pro') .'</p>'.
				
				'<ul>'.
					'<li>'. esc_html__('Reset Basic Patterns', 'bbq-pro') .'</li>'.
					'<li>'. esc_html__('Reset Advanced Patterns', 'bbq-pro') .'</li>'.
					'<li>'. esc_html__('Reset Custom Patterns', 'bbq-pro') .'</li>'.
				'</ul>'.
				
				'<p>'. esc_html__('..then click the &ldquo;Reset&rdquo; button and call it a day.', 'bbq-pro') .'</p>'.
				'<p><strong>'. esc_html__('Note:', 'bbq-pro') .' </strong>'. esc_html__('resetting BBQ patterns also resets their associated count values to zero.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-reset-counts',
			'title' => esc_attr__('Reset Counts', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Reset Counts', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('To reset all pattern counts to their default values, check the box &ldquo;Reset Pattern Counts&rdquo; and click the &ldquo;Reset&rdquo; button.', 'bbq-pro') .'</p>'
		)
	);
	
	do_action('bbq_tools_contextual_help', $screen);
}
add_action('load-bbq-pro_page_bbq_tools', 'bbq_tools_contextual_help');










function bbq_license_contextual_help() {
	
	$screen = get_current_screen();
	
	if ($screen->id != 'bbq-pro_page_bbq_license') return;
	
	$screen->set_help_sidebar(bbq_get_help_sidebar());
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-license',
			'title' => esc_attr__('BBQ License', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('BBQ License', 'bbq-pro') .'</strong></p>'.
				
				'<p>'. esc_html__('License activation enables access to plugin settings, free auto-updates, and priority support.', 'bbq-pro') .'</p>'.
				'<p>'. esc_html__('On this screen, you may enter your License Key to enable BBQ Pro and all features. Here are the steps: ', 'bbq-pro') .'</p>'.
				
				'<ol>'.
					'<li>'. esc_html__('Enter your License Key in the &ldquo;License Key&rdquo; field', 'bbq-pro') .'</li>'.
					'<li>'. esc_html__('Click the &ldquo;Save Changes&rdquo; button', 'bbq-pro') .'</li>'.
					'<li>'. esc_html__('Click the &ldquo;Activate License&rdquo; button*', 'bbq-pro') .'</li>'.
				'</ol>'.
				
				'<p>
					<strong>*'. esc_html__('Note:', 'bbq-pro') .'</strong> '. 
					esc_html__('the &ldquo;Activate License&rdquo; button is displayed after entering your license and saving the changes (steps 1 and 2).', 'bbq-pro') .
				'</p>'.
				
				'<p>
					<strong>'. esc_html__('Important:', 'bbq-pro') .'</strong> '. 
					esc_html__('remember to deactivate your license before uninstalling (deleting) the plugin, and/or transferring to a new domain. ', 'bbq-pro') .
					esc_html__('For more information, visit the', 'bbq-pro') .
					' <a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/activate-deactivate-plugin-license/">'. esc_html__('activation guide', 'blackhole-pro') .'</a> '. 
					esc_html__('at Plugin Planet.', 'blackhole-pro') . 
				'</p>'.
				
				'<p>
					<strong>'. esc_html__('Tip:', 'bbq-pro') .'</strong> '. 
					esc_html__('to view your License Key at any time', 'bbq-pro') .', <a target="_blank" rel="noopener noreferrer" href="'. esc_url(BBQ_HOME .'/wp/wp-login.php') .'">'. esc_html__('log in to your account at Plugin Planet', 'bbq-pro') .'&nbsp;&raquo;</a>'.
				'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-status',
			'title' => esc_attr__('License Status', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('License Status', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('Indicates whether or not the plugin is enabled.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-key',
			'title' => esc_attr__('License Key', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('License Key', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('Specifies the License Key for the site.', 'bbq-pro') .'</p>'
		)
	);
	
	$screen->add_help_tab(
		array(
			'id' => 'bbq-activate',
			'title' => esc_attr__('Activate License', 'bbq-pro'),
			'content' => 
				'<p><strong>'. esc_html__('Activate License', 'bbq-pro') .'</strong></p>'.
				'<p>'. esc_html__('This button appears after entering your license in the &ldquo;License Key&rdquo; field and clicking the &ldquo;Save Changes&rdquo; button. ', 'bbq-pro') .
				esc_html__('Once your license is entered, click the &ldquo;Activate License&rdquo; button to activate your license and enable the plugin.', 'bbq-pro') .'</p>'
		)
	);
	
	do_action('bbq_license_contextual_help', $screen);
}
add_action('load-bbq-pro_page_bbq_license', 'bbq_license_contextual_help');

