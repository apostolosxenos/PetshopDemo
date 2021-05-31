<?php
require('../config.php');
require('admin_functions.php');

if (isset($_POST['view']) && $_POST['view'] === 'popular-products') {

    $popular_products = get_most_popular_products($db,5);

    header('Content-Type: application/json');
    echo json_encode($popular_products);
}
