$(document).ready(function() {
    // $('.app-slick').slick({
    //     autoplay: true,
    //     infinite: true,
    //     dots: false,
    //     autoplaySpeed: 8000,
    //     // fade: true,
    //     // cssEase: 'linear',
    //     arrows: true,
    //     zIndex: 10,
    //     prevArrow: '<button class="slide-arrow prev-arrow btn btn-light p-3 shadow"><i class="fas fa-chevron-left"></button>',
    //     nextArrow: '<button class="slide-arrow next-arrow btn btn-light p-3 shadow"><i class="fas fa-chevron-right"></button>',
    //     pauseOnHover: true,
    //     adaptiveHeight: false,
    //     responsive: [
    //             {
    //               breakpoint: 480,
    //               settings: {
    //                 arrows: false,
    //               }
    //           }
    //     ]
    // });
    $('.grafis-app-slick').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        autoplaySpeed: 8000,
        slidesToShow: 4,
        slidesToScroll: 1,
        zIndex: 10,
        centerMode: false,
        centerPadding: '10px',
        focusOnSelect: false,
        // fade: false,
        // cssEase: 'linear',
        arrows: true,
        prevArrow: '<button class="slide-arrow prev-arrow btn bg-white btn-outline-none p-3 shadow"><i class="fas fa-chevron-left"></button>',
        nextArrow: '<button class="slide-arrow next-arrow btn bg-white btn-outline-none p-3 shadow"><i class="fas fa-chevron-right"></button>',
        pauseOnHover: true,
        adaptiveHeight: false,
        responsive: [
                {
                  breakpoint: 480,
                  settings: {
                    centerMode: true,
                    slidesToShow: 1,
                    arrows: true,
                    fade: true,
                    centerPadding: '40px',
                  }
              }
        ]
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

    // Custom carousel nav
    $('.app-prev').click(function(){ 
        $(this).parent().find('.app-slick').slick('slickPrev');
    } );
    
    $('.app-next').click(function(e){
        e.preventDefault(); 
        $(this).parent().find('.app-slick').slick('slickNext');
    } );
});