jQuery(document).ready(function($) {
    $(document).on('click', '#wcc-clear-cart-btn', function() {
        const $button = $(this);
        const userConfirmed = confirm('Are you sure?');
        if (userConfirmed) {
            $button.prop('disabled', true);
            $.post(wccClearItemsAjax.ajaxurl, { action: 'wccClearCart' }, function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert(response.data.message);
                }
                $button.prop('disabled', false);
            });
        }
    });
});
