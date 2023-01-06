$(document).ready(function() {    
    // $(document).scroll(function() {
    //     if ($(document).scrollTop() > 80) {
    //         $("nav#navbar").removeClass('navbar-dark navbar-gradient').css("transition", ".3s ease-in-out").addClass("bg-blur shadow navbar-light");
    //         $("button#caripost").addClass('btn-outline-light');
    //     } else {
    //         $("button#caripost").removeClass('btn-outline-light');
    //         /*$("button#caripost").toggleClass('');*/
    //         $("nav#navbar").addClass('navbar-dark navbar-gradient').removeClass("bg-blur shadow");
    //     }
    // });
    
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