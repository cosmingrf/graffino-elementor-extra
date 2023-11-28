/**
 * Custom Carousel
 * Author: Graffino (http://www.graffino.com)
 */

(function ($) {
    "use strict";

    /**
     * Custom Carousel
     */
    
    var CustomCarousel = function ($scope,$) {
        var $_this = $scope.find('.slider-for');
        var $currentID = '#' + $_this.attr('id'),
            $dots = $_this.data('dots'),
            $navs = $_this.data('navs'),
            $loop = $_this.data('loop'),
            $slidesToShow = $_this.data('slides-desktop'),
            $slidesToShowMobile = $_this.data('slides-mobile');

        $_this.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            dots: false,
        });

        $('.slider-nav').slick({
            slidesToShow: $slidesToShow,
            slidesToScroll: 1,
            cssEase: 'linear',
            asNavFor: '.slider-for',
            dots: $dots,
            arrows: $navs,
            focusOnSelect: true,
            centerMode: false,
            infinite:  $loop,
            initialSlide: 1,
            responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
            },   
            {
            breakpoint: 767,
            settings: {
                slidesToShow: $slidesToShowMobile,
                slidesToScroll: 1,
            }
            },
            {
            breakpoint: 412,
            settings: {
                slidesToShow: $slidesToShowMobile,
                slidesToScroll: 1,
            }
            }
        ]
        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-carousel-widget.default', CustomCarousel);
    });
})(jQuery);
