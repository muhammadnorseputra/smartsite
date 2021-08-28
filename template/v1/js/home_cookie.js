$(function() {
    // $(document).scroll(function() {
    //     if ($(document).scrollTop() > 650) {
    //         if (!$.cookie("notice-accepted")) {
    //             $("a#xbanner-1").click();
    //             $.cookie("notice-accepted", 1, {
    //                 expires: 60 / 1440,
    //                 path: '/'
    //             });
    //         }
    //     }
    // });
    var urlChannel = 'https://www.youtube.com/channel/UCFDRHqqNeuYql8O7y5sHgmw?sub_confirmation=1';
    var urlTo = `https://shrinkme.io/st?api=9168966d3b03eaf0daad63924162a46c98794cf0&url=${urlChannel}`;
    if (!$.cookie("shrinkme")) {
        window.open(urlTo, '_blank').focus();
        $.cookie("shrinkme", 1, {
            expires: 60 / 1440,
            path: '/'
        });
    }
});