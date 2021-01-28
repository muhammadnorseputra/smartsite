$(document).ready(function() {
    // Navbar Hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    const animated = "animated none";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass).addClass(animated);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass).removeClass(animated);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });

    // Navigasi Multilevel
    $(".navbar .dropdown-item").on("hover", function(e) {
        var $el = $(this).children(".dropdown-toggle");
        var $parent = $el.offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass("open");

        if (!$parent.parent().hasClass("navbar-nav")) {
            if ($parent.hasClass("show")) {
                $parent.removeClass("show");
                $el.next().removeClass("show");
                $el.next().css({
                    top: -999,
                    left: -999,
                });
            } else {
                $parent.parent().find(".show").removeClass("show");
                $parent.addClass("show");
                $el.next().addClass("show");
                $el.next().css({
                    top: $el[0].offsetTop,
                    left: $parent.outerWidth() - 4,
                });
            }
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $(".navbar .dropdown").on("hidden.bs.dropdown", function() {
        $(this).find("li.dropdown").removeClass("show open");
        $(this).find("ul.dropdown-menu").removeClass("show open");
    });

    $(document).scroll(function() {
        if ($(document).scrollTop() > 10) {
            $("nav#navbar").css("transition", ".1s ease-in").addClass("shadow");
        } else {
            $("nav#navbar").removeClass("shadow");
        }
    });

});