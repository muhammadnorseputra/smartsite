$(document).ready(function() {
    var $sticky = $('#sidebar');
     $sticky.hcSticky({
        stickTo: $('#main-content'),
        // innerSticker: '#stickMe',
        top: 10,
        bottom: 120,
        bottomEnd: 100,
        // followScroll: true,
        // mobileFirst: false,
        responsive: {
            980: {
              disable: true,
              stickTo: 'body'
            }
        }
      });
});