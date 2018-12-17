<?php // BBQ Pro - BBQ Core

if (!defined('ABSPATH')) exit;

if (!class_exists('BBQ_Core')) {
	
	final class BBQ_Core {
	
		private static $instance;
		
		public static function instance() {
			
			if (!isset(self::$instance) && !(self::$instance instanceof BBQ_Core)) {
				
				self::$instance = new BBQ_Core;
				
				add_action('plugins_loaded', array(self::$instance, 'scan'));
			}
			
			return self::$instance;
		}
		
		public function scan() {
			
			global $bbq_options, $bbq_patterns;
			
			$disable_for_logged_in_users = isset($bbq_options['logged_users']) ? $bbq_options['logged_users'] : false;
			
			if ($disable_for_logged_in_users && is_user_logged_in()) return;
			
			list ($request_uri, $query_string, $user_agent, $referrer, $protocol, $ip_address, $the_request) = self::get_vars();
			
			if (self::whitelist_ip($ip_address)) return;
			
			$limit_request_length = isset($bbq_options['limit_request']) ? $bbq_options['limit_request'] : false; 
			
			if ($limit_request_length && self::check_length($the_request)) $bbq = true;
			
			elseif ($match = self::loop($request_uri, $query_string, $user_agent, $referrer, $ip_address)) $bbq = true;
			
			else $bbq = false;
			
			do_action('bbq_scan', $match, $request_uri, $query_string, $user_agent, $referrer, $protocol, $ip_address, $the_request);
			
			if ($bbq) self::bbq($protocol, $match);
			
			return false;
		}
		
		public function loop($request_uri, $query_string, $user_agent, $referrer, $ip_address) {
			
			global $bbq_options, $bbq_patterns;
			
			foreach ((array) $bbq_patterns as $key => $value) {
				
				if (!$bbq_options['basic_rules']    && $key === 'basic')    continue;
				if (!$bbq_options['advanced_rules'] && $key === 'advanced') continue;
				if (!$bbq_options['custom_rules']   && $key === 'custom')   continue;
				
				foreach ($value as $k => $v) {
					
					foreach ($v as $id => $array) {
						
						if (!isset($array['enable']) || !$array['enable'] || !isset($array['pattern'])) continue;
						
						if (isset($array['pattern']) && empty($array['pattern'])) continue;
						
						if (isset($bbq_options['strict_mode']) && $bbq_options['strict_mode']) ${$k} = rawurldecode(${$k});
						
						if (stripos(${$k}, $array['pattern']) !== false) {
							
							$bbq_patterns[$key][$k][$id]['count'] = (int) $array['count'] + 1;
							
							$update = update_option('bbq_patterns', $bbq_patterns, true);
							
							return $array['pattern'];
						}
					}
				}
			}
			
			return false;
		}
		
		public function whitelist_ip($ip_address) {
			
			global $bbq_options;
			
			$wildcard = apply_filters('bbq_wildcard', ''); // use $ to disable wildcard matching
			
			$whitelist_ips = isset($bbq_options['whitelist_ips']) ? $bbq_options['whitelist_ips'] : '';
			$whitelist_ips = array_filter(array_map('trim', explode(',', $whitelist_ips)));
			
			foreach ($whitelist_ips as $ip) {
				
				if (strpos($ip, '/') === false) {
					
					if (empty($wildcard)) {
						
						if (substr($ip_address, 0, strlen($ip)) === $ip) {
							
							return true;
							
						}
						
					} elseif ($wildcard === '$') {
						
						if ($ip_address === $ip) {
							
							return true;
							
						}
						
					}
					
				} else {
					
					if (self::ip_in_range($ip_address, $ip)) {
						
						return true;
						
					}
					
				}
				
			}
			
			return false;
			
		}
		
		public function ip_in_range($ip, $range) {
			
			list($range, $netmask) = explode('/', $range, 2);
			
			$range_decimal = ip2long($range);
			
			$ip_decimal = ip2long($ip);
			
			$wildcard_decimal = pow(2, (32 - $netmask)) - 1;
			
			$netmask_decimal = ~ $wildcard_decimal;
			
			return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
			
		}
		
		public function check_length($request_uri) {
			
			$max_length = apply_filters('bbq_check_length', 255);
			
			if (strlen($request_uri) > $max_length) return true;
			
			return false;
		}
		
		public function bbq($protocol, $match) {
			
			global $bbq_options;
			
			$status = ' 403 Forbidden';
			
			if (isset($bbq_options['status_code']) && !empty($bbq_options['status_code'])) {
				
				$status = ' '. sanitize_text_field($bbq_options['status_code']);
			}
			
			$redirect = false;
			
			if (isset($bbq_options['redirect_url']) && filter_var($bbq_options['redirect_url'], FILTER_VALIDATE_URL)) {
				
				$redirect = esc_url_raw($bbq_options['redirect_url']);
			}
			
			$message = '';
			
			if (isset($bbq_options['custom_message']) && !empty($bbq_options['custom_message'])) {
				
				$allowed_tags = wp_kses_allowed_html('post');
				
				$message = wp_kses(stripslashes_deep($bbq_options['custom_message']), $allowed_tags);
				
				$message = preg_replace('/\%s/', $match, $message);
			}
			
			if ($redirect) {
				
				header($protocol . $status);
				header('Location: '. $redirect);
				exit;
				
			} else {
				
				header($protocol . $status);
				header('Connection: Close');
				die($message);
				
			}
		}
		
		public function get_vars() {
			
			$the_request = isset($_SERVER['REQUEST_URI'])     && !empty($_SERVER['REQUEST_URI'])     ? $_SERVER['REQUEST_URI']     : false;
			$user_agent  = isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : false;
			$referrer    = isset($_SERVER['HTTP_REFERER'])    && !empty($_SERVER['HTTP_REFERER'])    ? $_SERVER['HTTP_REFERER']    : false;
			$protocol    = isset($_SERVER['SERVER_PROTOCOL']) && !empty($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
			
			list ($request_uri, $query_string) = self::get_strings($the_request);
			
			$ip_address = self::get_ip();
			
			return apply_filters('bbq_request_array', array($request_uri, $query_string, $user_agent, $referrer, $protocol, $ip_address, $the_request));
		}
		
		public function get_strings($the_request) {
			
			$strings = explode('?', $the_request, 2);
			
			$request_uri  = isset($strings[0]) ? $strings[0] : false;
			$query_string = isset($strings[1]) ? $strings[1] : false;
			
			return array($request_uri, $query_string);
		}
		
		public function get_ip() {
			
			$ip = self::evaluate_ip();
			
			if (preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $ip, $ip_match)) {
				
				$ip = $ip_match[1];
				
			}
			
			return sanitize_text_field($ip);
			
		}
		
		public function evaluate_ip() {
			
			$ip_keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_X_REAL_IP', 'HTTP_X_COMING_FROM', 'HTTP_PROXY_CONNECTION', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_COMING_FROM', 'HTTP_VIA', 'REMOTE_ADDR');
			
			$ip_keys = apply_filters('bbq_ip_keys', $ip_keys);
			
			foreach ($ip_keys as $key) {
				
				if (array_key_exists($key, $_SERVER) === true) {
					
					foreach (explode(',', $_SERVER[$key]) as $ip) {
						
						$ip = trim($ip);
						
						$ip = self::normalize_ip($ip);
						
						if (self::validate_ip($ip)) {
							
							return $ip;
							
						}
						
					}
					
				}
				
			}
			
			return esc_html__('Error: Invalid IP Address', 'bbq-pro');
			
		}
		
		public function normalize_ip($ip) {
			
			if (strpos($ip, ':') !== false && substr_count($ip, '.') == 3 && strpos($ip, '[') === false) {
				
				// IPv4 with port (e.g., 123.123.123:80)
				$ip = explode(':', $ip);
				$ip = $ip[0];
				
			} else {
				
				// IPv6 with port (e.g., [::1]:80)
				$ip = explode(']', $ip);
				$ip = ltrim($ip[0], '[');
				
			}
			
			return $ip;
			
		}
		
		public function validate_ip($ip) {
			
			$options  = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
			
			$options  = apply_filters('bbq_ip_filter', $options);
			
			$filtered = filter_var($ip, FILTER_VALIDATE_IP, $options);
			
			 if (!$filtered || empty($filtered)) {
				
				
				if (preg_match("/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/", $ip)) {
					
					return $ip; // IPv4
					
				} elseif (preg_match("/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/", $ip)) { 
					
					return $ip; // IPv6
					
				}
				
				// error_log(__('BBQ Pro: Invalid IP Address: ', 'bbq-pro') . $ip);
				
				return false;
				
			}
			
			return $filtered;
			
		}
		
	}
}
