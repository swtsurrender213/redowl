jQuery.ready(function(){
	
		jQuery('ul.sf-menu').superfish({
			animation: {height:'show'},	// slide-down effect without fade-in
			delay:		 1200			// 1.2 second delay on mouseout
		});
	
	 jQuery('input[type="text"]').addClass('form-control');
	 jQuery('input[type="text"]').wrap('<div class="form-group"></div>');
	 jQuery('textarea').addClass('form-control');
	 jQuery('input[type="submit"]').addClass('btn btn-primary');
	
});