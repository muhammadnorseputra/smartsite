$(document).ready(function() {
    // make it as accordion for smaller screens
    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".1s ease-in").addClass("shadow-sm bg-white");
        } else {
            $("nav#navbar").removeClass("shadow-sm bg-white");
        }
    });

    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-95px";
        }
        prevScrollpos = currentScrollPos;
    }
});