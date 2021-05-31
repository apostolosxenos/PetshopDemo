<?php

require_once('classes/Product.php');
require_once('classes/Order.php');
require_once('frontend_functions.php');

function protect_resource($redirect)
{
    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: /' . $redirect . '.php');
        die();
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function nf($price)
{
    return number_format($price, 2, ",", ".");
}


function get_user_details($db)
{
    $sql = "SELECT * FROM `users` u LEFT JOIN `users_details` ud ON u.`user_id` = ud.`user_id` WHERE u.`user_id` = " . $_SESSION['user_id'];
    $result = $db->query($sql);

    return $result->fetch_assoc();
}

function get_user_email($db, $user_id)
{
    $sql = "SELECT `email` FROM `users` WHERE `user_id` = $user_id";
    $result = $db->query($sql);

    return $result->fetch_assoc()['email'];
}

function get_enums($db, $table_name, $field_name)
{
    $sql = "desc {$table_name} {$field_name}";
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $category_type = $row['Type'];
    }

    $output = str_replace("enum('", "", $category_type);
    $output = str_replace("')", "", $output);
    $results = explode("','", $output);

    return $results;
}

function get_all_from_products($db, $category)
{
    if (!empty(test_input($category))) {
        $sql = "SELECT * FROM `products` WHERE `category_slang` = '$category'";
    } else {
        $sql = "SELECT * FROM `products`";
    }
    return $db->query($sql);
}

function get_latest_arrivals($db, $table)
{
    $sql = "SELECT * FROM $table ORDER BY `product_id` DESC";

    return $db->query($sql);
}

function get_popular_products($db)
{
    $sql = "SELECT *, sum(product_quantity) as product_total_sell_quantity 
    FROM orders_products op JOIN products p on op.product_id = p.product_id 
    GROUP BY op.product_id ORDER BY product_total_sell_quantity DESC";

    return $db->query($sql);
}

function filter_by_price($db, $price_order, $category)
{

    if (!empty($category)) {

        $category = htmlspecialchars($category);
        $where = "WHERE `category_slang` = '$category'";
        
    } else $where = "";

    $sql = "SELECT * FROM `products` $where ORDER BY `price` $price_order";
    $result = $db->query($sql);

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_category_product_div($row);
    }

    echo $output;
}

function filter_by_category($db, $category, $price_order)
{

    if ($price_order === "desc") {

        $sql = "SELECT * FROM `products` WHERE `category_slang` = ? ORDER BY `price` DESC LIMIT 0,4";
    } else {

        $sql = "SELECT * FROM `products` WHERE `category_slang` = ? ORDER BY `price` ASC LIMIT 0,4";
    }


    $prepared_statement = $db->prepare($sql);
    $prepared_statement->bind_param("s", $category);
    $prepared_statement->execute();
    $result = $prepared_statement->get_result();
    $prepared_statement->close();

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_category_product_div($row);
    }

    echo $output;
}


function get_user_orders_history($db)
{
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM `orders` o JOIN `orders_details` od ON o.order_id = od.order_id WHERE `user_id` = $user_id ORDER BY `ordered_at` DESC";
    return $db->query($sql);
}

function format_datetime_to_local($datetime)
{
    return date('d-m-Y H:i:s', strtotime($datetime));
}
