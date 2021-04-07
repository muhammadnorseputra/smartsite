$(document).ready(function() {
    $("a#module").on("click", function(e) {
        e.preventDefault();
        let $this = $(this);
        let $url = $this.attr('href');
        let $container = $("#containerModule");
        $("a#module").removeClass("active");
        $.ajax({
            url: $url,
            method: 'post',
            dataType: 'html',
            beforeSend: preloadModule,
            success: function(res) {
                $container.html(res);
                $this.addClass('active');
            }
        });

        function preloadModule() {
            $container.html(`<div class="d-flex justify-content-center align-items-center">
            	<div id="loader" class="m-2"></div></div>`);
        }
    })
});