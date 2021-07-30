    $(document).ready(function() {
            $(".lazy").lazy({
                effect: 'fadeIn',
                effectTime: 2000,
                threshold: 0,
                // called whenever an element could not be handled
                onError: function(element) {
                    var imageSrc = element.data('src');
                    element.attr('src', `${_uri}/assets/images/noimage.gif`)
                }
            });
    });