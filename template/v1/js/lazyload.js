    $(document).ready(function() {
        var img = document.getElementById('picture');
        AntiModerate.process(img, img.getAttribute("antimoderate-data"));
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