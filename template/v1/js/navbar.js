$(document).ready(function() {
    // make it as accordion for smaller screens
    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".1s ease-in").addClass("shadow-sm border-bottom bg-white");
        } else {
            $("nav#navbar").removeClass("shadow-sm border-bottom bg-white");
        }
    });
});