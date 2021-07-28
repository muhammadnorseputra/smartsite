$(function() {
    if (!$.cookie("notice-accepted")) {
        $("a#xbanner").click();
        $.cookie("notice-accepted", 1, {
            expires: 60 / 1440,
            path: '/'
        });
    }
});