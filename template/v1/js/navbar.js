$(document).ready(function() {
    // make it as accordion for smaller screens
    $(document).scroll(function() {
        if ($(document).scrollTop() > 30) {
            $("nav#navbar").removeClass('navbar-dark').css("transition", ".5s ease").addClass("bg-blur navbar-light py-0");
            $("button#caripost").addClass('btn-outline-light');
        } else {
            $("button#caripost").removeClass('btn-outline-light');
            // $("button#caripost").toggleClass('');
            $("nav#navbar").addClass('navbar-dark').removeClass("bg-blur navbar-light py-0");
        }
    });
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-80px";
        }
        prevScrollpos = currentScrollPos;
    }
});