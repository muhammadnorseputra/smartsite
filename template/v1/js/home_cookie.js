$(function() {
    if (!$.cookie("notice-accepted")) {
        $("a#xbanner-1").click();
        $.cookie("notice-accepted", 1, {
            expires: 60 / 1440,
            path: '/'
        });
    }
    if (!$.cookie("ruppe")) {
        $("a#ruppe").click();
        var date = new Date();
        date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
        $.cookie("ruppe", 1, {
            expires: date,
            path: '/'
        });
    }
});