$(document).ready(function() {
    var $sticky = $('#sidebar');
     $sticky.hcSticky({
        stickTo: $('#main-content'),
        // innerSticker: '#stickMe',
        top: 75,
        // followScroll: true,
        // mobileFirst: false,
        queries: {
            980: {
              disable: true,
              stickTo: 'body'
            }
        }
      });
});