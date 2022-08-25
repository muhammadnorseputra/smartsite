$.Mprog = {
    starts: function(temp, target, start) {
        let mp3 = new Mprogress({
            template: temp,
            parent: target,
            start: start
        });
        return mp3;
    }
}

$(function() {
    setTimeout(function() {
        $('.page-loader-wrapper').fadeOut();
        $(".content-inner, .breadcrumb, .sidebar, .imglogo, .navbar	").removeClass('out');
    }, 50);
});