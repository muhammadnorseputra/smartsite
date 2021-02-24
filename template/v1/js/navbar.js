$(document).ready(function() {
    // make it as accordion for smaller screens
    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".3s ease-in").addClass("shadow bg-white");
        } else {
            $("nav#navbar").removeClass("shadow bg-white");
        }
    });

});