$(function () {

    var urlParams = new URLSearchParams(window.location.search);

    $('.category').on('click', function () {

        let category = convertCategoryGreekToEnglish($(this).attr('id'));
        console.log('Category ' + category + ' clicked!');

        if (urlParams.has('price_order'))
            var price_order = urlParams.get('price_order');

        $.post('/dogs/filter.php', {
                action: "category",
                category: category,
                price_order: price_order
            })
            .done(function (data) {

                urlParams.set('category', category);
                window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);
                updateDiv(data);
            })
            .fail(function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            });
    });


    $('.order-products').on('click', function () {

        let price_order = $(this).attr('id');

        if (urlParams.has('category')) {
            var category = urlParams.get('category');
        }

        $.post('/dogs/filter.php', {
                action: "price_order",
                price_order: price_order,
                category: category
            })
            .done(function (data) {

                urlParams.set('price_order', price_order);
                if (!isEmpty(category)) urlParams.set('category', category);
                window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);
                updateDiv(data);
            })
            .fail(function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            });
    });
});


function updateDiv(data) {

    $('#products-div').html(data);

}

function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

function convertCategoryGreekToEnglish(cat) {

    var category_eng = "";

    switch (cat) {

        case "ΤΡΟΦΗ":
            category_eng = "trofi"
            break;

        case "ΛΙΧΟΥΔΙΕΣ":
            category_eng = "lichoudies"
            break;

        case "ΚΟΛΑΡΑ":
            category_eng = "kolara"
            break;

        case "ΡΟΥΧΑ":
            category_eng = "roucha"
            break;

        case "ΠΑΙΧΝΙΔΙΑ":
            category_eng = "paichnidia"
            break;
    }

    return category_eng;
}