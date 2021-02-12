$(document).ready(function() {

    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".1s ease-in").addClass("shadow-sm bg-white");
        } else {
            $("nav#navbar").removeClass("shadow-sm bg-white");
        }
    });

});