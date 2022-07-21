(function ($) {
	"use strict";

	// Quantities - plus, minus
	$("body").on("click", ".woo-quantity .plus", function(){
		var input = $(this).parent().find("input");

		if(input.attr("max") != input.attr("value")){
			input.attr("value", parseInt(input.attr("value")) + 1);
		}

		input.trigger('change');
	});

	$("body").on("click", ".woo-quantity .minus", function(){
		var input = $(this).parent().find("input");
		if(input.attr("min") != input.attr("value") && parseInt(input.attr("value")) > 1 ){
			input.attr("value", parseInt(input.attr("value")) - 1);
		}

		input.trigger('change');
	});

	// Fixed wishlist button in single page
	if($('.summary .yith-wcwl-add-to-wishlist').length) {
		$('.single_add_to_cart_button').after($('.summary .yith-wcwl-add-to-wishlist').clone());
		$('.summary .yith-wcwl-add-to-wishlist').eq(1).remove();
	}

	var checkoutFormRight = function(){
		var order = $("#order_review"), customer = $('#customer_details');

		if( order && customer){
			var cHeight = customer.outerHeight();
			var oHeight = order.outerHeight();

			$(".wc-checkout-wrap").css("min-height", ((cHeight > oHeight) ? cHeight : oHeight) + 100 + "px");
		}
	};

	// Reviews link
	$("a.woo-review-link").on("click", function(){
		var reviewTab = $('#accordion-reviews');

		if ( reviewTab.length ) {
			reviewTab.closest('.accordion-box')[0].accordionToggle( reviewTab.closest('.item').index() );

			$('.woo-summary-content').animate({
				scrollTop: $(".accordion-box").offset().top - 170
			}, 800);
		}
	});

	$('.norebro-slider .woo-products').removeClass('norebro-masonry');

	// Single product price
	var fixedPrice = function(price){
		var ins = price.find('ins');
		var del = price.find('del');

		if( price.length && ins.length == 1 && del.length && price.find('.price-percent').length == 0 ) {
			var regular = parseInt(del.text().match(/(\d|\.)+/g)[0]);
			var sale = parseInt(ins.text().match(/(\d|\.)+/g)[0]);
			var percent = $(document.createElement('div'));

			if ( price.find('.amount').length == 2 ) {
				var saleText = 'SALE';
				if( price.attr('data-sale-text') ) {
					saleText = price.attr('data-sale-text');
				}
				percent.addClass('price-percent').html( '-' + parseInt( 100 - sale * 100 / regular ) + '% ' + saleText );
				price.append(percent);
			}

			del.insertAfter(ins);
		}
	};

	// Single product slider
	var handleSingleProduct = function(){
		if ( $(window).width() > 768 ){

			var image = $('.woocommerce-product-gallery__wrapper img')

			image.each(function(){
				var self = $(this);
				var imgWidth = $(this).width();
				var imgHeight = $(this).height();
				var containerWidth = $('.slider').width();
				var containerHeight = $('.slider').height();
				var newPosition = 0;

				if( imgWidth > imgHeight ||  imgWidth == imgHeight) {
					$(this).addClass('horizontal-img');
				}
				
				centeredImage(self, imgWidth, imgHeight, containerHeight, containerWidth, newPosition);
			});
		}

		function centeredImage(self, imgWidth, imgHeight, containerHeight, containerWidth, newPosition){
			if ( imgWidth < imgHeight ){

				newPosition = (imgHeight - containerHeight) / 2;
				self.css("transform", "translatey(-" + newPosition + "px)");

			}
			else {

				imgWidth = self.width();

				if( imgWidth < containerWidth ) {

					self.css({'width': '100%'});
					imgWidth = self.width();
					newPosition = (containerWidth - imgWidth ) / 2;
					self.css("transform", "translatex(-" + newPosition + "px)");

				}
				else {
					
					newPosition = (imgWidth - containerWidth) / 2;
					self.css("transform", "translatex(-" + newPosition + "px)");
					
				}

			}
		}
	};



	function refreshWooCategory(){
		$('li.product-category').each(function(){
			var info = $(this).find('.info-wrap'),
				contentCenter = $(this).find('.content-center');

			$(this).find('>.wrap').css('height','0');

			var ratio = $(this).width() / this.imgWidth;
			var padding = info.innerHeight() - info.height();
			var height = this.imgHeight * ratio;

			$(this).find('>.wrap').css({
				'height': height + 'px',
				'min-height': (contentCenter.outerHeight() + padding ) + 'px'
			});
		});
	}


	$(window).on('load', function(){

		// Shop product gallery
		$('[data-product-item] .slider').each(function(){
			if($(this).find('img').length > 1) {
				var slider = $(this);

				var options = {
					items: 1,
					slideBy: 1,
					nav: false,
					dots: true,
					loop: true,
					autoHeight: true
				};

				if( $(this).attr('data-autoplay') ){
					options.autoplay = true;
					options.autoplayTimeout = 5000;
					options.autoplayHoverPause = true;
					options.autoplaySpeed = 1000;
				}

				slider.owlCarousel( options );
			}
		});

		$('.woocommerce .images .slider, .woo-products .slider').addClass('visible');

		handleSingleProduct();
		fixedPrice( $('.product .summary p.price').eq(0) );

		// Change single product variations price
		$('.variations select').on('change', function(){
			setTimeout(function(){
				fixedPrice( $('.woo-variation-price') );
				handleSingleProduct();
			}, 10);
		});

		// If variation changed main image
		var mainImage = $('[data-wc-slider]').find('img').eq(0);
		var oldSrc = mainImage.attr('src');
		mainImage.on('load', function(){
			if( oldSrc != mainImage.attr('src') ){
				$('[data-wc-slider]').trigger('to.owl.carousel', [0, 0, true]);
				handleSingleProduct();
			}
		});

		fixedPrice( $('.woo-variation-price') );
		checkoutFormRight();

		// Magic woo category list
		$('li.product-category').each(function(){
			var img = $(this).find('img'),
				wrap = $(this).find('>.wrap');


			wrap.css({
				'background-image': 'url("' + img[0].src + '")',
				'height': wrap.height() + 'px'
			});

			this.imgWidth = img.width();
			this.imgHeight = img.height();

			img.remove();
		});
		refreshWooCategory();

		
		if($('[data-wc-slider] img').length > 1) {
			$('[data-wc-slider]').owlCarousel({
				items: 		1,
				slideBy: 	1,
				nav: 		false,
				dots: 		true,
				loop: 		false,
				autoHeight: true,
				autoplay: 	false,
				mouseDrag: 	true,
				touchDrag: 	true
			}).on('changed.owl.carousel', function(obj){
				var currentItem = obj.item.index;
				$('#product-thumbnails .image').removeClass('selected');
				$($('#product-thumbnails .image')[currentItem]).addClass('selected');
			});

			$('[data-wc-toggle-image]').on('click', function(){
				$('[data-wc-slider]').trigger('to.owl.carousel', [parseInt($(this).attr('data-wc-toggle-image')), 0, true]);
			});
		} else {
			$('[data-wc-slider]').addClass('empty');
		}
	});

	$(window).on('resize', function(){
		handleSingleProduct();
		checkoutFormRight();
		setTimeout( refreshWooCategory, 100 );
	});

	refreshWooCategory();


	// function updateOptions() {
	// 	$('.register_attr').empty();
    //     $.each( $('.custom_select'), function( index ) {
    //         console.log($(this));
    //         $.each( $(this).find('option'), function( index2 ) {
    //         	if (index2 > 0) {
	// 			$(this).closest('.custom_select').siblings('.register_attr').append('<a href="javascript:void(0);" class="variation_button">' +
	// 				'<span class="phoen_swatches">' + $(this).text() + '</span>' +
	// 				'</a>');
	// 			}
    //         });
    //     });
	// }
	//
	// $(document).on('change', '.custom_select select', function () {
    //     updateOptions();
    // });

    $(document).on('click', '.variation_button', function (event) {
        $(this).siblings('*').removeClass('selected').addClass('unselected');
        $(this).removeClass('unselected').addClass('selected');
        var select = $(this).closest('.variation').find('select');
        select.val($(this).find('span').attr('data-option'));
        select.trigger('change');
    });

    $('.reset_variations').on('click', function () {
		$('.variation_button').removeClass('selected').addClass('unselected');
    });
})(jQuery);