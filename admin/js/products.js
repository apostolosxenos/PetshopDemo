$(document).ready(function () {

    $(".edit-product").click(function () {

        let product_id = $(this).attr('id');
        let product_category = convertCategoryGreekToEnglish($(this).attr('data-category'));

        var myWidth = 800;
        var myHeight = 850;
        var left = (screen.width - myWidth) / 2;
        var top = (screen.height - myHeight) / 4;
        var myURL = "edit_product.php?product_id=" + product_id + "&category=" + product_category;
        var title = "Επεξεργασία Προϊόντος";

        var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
        myWindow.focus();
    });

    $(".delete-product").click(function () {

        var product_id_value = this.id;

        var confirmation = confirm("Θέλετε σίγουρα να διαγράψετε το προϊόν με ID=" + product_id_value + ";");
        if (confirmation == true) {

            $.ajax({
                type: 'POST',
                url: 'product_check.php',
                data: {
                    product_id: product_id_value,
                    action: 'delete'
                },
                success: function (response) {

                    $("#product_id-" + product_id_value).remove();
                    alert('Επιτυχής διαγραφή!');

                }
            });
        }
    });
});

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