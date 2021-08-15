jQuery(function () {
    jQuery('.js-modal-buttons .btn').on('click', function () {
        var color = jQuery(this).data('color');
        jQuery('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        jQuery('#mdModal').modal('show');
    });
});