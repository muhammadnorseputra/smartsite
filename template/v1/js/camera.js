$(document).ready(function() {
    $('#camera_wrap').camera({ //here I declared some settings, the height and the presence of the thumbnails 
        height: '30%',
        pagination: false,
        thumbnails: false,
        loader: 'bar',
        autoAdvance: true,
        mobileAutoAdvance: true,
        barPosition: 'top',
        loaderColor: 'teal',
        loaderBgColor: '#fff',
        alignment: 'center',
        easing: 'easeInOutCubic', //http://jqueryui.com/demos/effect/easing.html
        fx: 'random',
        time: 10000,
        transPeriod: 1300
    });
});