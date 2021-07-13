$(document).ready(function() {
    // make it as accordion for smaller screens
    $(document).scroll(function() {
        if ($(document).scrollTop() > 30) {
            $("nav#navbar").css("transition", ".5s ease-in-out").addClass("shadow bg-white");
            $("button#caripost").addClass('btn-outline-light');
        } else {
            $("button#caripost").removeClass('btn-outline-light');
            // $("button#caripost").toggleClass('');
            $("nav#navbar").removeClass("shadow bg-white");
        }
    });
    // var prevScrollpos = window.pageYOffset;
    // window.onscroll = function() {
    //     var currentScrollPos = window.pageYOffset;
    //     if (prevScrollpos > currentScrollPos) {
    //         document.getElementById("navbar").style.top = "0";
    //     } else {
    //         document.getElementById("navbar").style.top = "-80px";
    //     }
    //     prevScrollpos = currentScrollPos;
    // }
});