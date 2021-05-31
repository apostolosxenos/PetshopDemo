<?php

require('../config.php');
require('admin_functions.php');

if (isset($_POST['view']) && $_POST['view'] === 'best-customers') {

    $best_customers = get_best_customers($db, 3);

    header('Content-Type: application/json');
    echo json_encode($best_customers);
}
