<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $filename = $_FILES['file']['name'];



    $location = "/images/" . $_POST['kind'] . "/" . $_POST['category'] . "/" . $filename;

    $upload = 1;

    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $valid_extensions = array("jpg", "jpeg", "png");

    if (!in_array(strtolower($imageFileType), $valid_extensions)) {
        $upload = 0;
    }

    if ($upload === 0) {

        echo 0;

    } else {

        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            echo $filename;
            
        } else {
            echo 0;
        }
    }
}
