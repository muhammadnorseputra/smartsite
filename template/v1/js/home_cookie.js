$(function () {
    if (!$.cookie("notice-accepted")) {
        $("a#banner").click();        
        $.cookie("notice-accepted", 1, { expires : 60 / 1440, path: '/'  });
    }
});