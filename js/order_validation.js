$(function () {

    $('#submit_btn').click(function (event) {

        checkCartQuantity().done(function (result) {
            
            if (result.quantity > 0) {

                if (validateOrderForm()) {
                    
                    $('form').submit();
                }

            } else {

                $('#empty-cart').html('Το καλάθι είναι άδειο. Παρακαλώ επιλέξτε προϊόντα!');
                $('#empty-cart').css('color', 'red');
            }
        });

        event.preventDefault();
    });
});

function checkCartQuantity() {

    return $.ajax({
        url: '/session_cart.php',
        method: 'GET',
        data: {
            action: 'check_quantity'
        }
    });
}

function validateOrderForm() {

    var isValid = true;
    var regEx = /^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ]+$/;

    var first_name = $('#first_name').val();

    if (regEx.test(first_name)) {

        $('#first_name').css('border-color', '');
        $('#first_name_error').css('display', 'none');
    } else {

        $('#first_name').css('border-color', 'red');
        $('#first_name_error').css('display', 'block');
        $('#first_name_error').html('Περιέχει μη έγκυρους χαρακτήρες.');
        $('#first_name_error').css('color', 'red');
        $('#first_name_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    }

    var last_name = $('#last_name').val();

    if (regEx.test(last_name)) {
        $('#last_name').css('border-color', '');
        $('#last_name_error').css('display', 'none');
    } else {
        $('#last_name').css('border-color', 'red');
        $('#last_name_error').css('display', 'block');
        $('#last_name_error').html('Περιέχει μη έγκυρους χαρακτήρες.');
        $('#last_name_error').css('color', 'red');
        $('#last_name_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    }

    var email = $('#email').val();

    if (!validateEmail(email)) {
        $('#email').css('border-color', 'red');
        $('#email_error').css('display', 'block');
        $('#email_error').html('Το email δεν είναι στη σωστή μορφή.');
        $('#email_error').css('color', 'red');
        $('#email_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    } else {
        $('#email').css('border-color', '');
        $('#email_error').css('display', 'none');
    }




    var mobile_number = $('#mobile_number').val();

    if (isNaN(mobile_number) || mobile_number.length != 10) {
        $('#mobile_number').css('border-color', 'red');
        $('#mobile_number_error').css('display', 'block');
        $('#mobile_number_error').html('Ο αριθμός δεν είναι σωστός.');
        $('#mobile_number_error').css('color', 'red');
        $('#mobile_number_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    } else {
        $('#mobile_number').css('border-color', '');
        $('#mobile_number_error').css('display', 'none');
    }



    var postal_code = $('#postal_code').val();

    if (isNaN(postal_code) || postal_code.length != 5) {
        $('#postal_code').css('border-color', 'red');
        $('#postal_code_error').css('display', 'block');
        $('#postal_code_error').html('Ο ταχυδρομικός κώδικας δεν είναι σωστός.');
        $('#postal_code_error').css('color', 'red');
        $('#postal_code_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    } else {
        $('#postal_code').css('border-color', '');
        $('#postal_code_error').css('display', 'none');
    }




    var city = $('#city').val();

    if (regEx.test(city)) {
        $('#city').css('border-color', '');
        $('#city_error').css('display', 'none');
    } else {
        $('#city').css('border-color', 'red');
        $('#city_error').css('display', 'block');
        $('#city_error').html('Περιέχει μη έγκυρους χαρακτήρες.');
        $('#city_error').css('color', 'red');
        $('#city_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    }

    var comments = $('#comments').val();

    if (comments.length > 255) {
        $('#comments').css('border-color', 'red');
        $('#comments_error').css('display', 'block');
        $('#comments_error').html('Ο αριθμός των χαρακτήρων δεν πρέπει να ξεπερνά τους 255.');
        $('#comments_error').css('color', 'red');
        $('#comments_error').css({
            marginLeft: "10px"
        });

        isValid = false;
    } else {
        $('#comments').css('border-color', '');
        $('#comments_error').css('display', 'none');
    }



    return isValid;
}

function validateEmail(email) {
    let re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function log(a) {
    console.log(a);
}