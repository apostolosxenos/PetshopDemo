<?php

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':

        session_start();

        if (isset($_POST['action'])) {

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            switch ($_POST['action']) {

                    // ADD PRODUCT TO CART
                case 'add':

                    $product_ids = array_column($_SESSION['cart'], 'product_id');

                    //αν το προϊόν δεν υπάρχει στο καλάθι
                    if (!in_array($_POST['product_id'], $product_ids)) {

                        $product = array(
                            'product_id' => $_POST['product_id'] + 0,
                            'product_name' => $_POST['product_name'],
                            'product_quantity' => $_POST['product_quantity'] + 0,
                            'product_price' => $_POST['product_quantity'] * $_POST['product_price']
                        );

                        $_SESSION['cart'][$_POST['product_id']] = $product;
                    }

                    //αν το προϊόν υπάρχει στο καλάθι
                    else {

                        $_SESSION['cart'][$_POST['product_id']]['product_quantity'] += $_POST['product_quantity'];
                        $_SESSION['cart'][$_POST['product_id']]['product_price'] += $_POST['product_quantity'] * $_POST['product_price'];
                    }
                    
                    break;

                    //ανανεώνει ποσότητα προϊόντος
                case 'update':

                    $price_per = $_SESSION['cart'][$_POST['product_id']]['product_price'] / $_SESSION['cart'][$_POST['product_id']]['product_quantity'];
                    $_SESSION['cart'][$_POST['product_id']]['product_quantity'] = $_POST['product_quantity'] + 0;
                    $_SESSION['cart'][$_POST['product_id']]['product_price'] = $_POST['product_quantity'] * $price_per;

                    break;

                    //διαγράφει το προϊόν από το session cart
                case 'delete':

                    unset($_SESSION['cart'][$_POST['product_id']]);
                    break;
            }

            $_SESSION['cart']['total_quantity'] = 0;
            $_SESSION['cart']['total_price'] = 0;

            foreach ($_SESSION['cart'] as $key => $value) {

                if (is_int($key)) { //ως keys υπάρχουν και τα total_quantity, total_price τα οποία δεν θέλω να λάβω υπόψιν

                    $_SESSION['cart']['total_quantity'] += $value['product_quantity'];
                    $_SESSION['cart']['total_price'] += $value['product_price'];
                }
            }
            header('Content-Type: application/json');
            echo json_encode($_SESSION['cart']);
            break;
        }

    case 'GET':

        session_start();

        if (isset($_GET['action']) && $_GET['action'] == 'check_quantity') {
            if (!isset($_SESSION['cart']['total_quantity']))
                $qty = 0;
            else {
                $qty = $_SESSION['cart']['total_quantity'] + 0;
            }

            $info = array('quantity' => $qty);
        }


        header('Content-Type: application/json');
        echo json_encode($info);
        break;
}
