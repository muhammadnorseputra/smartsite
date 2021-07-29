$(function() {
    if (!$.cookie("notice-accepted")) {
        $("a#xbanner-1").click();
        $.cookie("notice-accepted", 1, {
            expires: 60 / 1440,
            path: '/'
        });
    }
});