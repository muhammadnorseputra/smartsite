$(document).ready(function() {
    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
        $('.dropdown-menu a').click(function(e) {
            e.preventDefault();
            if ($(this).next('.submenu').length) {
                $(this).next('.submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.submenu').hide();
            })
        });
    }
    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".1s ease-in").addClass("shadow-sm bg-white");
            $("a.nav-link").removeClass('text-white');
            $("a.nav-link").addClass('text-dark');
        } else {
            $("a.nav-link").addClass('text-white');
            $("a.nav-link").removeClass('text-dark');
            $("nav#navbar").removeClass("shadow-sm bg-white text-white");
        }
    });

});