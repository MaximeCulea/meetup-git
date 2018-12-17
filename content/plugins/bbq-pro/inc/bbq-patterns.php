<?php // BBQ Pro - BBQ Patterns ( Powered by BBQ + 5G/6G Blacklist/Firewall )

function bbq_patterns() {
	
	return array(
				
		'basic' => array(
			
			'request_uri' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => 'eval('),
				array('enable' => true, 'count' => 0, 'pattern' => 'UNION+SELECT'),
				array('enable' => true, 'count' => 0, 'pattern' => '(null)'),
				array('enable' => true, 'count' => 0, 'pattern' => 'base64_'),
				array('enable' => true, 'count' => 0, 'pattern' => '/localhost'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '**/select+/**'),
				array('enable' => true, 'count' => 0, 'pattern' => '/pingserver'),
				array('enable' => true, 'count' => 0, 'pattern' => '/config.'),
				array('enable' => true, 'count' => 0, 'pattern' => '/wwwroot'),
				array('enable' => true, 'count' => 0, 'pattern' => '/makefile'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'crossdomain.'),
				array('enable' => true, 'count' => 0, 'pattern' => 'self/environ'),
				array('enable' => true, 'count' => 0, 'pattern' => 'etc/passwd'),
				array('enable' => true, 'count' => 0, 'pattern' => '/https:'),
				array('enable' => true, 'count' => 0, 'pattern' => '/http:'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/ftp:'),
				array('enable' => true, 'count' => 0, 'pattern' => '/cgi/'),
				array('enable' => true, 'count' => 0, 'pattern' => '.cgi'),
				array('enable' => true, 'count' => 0, 'pattern' => '.exe'),
				array('enable' => true, 'count' => 0, 'pattern' => '.sql'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '.ini'),
				array('enable' => true, 'count' => 0, 'pattern' => '.dll'),
				array('enable' => true, 'count' => 0, 'pattern' => '.asp'),
				array('enable' => true, 'count' => 0, 'pattern' => '.jsp'),
				array('enable' => true, 'count' => 0, 'pattern' => '/.git'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/.svn'),
				array('enable' => true, 'count' => 0, 'pattern' => '.tar'),
				array('enable' => true, 'count' => 0, 'pattern' => '/&&'),
				array('enable' => true, 'count' => 0, 'pattern' => '<'),
				array('enable' => true, 'count' => 0, 'pattern' => '>'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/='),
				array('enable' => true, 'count' => 0, 'pattern' => '...'),
				array('enable' => true, 'count' => 0, 'pattern' => '+++'),
				array('enable' => true, 'count' => 0, 'pattern' => '://'),
				array('enable' => true, 'count' => 0, 'pattern' => '/Nt.'),
				
				array('enable' => true, 'count' => 0, 'pattern' => ';Nt.'),
				array('enable' => true, 'count' => 0, 'pattern' => '=Nt.'),
				array('enable' => true, 'count' => 0, 'pattern' => ',Nt.'),
				array('enable' => true, 'count' => 0, 'pattern' => ').html('),
				array('enable' => true, 'count' => 0, 'pattern' => '{x.html('),
				
				array('enable' => true, 'count' => 0, 'pattern' => '(function('),
				array('enable' => true, 'count' => 0, 'pattern' => 'revslider'),
				array('enable' => true, 'count' => 0, 'pattern' => '__hdhdhd.php'),
				array('enable' => true, 'count' => 0, 'pattern' => 'base64('),
				array('enable' => true, 'count' => 0, 'pattern' => '.bash'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'indoxploi'),
				array('enable' => true, 'count' => 0, 'pattern' => 'xrumer'),
				
			),
			
			'query_string' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => '../'),
				array('enable' => true, 'count' => 0, 'pattern' => '127.0.0.1'),
				array('enable' => true, 'count' => 0, 'pattern' => 'localhost'),
				array('enable' => true, 'count' => 0, 'pattern' => 'loopback'),
				array('enable' => true, 'count' => 0, 'pattern' => 'input_file'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'execute'),
				array('enable' => true, 'count' => 0, 'pattern' => 'mosconfig'),
				array('enable' => true, 'count' => 0, 'pattern' => 'path=.'),
				array('enable' => true, 'count' => 0, 'pattern' => 'mod=.'),
				array('enable' => true, 'count' => 0, 'pattern' => 'wp-config.php'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'revslider'),
				array('enable' => true, 'count' => 0, 'pattern' => 'eval('),
				array('enable' => true, 'count' => 0, 'pattern' => 'base64('),
				array('enable' => true, 'count' => 0, 'pattern' => '@eval'),
				array('enable' => true, 'count' => 0, 'pattern' => 'base64_'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'phpinfo('),
				array('enable' => true, 'count' => 0, 'pattern' => 'shell_exec('),
				array('enable' => true, 'count' => 0, 'pattern' => 'benchmark('),
				array('enable' => true, 'count' => 0, 'pattern' => 'sleep('),
				array('enable' => true, 'count' => 0, 'pattern' => 'union('),
				
				array('enable' => true, 'count' => 0, 'pattern' => ')select'),
				array('enable' => true, 'count' => 0, 'pattern' => 'file_get_contents'),
				array('enable' => true, 'count' => 0, 'pattern' => 'allow_url_include'),
				array('enable' => true, 'count' => 0, 'pattern' => 'disable_functions'),
				array('enable' => true, 'count' => 0, 'pattern' => 'auto_prepend_file'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'open_basedir'),
				array('enable' => true, 'count' => 0, 'pattern' => 'indoxploi'),
				array('enable' => true, 'count' => 0, 'pattern' => 'xrumer'),
				
			),
			
			'user_agent' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => 'binlar'),
				array('enable' => true, 'count' => 0, 'pattern' => 'casper'),
				array('enable' => true, 'count' => 0, 'pattern' => 'cmswor'),
				array('enable' => true, 'count' => 0, 'pattern' => 'diavol'),
				array('enable' => true, 'count' => 0, 'pattern' => 'dotbot'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'finder'),
				array('enable' => true, 'count' => 0, 'pattern' => 'flicky'),
				array('enable' => true, 'count' => 0, 'pattern' => 'nutch'),
				array('enable' => true, 'count' => 0, 'pattern' => 'planet'),
				array('enable' => true, 'count' => 0, 'pattern' => 'purebot'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'pycurl'),
				array('enable' => true, 'count' => 0, 'pattern' => 'skygrid'),
				array('enable' => true, 'count' => 0, 'pattern' => 'sucker'),
				array('enable' => true, 'count' => 0, 'pattern' => 'turnit'),
				array('enable' => true, 'count' => 0, 'pattern' => 'vikspi'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'zmeu'),
				array('enable' => true, 'count' => 0, 'pattern' => 'comodo'),
				array('enable' => true, 'count' => 0, 'pattern' => 'feedfinder'),
				array('enable' => true, 'count' => 0, 'pattern' => 'kmccrew'),
				array('enable' => true, 'count' => 0, 'pattern' => 'email'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'acapbot'),
				array('enable' => true, 'count' => 0, 'pattern' => 'morfeus'),
				array('enable' => true, 'count' => 0, 'pattern' => 'semalt'),
				array('enable' => true, 'count' => 0, 'pattern' => 'snoopy'),
				array('enable' => true, 'count' => 0, 'pattern' => 'sitesucker'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'shellshock'),
				array('enable' => true, 'count' => 0, 'pattern' => 'md5sum'),
				array('enable' => true, 'count' => 0, 'pattern' => '/bin/bash'),
				
			),
		),
		
		'advanced' => array(
			
			'request_uri' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => '/bitrix/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/fckeditor/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/httpdocs/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/tmp/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/http/'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/https/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/ima/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/ucp/'),
				array('enable' => true, 'count' => 0, 'pattern' => '{0}'),
				array('enable' => true, 'count' => 0, 'pattern' => '/$&'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/($)/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/(*)/'),
				array('enable' => true, 'count' => 0, 'pattern' => '/dbscripts'),
				array('enable' => true, 'count' => 0, 'pattern' => '.php/index.php/index'),
				array('enable' => true, 'count' => 0, 'pattern' => '/yabb.'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'muieblack'),
				array('enable' => true, 'count' => 0, 'pattern' => '/playing.php'),
				array('enable' => true, 'count' => 0, 'pattern' => 'labels.rdf'),
				array('enable' => true, 'count' => 0, 'pattern' => 'function()'),
				array('enable' => true, 'count' => 0, 'pattern' => '{$itemURL}'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'indonesia.htm'),
				array('enable' => true, 'count' => 0, 'pattern' => 'com_crop'),
				array('enable' => true, 'count' => 0, 'pattern' => '/ref.outcontrol'),
				array('enable' => true, 'count' => 0, 'pattern' => 'msnbot.htm)._'),
				array('enable' => true, 'count' => 0, 'pattern' => '/function.array-rand'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '.well-known/host-meta'),
				array('enable' => true, 'count' => 0, 'pattern' => '/function.parse-url'),
				array('enable' => true, 'count' => 0, 'pattern' => '_vti_'),
				array('enable' => true, 'count' => 0, 'pattern' => 'e107_'),
				array('enable' => true, 'count' => 0, 'pattern' => 'wwwroot'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/contac.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/fpw.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/install.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/register.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/phpinfo.php'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/php-info.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/sqlpatch.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/webshell.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/iprober.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/curltest.php'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/phpspy.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/mobiquo.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/dompdf.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/0day.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/3xp.php'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/70bex.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/70be.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/_mm'),
				array('enable' => true, 'count' => 0, 'pattern' => '/cgi-'),
				array('enable' => true, 'count' => 0, 'pattern' => '.rar'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '.mdb'),
				array('enable' => true, 'count' => 0, 'pattern' => '.cfg'),
				array('enable' => true, 'count' => 0, 'pattern' => '.git'),
				array('enable' => true, 'count' => 0, 'pattern' => '.hg'),
				array('enable' => true, 'count' => 0, 'pattern' => '.out'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '.swp'),
				array('enable' => true, 'count' => 0, 'pattern' => 'sleep('),
				array('enable' => true, 'count' => 0, 'pattern' => 'benchmark('),
				array('enable' => true, 'count' => 0, 'pattern' => '&pws=0'),
				array('enable' => true, 'count' => 0, 'pattern' => '.bak'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/shell.php'),
				array('enable' => true, 'count' => 0, 'pattern' => '/bin/bash'),
				array('enable' => true, 'count' => 0, 'pattern' => '@@'),
				array('enable' => true, 'count' => 0, 'pattern' => '@eval'),
				array('enable' => true, 'count' => 0, 'pattern' => '/file:'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/php:'),
				array('enable' => true, 'count' => 0, 'pattern' => '.cmd'),
				array('enable' => true, 'count' => 0, 'pattern' => '.bat'),
				array('enable' => true, 'count' => 0, 'pattern' => '.htacc'),
				array('enable' => true, 'count' => 0, 'pattern' => '.htpas'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '.pass'),
				array('enable' => true, 'count' => 0, 'pattern' => 'usr/bin/perl'),
				array('enable' => true, 'count' => 0, 'pattern' => 'var/lib/php'),
				
			),
			
			'query_string' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => 'GLOBALS='),
				array('enable' => true, 'count' => 0, 'pattern' => 'GLOBALS['),
				array('enable' => true, 'count' => 0, 'pattern' => 'GLOBALS%'),
				array('enable' => true, 'count' => 0, 'pattern' => 'REQUEST='),
				array('enable' => true, 'count' => 0, 'pattern' => 'REQUEST['),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'REQUEST%'),
				array('enable' => true, 'count' => 0, 'pattern' => 'boot.ini'),
				array('enable' => true, 'count' => 0, 'pattern' => 'etc/passwd'),
				array('enable' => true, 'count' => 0, 'pattern' => 'base64_encode'),
				array('enable' => true, 'count' => 0, 'pattern' => 'javascript:'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '`'),
				array('enable' => true, 'count' => 0, 'pattern' => '<'),
				array('enable' => true, 'count' => 0, 'pattern' => '>'),
				array('enable' => true, 'count' => 0, 'pattern' => '['),
				array('enable' => true, 'count' => 0, 'pattern' => ']'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '{'),
				array('enable' => true, 'count' => 0, 'pattern' => '}'),
				array('enable' => true, 'count' => 0, 'pattern' => '?'),
				array('enable' => true, 'count' => 0, 'pattern' => '/config.'),
				array('enable' => true, 'count' => 0, 'pattern' => '/wwwroot'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '/makefile'),
				array('enable' => true, 'count' => 0, 'pattern' => '$_session'),
				array('enable' => true, 'count' => 0, 'pattern' => '$_request'),
				array('enable' => true, 'count' => 0, 'pattern' => '$_env'),
				array('enable' => true, 'count' => 0, 'pattern' => '$_server'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '$_post'),
				array('enable' => true, 'count' => 0, 'pattern' => '$_get'),
				array('enable' => true, 'count' => 0, 'pattern' => '@@'),
				array('enable' => true, 'count' => 0, 'pattern' => '(0x'),
				array('enable' => true, 'count' => 0, 'pattern' => '0x3c62723e'),
				
				array('enable' => true, 'count' => 0, 'pattern' => ';!--='),
				
			),
			
			'user_agent' => array(
				
				array('enable' => true, 'count' => 0, 'pattern' => '<'),
				array('enable' => true, 'count' => 0, 'pattern' => '>'),
				array('enable' => true, 'count' => 0, 'pattern' => 'xv6875)'),
				array('enable' => true, 'count' => 0, 'pattern' => '3gse'),
				array('enable' => true, 'count' => 0, 'pattern' => '4all'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '$x0E'),
				array('enable' => true, 'count' => 0, 'pattern' => '@$x'),
				array('enable' => true, 'count' => 0, 'pattern' => '!susie'),
				array('enable' => true, 'count' => 0, 'pattern' => '_irc'),
				array('enable' => true, 'count' => 0, 'pattern' => '_works'),
				
				array('enable' => true, 'count' => 0, 'pattern' => '+select+'),
				array('enable' => true, 'count' => 0, 'pattern' => '+union+'),
				array('enable' => true, 'count' => 0, 'pattern' => '&lt;?'),
				array('enable' => true, 'count' => 0, 'pattern' => '1,1,1,'),
				array('enable' => true, 'count' => 0, 'pattern' => 'icarus6j'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'queryseeker'),
				array('enable' => true, 'count' => 0, 'pattern' => 'siclab'),
				array('enable' => true, 'count' => 0, 'pattern' => 'checkprivacy'),
				array('enable' => true, 'count' => 0, 'pattern' => 'curious'),
				array('enable' => true, 'count' => 0, 'pattern' => 'seekerspider'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'jakarta'),
				array('enable' => true, 'count' => 0, 'pattern' => 'libwww'),
				array('enable' => true, 'count' => 0, 'pattern' => 'mj12'),
				array('enable' => true, 'count' => 0, 'pattern' => 'zune'),
				array('enable' => true, 'count' => 0, 'pattern' => 'archiver'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'clshttp'),
				array('enable' => true, 'count' => 0, 'pattern' => 'curl'),
				array('enable' => true, 'count' => 0, 'pattern' => 'extract'),
				array('enable' => true, 'count' => 0, 'pattern' => 'grab'),
				array('enable' => true, 'count' => 0, 'pattern' => 'youda'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'harvest'),
				array('enable' => true, 'count' => 0, 'pattern' => 'httrack'),
				array('enable' => true, 'count' => 0, 'pattern' => 'loader'),
				array('enable' => true, 'count' => 0, 'pattern' => 'miner'),
				array('enable' => true, 'count' => 0, 'pattern' => 'nikto'),
				
				array('enable' => true, 'count' => 0, 'pattern' => 'python'),
				array('enable' => true, 'count' => 0, 'pattern' => 'scan'),
				array('enable' => true, 'count' => 0, 'pattern' => 'wget'),
				array('enable' => true, 'count' => 0, 'pattern' => 'winhttp'),
				
			),
			
		),
		
		'custom' => array(
			
			'request_uri'  => array(),
			'query_string' => array(),
			'user_agent'   => array(),
			'ip_address'   => array(),
			'referrer'     => array(),
			
		),
		
	);
	
}
