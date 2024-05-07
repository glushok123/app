(function ($) {
	"use strict";

    jQuery(document).ready(function($){

    	// Slicknav
		$('#main-menu').slicknav({
	        closeOnClick: true,
	        label: '',
	        appendTo:'.mobile-menu',
	    });


	    $(window).scroll(function(){

	    	// Sticky Nav
		    if ($(this).scrollTop() > 50) {
		       $('.sticky').addClass('active');
		    } else {
		       $('.sticky').removeClass('active');
		    }

		    // Scroll To Top Hide/Show
		    if ($(this).scrollTop() >= 1000) {        
		        $('#scroll-to-top').fadeIn(200);
		    } else {
		        $('#scroll-to-top').fadeOut(200);
		    }

		});


		// Scroll To Top Trigger
		$('#scroll-to-top').click(function() {      
		    $('body,html').animate({
		        scrollTop : 0
		    }, 500);
		});


		// Hero Slider
		$('.hero-slider').owlCarousel({
			loop: false,
			rewind: true,
			dots: false,
			nav: true,
			navText: ["<img src='assets/img/icons/arrow-prev.png'>","<img src='assets/img/icons/arrow-next.png'>"],
			responsiveClass: true,
			items: 1,
			onInitialized  : counter, //When the plugin has initialized.
			onTranslated : counter //When the translation of the stage has finished.
		});
		// Hero Slider Counter
		function counter(event) {
			var element   = event.target;         // DOM element, in this example .owl-carousel
			var items     = event.item.count;     // Number of items
			var item      = event.item.index + 1;     // Position of the current item

			// it loop is true then reset counter from 1
			if(item > items) {
				item = item - items
			}

			// Add 0 before one digit Counter
			function pad(number) {
			    return (number < 10 ? '0' : '') + number
			}

			$('.hero-counter').html(pad(item)+" <span>/ "+pad(items)+"</span>");
		}
		// Hero Slider Animation
		$(".hero-slider").on("translated.owl.carousel", function() {
			$(".hero-slider .hero-slider-item .hero-counter").addClass("animated slideInUp").css("opacity", "1");
			$(".hero-slider .hero-slider-item h1").addClass("animated fadeInLeft").css("opacity", "1");
			$(".hero-slider .hero-slider-item p").addClass("animated fadeInRight").css("opacity", "1");
			$(".hero-slider .hero-slider-item .btn").addClass("animated slideInDown").css("opacity", "1");
		});
		$(".hero-slider").on("translate.owl.carousel", function() {
			$(".hero-slider .hero-slider-item .hero-counter").removeClass("animated slideInUp").css("opacity", "0");
			$(".hero-slider .hero-slider-item h1").removeClass("animated fadeInLeft").css("opacity", "0");
			$(".hero-slider .hero-slider-item p").removeClass("animated fadeInRight").css("opacity", "0");
			$(".hero-slider .hero-slider-item .btn").removeClass("animated slideInDown").css("opacity", "0");
		});


		// Hero Slider Two
		$('.hero-slider-two').owlCarousel({
			loop: true,
			dots: false,
			nav: true,
			navText: ["<img src='assets/img/icons/arrow-prev-short.png'>","<img src='assets/img/icons/arrow-next-short.png'>"],
			responsiveClass: true,
			items: 1,
		});
		// Hero Slider Two Animation
		$(".hero-slider-two").on("translated.owl.carousel", function() {
			$(".hero-slider-two .hero-slider-item h1").addClass("animated flipInX").css("opacity", "1");
			$(".hero-slider-two .hero-slider-item p").addClass("animated fadeInUp").css("opacity", "1");
			$(".hero-slider-two .hero-slider-item .btn").addClass("animated fadeInUp").css("opacity", "1");
		});
		$(".hero-slider-two").on("translate.owl.carousel", function() {
			$(".hero-slider-two .hero-slider-item h1").removeClass("animated flipInX").css("opacity", "0");
			$(".hero-slider-two .hero-slider-item p").removeClass("animated fadeInUp").css("opacity", "0");
			$(".hero-slider-two .hero-slider-item .btn").removeClass("animated fadeInUp").css("opacity", "0");
		});


		// Hero Slider Three
		$('.hero-slider-three').owlCarousel({
			loop: true,
			dots: true,
			nav: false,
			responsiveClass: true,
			items: 1,
		});
		// Hero Slider Three Animation
		$(".hero-slider-three").on("translated.owl.carousel", function() {
			$(".hero-slider-three .hero-slider-item h1").addClass("animated fadeInDown").css("opacity", "1");
			$(".hero-slider-three .hero-slider-item p").addClass("animated fadeInUp").css("opacity", "1");
			$(".hero-slider-three .hero-slider-item .btn").addClass("animated fadeInUp").css("opacity", "1");
		});
		$(".hero-slider-three").on("translate.owl.carousel", function() {
			$(".hero-slider-three .hero-slider-item h1").removeClass("animated fadeInDown").css("opacity", "0");
			$(".hero-slider-three .hero-slider-item p").removeClass("animated fadeInUp").css("opacity", "0");
			$(".hero-slider-three .hero-slider-item .btn").removeClass("animated fadeInUp").css("opacity", "0");
		});


		// About Three Slider Three
		$('.about-three-slider').owlCarousel({
			loop: true,
			dots: true,
			nav: false,
			responsiveClass: true,
			items: 1,
		});


		// Stop Modal Video on Close
		$('.modal').on('hide.bs.modal', function(e) {    
		    var $if = $(e.delegateTarget).find('iframe');
		    var src = $if.attr("src");
		    $if.attr("src", '/empty.html');
		    $if.attr("src", src);
		});


		// PGW Slider
		$('.pgwSlider').pgwSlider();

		lightbox.option({
	      'resizeDuration': 500,
	      'wrapAround': true,
	      'alwaysShowNavOnTouchDevices': true,
	    });


	    // Testimonial Slider
	    $('.testimonial-carousel').owlCarousel({
		    loop: true,
		    margin: 30,
		    responsiveClass: true,
		    responsive: {
		        0: {
		            items: 1
		        },
		        600: {
		            items: 2
		        },
		        1000: {
		            items: 2
		        }
		    }
		});


	    // Testimonial Slider Two
	    $('.testimonial-carousel-two').owlCarousel({
		    loop: true,
		    margin: 30,
		    responsiveClass: true,
		    items: 1,
		});


	    // Testimonial Slider Three
	    $('.testimonial-carousel-three').owlCarousel({
		    loop: true,
		    responsiveClass: true,
		    items: 1,
		    dots: false,
			nav: true,
			navText: ["<img src='assets/img/icons/arrow-prev-short.png'>","<img src='assets/img/icons/arrow-next-short.png'>"],
		});


		// Single Portfolio Slider
		$('.single-portfolio-slider').owlCarousel({
			loop: true,
			dots: false,
			nav: true,
			navText: ["<img src='assets/img/icons/arrow-prev-short.png'>","<img src='assets/img/icons/arrow-next-short.png'>"],
			responsiveClass: true,
			items: 1,
		});


		// Header Search Form
		$("#search-modal-btn").on("click", function(e) {
			e.preventDefault();
			$(".search-modal-wrpr").addClass("active");
		});

		$('.search-modal-wrpr .close-icon').on('click', function() {
		  	$(".search-modal-wrpr").removeClass("active");
		});


		// Sliding Sidebar
		$("#sliding-sidebar-btn").on("click", function(e) {
			 e.preventDefault();
			$(".sliding-sidebar, .body-overlay").addClass("active");
		});
		$(".sliding-sidebar .close-icon").on("click", function() {
			$(".sliding-sidebar, .body-overlay").removeClass("active");
		});
		$(document).mouseup(function(e) 
		{
		    var container = $(".sliding-sidebar");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0) 
		    {
		        $(".sliding-sidebar, .body-overlay").removeClass("active");
		    }
		});


		// Smooth Scroll to Section
		$('.smooth-scroll').click(function(event) {
		    if (
		      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		      && 
		      location.hostname == this.hostname
		    ) {
		      var target = $(this.hash);
		      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		      if (target.length) {
		        event.preventDefault();
		        $('html, body').animate({
		          scrollTop: target.offset().top
		        }, 1000, function() {
		          var $target = $(target);
		          $target.focus();
		          if ($target.is(":focus")) { 
		            return false;
		          } else {
		            $target.attr('tabindex','-1');
		            $target.focus(); 
		          };
		        });
		      }
		    }
		});
		

		// Active WOW JS
		new WOW().init();


		// Hero Section One Background Parallax
		$("#hero-section-one-bg-parallax").paroller({ 
			factor: 0.5, 
			factorXs: 0.2, 
			type: 'background', 
			direction: 'vertical' 
		});


		// Hero Section Two Background Parallax
		$("#hero-section-two-bg-parallax").paroller({ 
			factor: 0.5, 
			factorXs: 0.2, 
			type: 'background', 
			direction: 'vertical' 
		});


		// Hero Section Three Background Parallax
		$("#hero-section-three-bg-parallax").paroller({ 
			factor: 0.5, 
			factorXs: 0.2, 
			type: 'background', 
			direction: 'vertical' 
		});


		// Active Count Down JS
		$('#countdown').countdown({
            year: 2022, // YYYY Format
            month: 1, // 1-12
            day: 1, // 1-31
            hour: 0, // 24 hour format 0-23
            minute: 0, // 0-59
            second: 0, // 0-59
        });

		
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
		
		
		
	     // Contact Form	
		jQuery(document).ready(function($) {

    // Добавляем маску для поля с номера телефона
    $('#phone').mask('+7 (999) 999-99-99');

    // Проверяет отмечен ли чекбокс согласия
    // с обработкой персональных данных
    $('#check').on('click', function() {
        if ($("#check").prop("checked")) {
            $('#button').attr('disabled', false);
        } else {
            $('#button').attr('disabled', true);
        }
    });

    // Отправляет данные из формы на сервер и получает ответ
    $('#contactForm').on('submit', function(event) {
        
        event.preventDefault();

        var form = $('#contactForm'),
            button = $('#button'),
            answer = $('#answer'),
            loader = $('#loader');


        $.ajax({
            url: '/feedback/create',
            type: 'POST',
            data: form.serialize(),
            beforeSend: function() {
                answer.empty();
                button.attr('disabled', true).css('margin-bottom', '20px');
                loader.fadeIn();
            },
            success: function(result) {
                loader.fadeOut(300, function() {
                    answer.text(result.text);
                });
                form.find('.form-control').val(' ');
                button.attr('disabled', false);
            },
            error: function() {
                loader.fadeOut(300, function() {
                    answer.text('Произошла ошибка! Попробуйте позже.');
                });
                button.attr('disabled', false);
            }
        });

    });
});
		
		
		

        // Contact Form
       	$('form[id="contact_form"]').validate({
			rules: {
				name: 'required',
				email: {
					required: true,
					email: true,
				},
				subject: 'required',
				message: 'required',
			},

			messages: {
				name: 'Введите ваше Имя',
				email: 'Enter a valid email.',
				subject: 'Enter your subject.',
				message: 'Write your message.',
				phone: 'Введите ваш номер телефона.',
			},
			submitHandler: function(form) {
				// start ajax request 
				$.ajax({
					type: "POST",
					url: "mail.php",
					data: $('#contact_form').serialize(),
					cache: false,
					success: function (data) {
						if(data == 'Y'){
							$("#message_sent").modal('show');
							$('#contact_form').trigger("reset");
						}
						else{
							$("#message_fail").modal('show');
						}
					}
				});
				
			}
		});	

    });


    jQuery(window).load(function(){

    	// Loading Spinner
    	$('.spinner-wrpr').fadeOut();

    	// Isotope Portfolio Item 
		$('.portfolio-item-list').isotope({
		  // options
		  itemSelector: '.portfolio-item',
		  percentPosition: true,
		  masonry: {
		    columnWidth: '.portfolio-item-sizer',
		    horizontalOrder: true
		  }
		});
		$('.portfolio-item-list').isotope();


		// Isotope Portfolio Filter Button 
		$('.portfolio-item-controls').on( 'click', 'button', function() {
		  var filterValue = $(this).attr('data-filter');
		  $('.portfolio-item-list').isotope({ filter: filterValue });
		});


		// Isotope Portfolio Filter Button Active Class 
		$('.portfolio-item-controls').each( function( i, buttonGroup ) {
		  var $buttonGroup = $( buttonGroup );
		  $buttonGroup.on( 'click', 'button', function() {
		    $buttonGroup.find('.active').removeClass('active');
		    $( this ).addClass('active');
		  });
		});
		
        
    });


}(jQuery));	