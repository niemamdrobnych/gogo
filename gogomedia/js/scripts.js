var $ = jQuery.noConflict();
console.log('dupa dupa');
$('#slider .slider-items').slick({
    slidesToShow: 3,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                adaptiveHeight: true
            }
        }
    ],
    prevArrow: '<span class="slick-prev"><img src="' + frontend_object.template_dir + '/img/prev.svg" /></span>',
    nextArrow: '<span class="slick-next"><img src="' + frontend_object.template_dir + '/img/next.svg" /></span>'
});