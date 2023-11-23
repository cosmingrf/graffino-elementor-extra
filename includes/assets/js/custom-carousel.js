document.addEventListener('DOMContentLoaded', () => {
    console.log('emrge')
        jQuery(document).ready(function(){
            jQuery('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav',
            });
            jQuery('.slider-nav').slick({
                slidesToShow: 4.3,
                slidesToScroll: 1,
                cssEase: 'linear',
                asNavFor: '.slider-for',
                dots: true,
                arrows: true,
                focusOnSelect: true,
                centerMode: false,
                infinite: true,
                initialSlide: 1,
            });
        });


});