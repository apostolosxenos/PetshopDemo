<?php

require_once('../config.php');

if ($_SESSION['loggedin'] === true && $_SESSION['cart']['total_quantity'] > 0) {

    $stmt_err = $stmt2_err = 0;

    $insert_order_sql = "INSERT INTO `orders` 
    SET `user_id` = ?,
    `ordered_at` = NOW(),
    `total_price` = ?,
    `status` = 'ΚΑΤΑΤΕΘΗΚΕ'";

    $user_id = $_SESSION['user_id'];
    $total_price = $_SESSION['cart']['total_price'];

    $stmt = $db->prepare($insert_order_sql);
    $stmt->bind_param('id', $user_id, $total_price);

    if (!$stmt->execute()) $stmt_err = 1;

    else {

        $order_id = $db->insert_id;

        $insert_order_details_sql = "INSERT INTO `orders_details`
        SET `order_id` =?,  
        `first_name`=?,
        `last_name`=?,
        `address`=?,
        `mobile_number`=?,
        `postal_code`=?,
        `city`=?,
        `delivery_method`=?,
        `comments`=?";

        $stmt2 = $db->prepare($insert_order_details_sql);
        $stmt2->bind_param(
            'isssiisss',
            $order_id,
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['address'],
            $_POST['mobile_number'],
            $_POST['postal_code'],
            $_POST['city'],
            $_POST['delivery_method'],
            $_POST['comments']
        );

        if (!$stmt2->execute()) $stmt2_err = 1;

        else {

            foreach ($_SESSION['cart'] as $key => $value) {

                if (is_int($key)) {
                    $insert_order_products_sql .= "INSERT INTO `orders_products`(`order_id`,`product_id`,`product_quantity`) 
                    VALUES($order_id,{$value['product_id']},{$value['product_quantity']});";
                }
            }

            if ($db->multi_query($insert_order_products_sql) && $stmt2_err == 0 && $stmt_err == 0) {

                unset($_SESSION['cart']);
                $order_hash = hash('sha512', $order_id);
                header('Location: index.php?submit_order=success&order_id=' . $order_id . '&order_hash=' . $order_hash);
            }
        }
    }
}
