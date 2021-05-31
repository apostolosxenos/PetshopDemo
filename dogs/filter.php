<?php

require_once('../config.php');
require_once('../backend_functions.php');

if (isset($_POST['action']) && $_POST['action'] === "category") {

    if (!empty($_POST['category'])) {

        $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
        $price_order = !empty($_POST['price_order']) ?
            htmlspecialchars($_POST['price_order'], ENT_QUOTES, 'UTF-8') : "";


        filter_by_category($db, $category, $price_order);
    }
}

if (isset($_POST['action']) && $_POST['action'] === "price_order") {

    if (!empty($_POST["price_order"])) {

        $price_order = htmlspecialchars($_POST['price_order'], ENT_QUOTES, 'UTF-8');
        $category = !empty($_POST['category']) ?
            htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8') : "";

        filter_by_price($db, $price_order, $category);
    }
}
