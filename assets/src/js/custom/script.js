(function ($) {

    'use strict';

    $(document).ready(function () {


        /*
        =========================
        = Tooltip
        ==================================
        */

        tippy('.tool-tip', {

            content: "",
            delay: 50,
            arrow: true,
            arrowType: 'sharp',
            size: 'large',
            duration: 500,
            animation: 'scale'
        });


        /*
        ===========================
        = Main navigation
        ====================================
        */


        $('.menu-toggle').on('click', function (e) {

            $('#site-navigation').slideToggle('medium');

            $('body').toggleClass('menu-toggle-active'); // add class to body

        });

        $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-caret-down" aria-hidden="true"></i> </span>');

        $('#site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-caret-down" aria-hidden="true"></i> </span>');


        $('#site-navigation .sub-toggle').on('click', function () {

            $(this).toggleClass('active-submenu');

            $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('medium');

            $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('medium');

            if ($(this).hasClass('active-submenu')) {

                $(this).find('.fa').removeClass('fa-caret-down').addClass('fa-caret-up');

            } else {

                $(this).find('.fa').removeClass('fa-caret-up').addClass('fa-caret-down');
            }

        });


        $('.menu-item a[href="#"]').on('click', function (e) {

            e.preventDefault(); // prevent empty links clicks
        });


        // Append search icon at the end of menu item.

        $('#site-navigation .primary-menu').append('<li id="menu-item-search"><a href="#" class="fb-search"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a></li>');

        // Open and close search modal.

        $('body').on('click', '.fb-search', function (e) {
            e.preventDefault();
            let searchModal = $('.search-area-container');
            if(searchModal.length > 0){
                searchModal.removeClass('hide-search').addClass('show-search');
                let searchInput = searchModal.find('input[type="search"]');
                if(searchInput.length > 0){
                    searchInput.focus();
                }
            }
        });

        $('body').on('click', '.search-close', function (e) {
            e.preventDefault();
            let searchModal = $('.search-area-container');
            if (searchModal.length > 0){
                searchModal.removeClass('show-search');
                searchModal.addClass('hide-search');
            }
        });


        /*
        =========================
        = Canvas toggle aside
        ========================================
        */

        // Comment canvas 

        var $CanvasRevelBtn = $('#load-comments');
        var $CanvasAside = $('#comment-canvas');
        var $SideCanvasMask = $('.canvas-aside-mask');

        $CanvasRevelBtn.on('click', function () {

            $CanvasAside.addClass('visible');
            $SideCanvasMask.addClass('visible');
        });

        $SideCanvasMask.on('click', function () {

            $CanvasAside.removeClass('visible');
            $SideCanvasMask.removeClass('visible');

        });

        /*
        ===========================
        = Sticky sidebar
        ==========================================
        */

        if (window.matchMedia("(max-width: 991px)").matches) {

            $(".col-lg-8").removeClass("sticky-portion");

        } else {

            $('.sticky-portion').theiaStickySidebar({

                additionalMarginTop: 30

            });
        }


        /*
        ===========================
        = Banner sliders
        ====================================
        */

        // check banner init condition 

        if ($('body').hasClass('boxed')) {

            $("body .slider-tweak").removeClass('slider-1');
            $("body .slider-tweak").addClass('slider-1-single');

        }


        // init banner 1 with 3 slides

        $('.slider-1').slick({

            centerMode: true,
            centerPadding: '400px',
            dots: false,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            speed: 2000,
            nextArrow: ' <a class="slick-nav slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>',
            prevArrow: ' <a class="slick-nav slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>',
            responsive: [{
                breakpoint: 1400,
                settings: {

                    slidesToShow: 1,
                    centerPadding: '250px',

                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    autoplaySpeed: 4000,
                    speed: 800,
                    centerPadding: '0px',
                }
            },

            {
                breakpoint: 0,
                settings: {

                    slidesToShow: 1,
                    autoplaySpeed: 4000,
                    speed: 800,
                    centerPadding: '0px'
                }
            },
            ]
        });


        // gallery post format


        $('.is-gallery-format').owlCarousel({

            items: 1,
            loop: true,
            lazyLoad: false,
            margin: 0,
            smartSpeed: 800,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
        });




        // banner 1 single slide 

        $('.slider-1-single').slick({

            centerMode: true,
            centerPadding: '0px',
            dots: false,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            speed: 2000,
            nextArrow: ' <a class="slick-nav slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>',
            prevArrow: ' <a class="slick-nav slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>',
            responsive: [{
                breakpoint: 1400,
                settings: {

                    slidesToShow: 1,
                    centerPadding: '0px',

                }
            },]
        });

        /*
        ==========================
        = Back to top
        =======================================
        */

        // Window scroll function

        $(window).scroll(function () {

            var height = $(window).scrollTop();

            if (height > 400) {

                $('.fascinate-to-top').fadeIn('slow');

            } else {

                $('.fascinate-to-top').fadeOut('slow');
            }
        });

        $(".fascinate-to-top").on('click', function (event) {

            event.preventDefault();

            $("html, body").animate({ scrollTop: 0 }, "slow");

            return false;
        });

    });

    /**
    *
    * Remove preloader once DOM is fully loaded & all the assets are loaded.
    * 
    * @since: 1.0.9
    */

    $(window).on("load", function () {

        let preLoader = $('#preLoader');

        if (preLoader.length > 0) {

            preLoader.fadeOut('slow');
        }
    });

})(jQuery);

