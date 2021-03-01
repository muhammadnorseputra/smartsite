$(document).ready(function() {
    if ($(window).width() < 320) {
        $('.sidebar').on('sticky-bottom-unreached', function() {
            console.log("Bottom unreached");
        });
    } else {
        $(".sidebar").sticky({
            topSpacing: 0,
            bottomSpacing: 100,
        });
    }

});