jQuery(function () {
    jQuery('.js-animations').bind('change', function () {
        var animation = jQuery(this).val();
        jQuery('.js-animating-object').animateCss(animation);
    });
});

//Copied from https://github.com/daneden/animate.css
jQuery.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        jQuery(this).addClass('animated ' + animationName).one(animationEnd, function() {
            jQuery(this).removeClass('animated ' + animationName);
        });
    }
});