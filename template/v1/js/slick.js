$(document).ready(function() {
    $('.app-slick').slick({
        autoplay: true,
        infinite: false,
        dots: false,
        autoplaySpeed: 8000,
        // fade: true,
        // cssEase: 'linear',
        arrows: false,
        pauseOnHover: true,
        adaptiveHeight: false
    });
    $('.album-slick').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        autoplaySpeed: 2000,
        fade: true,
        cssEase: 'linear',
        arrows: false,
        pauseOnHover: false,
        adaptiveHeight: true
    });
});