jQuery(document).ready(function ($) {
    $('.tab-item').on('click', function () {
        $('.tab-item').removeClass('active');
        $(this).addClass('active');
        var curentCat = $(this).text();
        var selectedCategory = $(this).data('cat');

        $.ajax({
            type: 'POST',
            url: filter_params.ajax_url,
            data: {
                action: 'filter_products',
                category: selectedCategory,
                nonce: filter_params.nonce
            },
            success: function (response) {
                $('.product-list').html(response);
                $('.current-cat').html('/ ' + curentCat);
                $('.filter-js').removeClass('active');
            }
        });
    });
});