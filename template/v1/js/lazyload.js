$(document).ready(function() {
    $(".lazy").lazy({
        threshold: 300,
        beforeLoad: function(element) {
            // var imageSrc = element.data('src');
            element.addClass('lazy');
        },
        afterLoad: function(element) {
            // var imageSrc = element.data('src');
            element.addClass('isLoaded').removeClass('lazy');
        },
    });
});