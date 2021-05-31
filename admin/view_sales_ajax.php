<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('../config.php');
    require_once('../backend_functions.php');
    require_once('admin_functions.php');

    $orders = get_orders($db, $_POST['dates'][0], $_POST['dates'][1]);
    $five_most_popular_products = get_most_popular_products_with_date_range($db, $_POST['dates'][0], $_POST['dates'][1], 5);

    generate_raw_xml($orders, $five_most_popular_products);

    if (file_exists('xml/orders_products.xml')) {

        $data = parse_xml('xml/orders_products.xml');

        if (validate_xml_with_dtd('xml/orders_products.xml')) {
            echo "<div class='mt-2 text-center'>";
            echo "<p class='ml-3 mt-2'>Αριθμός Παραγγελιών: <strong>". $data[0] . "</strong></h6>";
            echo "<p class='ml-3'>Συνολικός Τζίρος: <strong>" . nf($data[1]) . " €</strong></h6>";
            echo "</div>";
            echo style_xml_with_xsl("xml/orders_products.xml", "xml/orders_products.xsl");
        }

        else {

            echo "Δεν υπάρχουν παραγγελίες!";

        }
    }
}