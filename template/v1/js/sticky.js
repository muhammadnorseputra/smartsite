$(document).ready(function() {
    $(".sidebar").sticky({
        topSpacing: 0,
        bottomSpacing: 100,
    });
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-75px";
        }
        prevScrollpos = currentScrollPos;
    }
});