// BBQ Pro - Patterns UI

jQuery(document).ready(function($) {
	
	// Add Patterns
	
	var bbqid_query_string = parseInt($('.bbq-clone-query_string').data('id'));
	var bbqid_request_uri  = parseInt($('.bbq-clone-request_uri').data('id'));
	var bbqid_user_agent   = parseInt($('.bbq-clone-user_agent').data('id'));
	var bbqid_ip_address   = parseInt($('.bbq-clone-ip_address').data('id'));
	var bbqid_referrer     = parseInt($('.bbq-clone-referrer').data('id'));
	
	$('.bbq-add-field').on('click', function(e) {
		
		e.preventDefault();
		
		var bbqid = null;
		var type = $(this).data('type');
		
		if (type == 'query_string') {
			bbqid_query_string += 1;
			bbqid = bbqid_query_string;
			
		} else if (type == 'request_uri') {
			bbqid_request_uri += 1;
			bbqid = bbqid_request_uri;
			
		} else if (type == 'user_agent') {
			bbqid_user_agent += 1;
			bbqid = bbqid_user_agent;
			
		} else if (type == 'ip_address') {
			bbqid_ip_address += 1;
			bbqid = bbqid_ip_address;
			
		} else if (type == 'referrer') {
			bbqid_referrer += 1;
			bbqid = bbqid_referrer;
		}
		
		var list = '.bbq-patterns-' + type;
		var html = $(list +' .bbq-clone').html();
		var html = html.replace(/bbqid/g, bbqid);
		
		$(list).append('<tr>'+ html +'</tr>');
	});
	
	// Toggle Sections
	
	$('.default-hidden').hide();
	
	$('.bbq-toggle-all').click(function(e) {
		
		e.preventDefault();
		
		$('.bbq-toggle').slideToggle(200);
	});
	
	$('.postbox h3').click(function() {
		
		$(this).next().slideToggle(200);
	});
	
	// Select All
	
	$('.bbq-select-all').click(function() {
		
		var status = this.checked;
		var type = $(this).data('type');
		
		$('.bbq-patterns-'+ type).find('td :checkbox').each(function() {
			
			$(this).prop('checked', status);
		});
	});
	
	// Toggle Count
	
	$('.bbq-toggle-count').click(function() {
		
		var type = $(this).data('type');
		
		$('.bbq-patterns-'+ type +' tr:not(.bbq-header) td:last-child').toggle(0);
	});
	
	// URL Preview
	
	$('.bbq-pattern').on('keyup', function() {
		
		 $(this).parents('tr:first').find('td a.bbq-test').attr('href', bbq_home_url + $(this).val());
	});
	
});
