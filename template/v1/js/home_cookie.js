$(function() {
    $(document).scroll(function() {
        if ($(document).scrollTop() > 650) {
            if (!$.cookie("notice-accepted")) {
                $("a#xbanner-1").click();
                $.cookie("notice-accepted", 1, {
                    expires: 60 / 1440,
                    path: '/'
                });
            }
        }
    });
    if (!$.cookie("cache_beranda")) {
         $.cookie("cache_beranda", 1, {
            expires: 60 / 1440,
            path: '/'
         });
    }
});