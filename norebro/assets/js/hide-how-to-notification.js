jQuery(function($){
	"use strict";

	$('body').on('click', '#close_norebro_how_to', function() {
		$(this).closest( '.norebro-admin-notif' ).slideUp( 500 );
		var expdate = new Date( new Date().getTime() + 5 * 60 *1000 );
		document.cookie = 'norebro_how_to_closed=yep; path=/; expires=' + expdate.toUTCString();
		return false;
	});

});