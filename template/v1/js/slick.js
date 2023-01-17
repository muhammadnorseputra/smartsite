function LoadingImage(isLoading) {
    if(isLoading) {
    return `<div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded mx-auto d-block" style="width:100%; height: 300px;">&nbsp;</span>
                <span class="content-placeholder my-2" style="width: 100%; height: 20px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded mx-auto d-block" style="width:100%; height: 300px;">&nbsp;</span>
                <span class="content-placeholder my-2" style="width: 100%; height: 20px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded mx-auto d-block" style="width:100%; height: 300px;">&nbsp;</span>
                <span class="content-placeholder my-2" style="width: 100%; height: 20px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>
            <div class="col-6 col-md-3 p-2">
                <span class="content-placeholder rounded mx-auto d-block" style="width:100%; height: 300px;">&nbsp;</span>
                <span class="content-placeholder my-2" style="width: 100%; height: 20px;"></span>
                <span class="content-placeholder" style="width: 100%; height: 30px;"></span>
            </div>`;
    }
}
$('.AppGrafis').html(LoadingImage(true));
$(document).ready(function() {   
    $.getJSON('frontend/v1/api/slider', function(res) {
        LoadingImage(false)
        $('.AppGrafis').slick('removeSlide', 0, 4, true);
        res.forEach(d => {
            $('.AppGrafis').slick('slickAdd', `
            <div class="px-3">
                    <div class="card bg-light text-white rounded-lg mb-2">
                        <img class="card-img" height="340" style="object-fit:cover;" alt="${d.title}" src="${d.path}">
                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <div class="main-body align-self-end">
                                <a href="${d.path}" id="xbanner-${d.uuid}" data-title="${d.title}" data-lightbox="BannerAside" style="text-shadow: 0.3px 1px white;">
                                    <span class="badge p-2 badge-pill badge-warning">
                                        <i class="fas fa-search mr-2"></i> Perbesar
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <span class="mr-2">
                            <img style="object-fit:cover; object-position:top;" src="${d.user}" alt="Photo Userportal" width="23" height="23" class="rounded-circle border-primary bg-white">
                        </span>
                        <span class="small text-secondary mt-1">
                            ${d.user_nama}
                        </span>
                    </div>            
                    ${d.title}
            </div>
            `);
        });
    })
    $('.AppGrafis').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        autoplaySpeed: 4000,
        slidesToShow: 4,
        slidesToScroll: 1,
        zIndex: 10,
        speed: 500,
        centerMode: false,
        centerPadding: '80px',
        focusOnSelect: false,
        // lazyLoad: 'ondemand',
        // fade: false,
        // cssEase: 'linear',
        arrows: true,
        prevArrow: '<button class="slide-arrow prev-arrow btn bg-white btn-outline-none p-3 shadow ml-3"><i class="fas fa-chevron-left"></button>',
        nextArrow: '<button class="slide-arrow next-arrow btn bg-white btn-outline-none p-3 shadow mr-3"><i class="fas fa-chevron-right"></button>',
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

    // $('.album-slick').slick({
    //     autoplay: true,
    //     infinite: true,
    //     dots: false,
    //     autoplaySpeed: 2000,
    //     fade: true,
    //     cssEase: 'linear',
    //     arrows: false,
    //     pauseOnHover: false,
    //     adaptiveHeight: true
    // });

    // Custom carousel nav
    $('.app-prev').click(function(){ 
        $(this).parent().find('.app-slick').slick('slickPrev');
    } );
    
    $('.app-next').click(function(e){
        e.preventDefault(); 
        $(this).parent().find('.app-slick').slick('slickNext');
    } );
});