jQuery(function ($) {
	let note = sessionStorage.getItem('note_view');
	console.log('note '+note);
	if(note && note !== null){
		$('.header-hello-bar').hide();
	} else {
		$('.header-hello-bar').show();
	}
	jQuery(document).on('click','.pre-order-close_bar', function() {	
		sessionStorage.setItem('note_view', 'true');
		jQuery(".header-hello-bar").hide();
	});
	jQuery(document).on('click','.open-preorder', function() {	
		jQuery(".preorder-custom-model-main").show();
	});
	jQuery(document).on('click','.preorder-btn', function() {	
		jQuery(".preorder-custom-model-main").fadeOut();
		jQuery(".preorder-btn").attr('href',"/#buy-now");
		jQuery(".preorder-btn").trigger("click");
	});
	jQuery(document).on('click','.learn_more', function() {	
		$('.preorder-custom-model-main').show();
	});
	jQuery(document).on('click','.preorder-close-btn', function() {	
		$('.preorder-custom-model-main').hide();
	});	
	jQuery(document).on('click','.close__popup', function() {	
		$('.custom-model-main').fadeOut();
	});	
	jQuery(document).on('click','.learn_checkout_popup', function() {	
		$('.custom-model-main').css('display','flex');
	});	

});
