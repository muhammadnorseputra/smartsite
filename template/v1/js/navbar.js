$(document).ready(function() {    
    $(document).scroll(function() {
        if ($(document).scrollTop() > 120) {
            $("nav#navbar").css("transition", ".3s ease-in-out").addClass("fixed-top");
            $(".filterhome").removeClass('rounded');
        } else {
            $(".filterhome").addClass('rounded');
            /*$("button#caripost").toggleClass('');*/
            $("nav#navbar").removeClass("fixed-top");
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