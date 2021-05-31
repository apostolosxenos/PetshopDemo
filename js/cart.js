$(document).ready(function () {

    //αυξάνει την επιλεγμένη ποσότητα
    $(document).on('click', '.btn-qty-incr', function () {

        var $button = $(this);
        var oldValue = $button.siblings("input").val();
        var newValue = parseInt(oldValue) + 1;
        $button.siblings("input").val(newValue);
    });

    //μειώνει την επιλεγμένη ποσότητα
    $(document).on('click', '.btn-qty-decr', function () {

        var $button = $(this);
        var oldValue = $button.siblings("input").val();

        if (oldValue > 1) {
            var newValue = parseInt(oldValue) - 1;
        } else {
            newValue = 1;
        }

        $button.siblings("input").val(newValue);
    });


    //προσθέτει στο καλάθι
    $(document).on('click', '.btn-cart', function () {

        var product_id = parseInt(this.id);
        var product_name = $(this).parent().parent().parent().find("h5").html();
        var product_quantity = parseInt($(this).closest("div").prev().find("input[type='number']").val());
        var product_price = parseFloat($(this).closest("div").find("input[type='hidden']").val());

        $.post('/session_cart.php', {
            action: 'add',
            product_id: product_id,
            product_name: product_name,
            product_quantity: product_quantity,
            product_price: product_price
        })
            .done(function (data) {

                var totalQty = data.total_quantity;
                var totalPrice = data.total_price;

                var convertedTotalPrice = totalPrice.toLocaleString('el-GR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                if (totalQty > 1)
                    $('#headcart_qty').html(totalQty + " προϊόντα ");
                else
                    $('#headcart_qty').html(totalQty + " προϊόν ");

                $('#headcart_price').html(convertedTotalPrice + " €");
            })
            .fail(function (xhr, status, error) {
                console.log(error);
            });
    });

    //ανανεώνει ποσότητα προϊόντος με το κουμπί ανανέωσης
    $('.update-product-quantity').click(function () {

        var product_id = $(this).closest('tr').attr('id');
        var new_quantity = $(this).closest('tr').find('input[type=number]').val();

        if (new_quantity > 0) {

            $.post('/session_cart.php', {
                action: 'update',
                product_id: product_id,
                product_quantity: new_quantity
            })
                .done(function (data) {

                    console.log(data);

                    var productTotalPrice = data[product_id].product_price;
                    var totalQty = data.total_quantity;
                    var totalPrice = data.total_price;

                    var convertedProductTotalPrice = productTotalPrice.toLocaleString('el-GR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    var convertedTotalPrice = totalPrice.toLocaleString('el-GR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    $('#product_total_' + product_id).html(convertedProductTotalPrice + " €");
                    $('#order_total').html(convertedTotalPrice + " €");

                    if (totalQty > 1)
                        $('#headcart_qty').html(totalQty + " προϊόντα ");
                    else
                        $('#headcart_qty').html(totalQty + " προϊόν ");

                    $('#headcart_price').html(convertedTotalPrice + " €");
                })
                .fail(function (xhr, status, error) {
                    console.log(error);
                });
        }

    });

    $(".delete-product").click(function () {

        var product_id = $(this).closest('tr').attr('id');

        $.post("/session_cart.php", {
            action: 'delete',
            product_id: product_id,
        })
            .done(function (data) {

                $('#' + product_id).remove();

                var totalQty = data.total_quantity;
                var totalPrice = data.total_price;

                var convertedTotalPrice = totalPrice.toLocaleString('el-GR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                $('#order_total').html(convertedTotalPrice + " €");


                if (totalQty > 1) {
                    $('#headcart_qty').html(totalQty + " προϊόντα ");
                    $('#headcart_price').html(convertedTotalPrice + " €");
                } else if (totalQty == 1) {
                    $('#headcart_qty').html(totalQty + " προϊόν ");
                    $('#headcart_price').html(convertedTotalPrice + " €");
                } else {
                    $('#headcart_qty').html("");
                    $('#headcart_price').html("");
                }



            })
            .fail(function (xhr, status, error) {
                console.log(error);
            });
    });

});