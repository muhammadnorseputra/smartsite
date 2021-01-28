$(function() {
    skinChanger();

    function toogleScrollbars(hide) {
        var theRules = new Array();

        if (document.styleSheets[0].cssRules)
            theRules = document.styleSheets[0].cssRules;
        else if (document.styleSheets[0].rules)
            theRules = document.styleSheets[0].rules;

        if (hide) {
            theRules[4].style.overflow = "hidden";
            theRules[4].style.overflowX = "hidden";
        } else {
            theRules[4].style.overflow = "scroll";
            theRules[4].style.overflowX = "hidden";
        }
    }

    $("section.content").scroll(function() {
        if ($("section.content").scrollTop() > 10) {
            // $(".breadcrumb").addClass("actives");
            $(".navbar").addClass("activefixed");
        } else {
            // $(".breadcrumb").removeClass("actives");
            $(".navbar").removeClass("activefixed");
        }
    });

    $(".modal.modal-fixed-footer .modal-content .modal-body").scroll(function() {
        if (
            $(".modal.modal-fixed-footer .modal-content .modal-body").scrollTop() > 0
        ) {
            $(".modal-header").addClass("is-shadow");
        } else {
            $(".modal-header").removeClass("is-shadow");
        }
    });
});

//------------------------Skin changer--------------------------//
function skinChanger() {
    jQuery(".right-sidebar .demo-choose-skin li").on("click", function() {
        var jQuerybody = jQuery("body");
        var jQuerythis = jQuery(this);

        var existTheme = jQuery(".right-sidebar .demo-choose-skin li.active").data(
            "theme"
        );
        jQuery(".right-sidebar .demo-choose-skin li").removeClass("active");
        jQuerybody.removeClass("theme-" + existTheme);
        jQuerythis.addClass("active");

        jQuerybody.addClass("theme-" + jQuerythis.data("theme"));
    });
}

// ---------------------------------------------------------------------- //

//------------------------SCRIPT OTOMATIS LOGOUT--------------------------//
// var idleMax = 1200; // (5 min)
// var idleTime = 1;
// (function ($) {
// 	$(document).ready(function () {
// 		$('*').bind('mousemove keydown scroll', function () {
// 			idleTime = 0;
// 			var idleInterval = setInterval("timerIncrement()", 60000);
// 		});
// 		$("body").trigger("mousemove");
// 	});
// })(jQuery)

// function timerIncrement() {
// 	idleTime = idleTime + 1;
// 	if (idleTime > idleMax) {
// 		window.location = "http://localhost/smartsite/login/logout_automatis";
// 	}
// }
// ---------------------------------------------------------------------- //