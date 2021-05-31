<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('../config.php');

    $product_id = $db->real_escape_string($_POST['product_id']);
    $name = $db->real_escape_string($_POST['name']);
    $category = $db->real_escape_string($_POST['category']);
    $description = $db->real_escape_string($_POST['description']);
    $photo = $db->real_escape_string($_POST['photo']);
    $stock = $db->real_escape_string($_POST['stock']);
    $price = $db->real_escape_string($_POST['price']);

    //ΠΡΟΣΘΗΚΗ
    if (($_POST['action']) == 'add-product') {
        $sql = "INSERT INTO products(`name`,`category`,`description`,`photo`,`stock`,`price`) VALUES (?,?,?,?,?,?)";
        $statement = $db->prepare($sql);
        $statement->bind_param('ssssid', $name, $category, $description, $photo, $stock, $price);
        $result = $statement->execute();
    }
    //ΕΠΕΞΕΡΓΑΣΙΑ
    else if (($_POST['action']) == 'edit-product') {
        $sql = "UPDATE products SET `name`=?,`category`=?,`description`=?,`photo`=?,`stock`=?,`price`=? WHERE `product_id`= ?";
        $statement = $db->prepare($sql);
        $statement->bind_param('ssssidi', $name, $category, $description, $photo, $stock, $price, $product_id);
        $result = $statement->execute();
    }
    //ΔΙΑΓΡΑΦΗ
    else if (($_POST['action'] == 'delete')) {
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM `products` WHERE `product_id` = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param('i', $product_id);
        $result = $statement->execute();
    }

    $statement->close();

    if ($result) {
        echo "<script>alert('Επιτυχής Ενέργεια!')</script>";
    } else {
        echo "<script>alert('Κάτι πήγε στραβά...')</script>";
    }
    echo "<script>window.opener.location.reload()</script>";
    echo "<script>window.close()</script>";
}
