    $(document).ready(function() {
            $(".lazy").lazy({
                effect: 'fadeIn',
                effectTime: 300,
                threshold: 0,
                combined: true,
                delay: 1000,
                enableThrottle: true,
                throttle: 250,
                onFinishedAll: function() {
                    if( !this.config("autoDestroy") )
                        this.destroy();
                },
                // called whenever an element could not be handled
                onError: function(element) {
                    var imageSrc = element.data('src');
                    element.attr('src', `${_uri}/assets/images/noimage.gif`)
                }
            });
    });