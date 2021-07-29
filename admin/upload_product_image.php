<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']['name'])) {

    require_once('../config.php');

    /* Getting file name */
    $filename = $_FILES['file']['name'];

    /* Location */
    $location = "../images/" . $_POST['kind'] . "/" . $_POST['category'] . "/" . $filename;
    $imageFileType = strtolower(pathinfo($location, PATHINFO_EXTENSION));

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png");

    $response = 0;
    /* Check file extension */
    if (in_array($imageFileType, $valid_extensions)) {
        /* Upload file */
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {

            $response = $location;
            $location = substr($location,3);
            $sql = "UPDATE `products` SET `image` = '$location' WHERE `product_id` = " . $_POST['product_id'];
            $db->query($sql);

        }
    }

    echo $response;
    exit;
}

echo 0;
