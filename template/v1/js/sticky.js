$(document).ready(function() {
    var $sticky = $('#sidebar');
     $sticky.hcSticky({
        stickTo: $('#main-content'),
        // innerSticker: '#stickMe',
        top: 15,
        bottom: 15,
        bottomEnd: 80,
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