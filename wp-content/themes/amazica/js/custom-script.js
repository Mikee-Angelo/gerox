jQuery(document).ready(function($) {
    jQuery('.nav li.dropdown').find('.mobile-eve').each(function() {
        jQuery(this).on('click', function(event) {
            event.preventDefault();
            if (jQuery(window).width() < 768) {
                var nav = $(this).parent().parent();
                var dropdown = $(this).parent().siblings('.dropdown-menu');
                if (nav.hasClass('show')) {
                    nav.removeClass('show');
                    dropdown.removeClass('show');
                } else {
                    nav.addClass('show');
                    dropdown.addClass('show');
                }
            }
            return false;
        });
    });


    $(window).scroll(function() {
        if ($(window).width() > 768) {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass('sticky-head');
            } else {
                $('.site-header').removeClass('sticky-head');
            }
        } else {
            if ($(this).scrollTop() > 100) {
                $('.site-header').addClass('sticky-head');
            } else {
                $('.site-header').removeClass('sticky-head');
            }
        }
    });

    $(document).on('click', '.product-categories .cat-parent', function(event) {
        event.preventDefault();
        if ($(this).hasClass('show-cat-child')) {
            $(this).removeClass('show-cat-child');
        } else {
            $(this).addClass('show-cat-child');
        }
    });
    var is_rtl = amazica_script_obj.rtl;
    is_rtl = (is_rtl)?true:false;
    window.home_carousel = $('.home-carousel').owlCarousel({
        rtl:is_rtl,
        nav: true,
        loop: true,
        margin: 10,
        responsiveClass: true,
        smartSpeed:1000,
        items: 1,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
    });

    $('.shop-swiper').owlCarousel({
        rtl:is_rtl,
        nav: true,
        loop: true,
        margin: 10,
        responsiveClass: true,
        items: 1,
        lazyLoad: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    $('.home-blog-carousel').owlCarousel({
        rtl:is_rtl,
        nav: false,
        dots:false,
        loop: true,
        margin: 10,
        responsiveClass: true,
        items: 3,
        lazyLoad: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots:true,
            },
            578: {
                items: 2,
            },
            768: {
                items: 3,
            },
        },
        autoplay:true,
        autoplaySpeed:2000,
    });

    var homeSliderHeight = $('.home-swiper').height();
    $('.home-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (homeSliderHeight > captionHeight) {
            top = ((homeSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });

    var shopSliderHeight = $('.shop-swiper').height();
    $('.shop-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (shopSliderHeight > captionHeight) {
            top = ((shopSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });

    var blogSliderHeight = $('.blog-swiper').height();
    $('.blog-swiper').find('.carousel-caption').each(function(index, el) {
        var captionHeight = $(this).outerHeight();
        var top = 0;
        if (blogSliderHeight > captionHeight) {
            top = ((blogSliderHeight - captionHeight) / 2);
        } else {
            top = 1;
        }
        top = parseInt(top);
        $(this).css('top', top + 'px');
    });


    var product_carasol = $('.product-carasol').owlCarousel({
        rtl:is_rtl,
        nav: true,
        loop: true,
        margin: 15,
        responsiveClass: true,
        items: 4,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        },
        autoplay:true,
        autoplaySpeed:1500,
    });

    window.brand_carousel = $('.brand-carousel').owlCarousel({
        rtl:is_rtl,
        nav: true,
        loop: true,
        margin: 15,
        responsiveClass: true,
        items: 5,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        }
    });



    window.testimonial_carousel = $('.testimonial-carousel').owlCarousel({
        rtl:is_rtl,
        items: 1,
        loop: true,
        center: true,
        margin: 15,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: true,
        dots:false,
    });

    $('.nav-pills a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    
    /* Lignt Box*/
    var gallery = $('.posts-index .the-post-img').simpleLightbox();
    var gallery = $('.blog-details .the-post-img').simpleLightbox();
    

    new WOW().init();

    /* Scroll Top */
    var amountScrolled = 500;
    jQuery(window).scroll(function() {
        if (jQuery(window).scrollTop() > amountScrolled) {
            jQuery('a#scroll-top').fadeIn('fast');
        } else {
            jQuery('a#scroll-top').fadeOut('fast');
        }
    });

    jQuery('a#scroll-top').click(function(e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
    /* Scroll Top */

    
    $(document).on('click', '#primary-menu a', function(event) {
        var sec_id = $(this).attr('href');
        if(sec_id.indexOf('#') !== -1){
            event.preventDefault();
            if($(sec_id).length){
                jQuery('html, body').animate({
                    scrollTop: sec_id
                }, 700);
            }else{
                var sec_class = sec_id.replace("#", ".section-");
                if($(sec_class).length){
                    jQuery('html, body').animate({
                        scrollTop: $(sec_class).offset().top - 50
                    }, 700);
                }
            }            
        }
    });

});