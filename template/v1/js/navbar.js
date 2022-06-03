$(document).ready(function() {
    
    $(document).scroll(function() {
        if ($(document).scrollTop() > 80) {
            $("nav#navbar").removeClass('navbar-dark').css("transition", ".5s ease-in-out").addClass("bg-blur navbar-light");
            $("button#caripost").addClass('btn-outline-light');
        } else {
            $("button#caripost").removeClass('btn-outline-light');
            /*$("button#caripost").toggleClass('');*/
            $("nav#navbar").addClass('navbar-dark').removeClass("bg-blur navbar-light");
        }
    });
    /*
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
    */
});