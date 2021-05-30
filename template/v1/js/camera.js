$(document).ready(function() {
    $('#camera_wrap').camera({ //here I declared some settings, the height and the presence of the thumbnails 
        height: '30%',
        pagination: false,
        thumbnails: false,
        loader: 'bar',
        autoAdvance: true,
        barPosition: 'bottom',
        loaderColor: 'lightseagreen',
        loaderBgColor: '#fff'
    });
});