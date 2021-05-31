<?php

function get_current_day_turnover($db)
{
    $sql = "SELECT ROUND(SUM(total_price),2) AS today_turnover FROM orders
    WHERE DATE(ordered_at) = CURRENT_DATE";

    $result = $db->query($sql);

    return $result->fetch_assoc()['today_turnover'];
}

function get_current_week_turnover($db)
{
    $sql = "SELECT ROUND(SUM(total_price),2) AS week_turnover FROM orders
    WHERE YEARWEEK(DATE(ordered_at)) = YEARWEEK(CURRENT_DATE)";

    $result = $db->query($sql);

    return $result->fetch_assoc()['week_turnover'];
}

function get_current_month_turnover($db)
{
    $sql = "SELECT ROUND(SUM(total_price),2) AS month_turnover FROM orders
    WHERE MONTH(DATE(ordered_at)) = MONTH(CURRENT_DATE)";

    $result = $db->query($sql);

    return $result->fetch_assoc()['month_turnover'];
}

function get_monthly_turnover($db, $month)
{
    $sql = "SELECT ROUND(SUM(total_price),2) AS $month FROM orders
    WHERE MONTHNAME(DATE(ordered_at)) = '$month' AND YEAR(ordered_at) = YEAR(CURRENT_DATE)";

    $result = $db->query($sql);

    return $result->fetch_assoc()[$month];
}

function get_most_popular_products($db, $limit)
{

    $sql = "SELECT orders_products.product_id, name, sum(product_quantity) AS total_sold
    FROM orders_products JOIN products ON orders_products.product_id = products.product_id
    GROUP BY orders_products.product_id
    ORDER BY total_sold DESC
    LIMIT $limit OFFSET 0";

    $result = $db->query($sql);

    $array = array();

    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }

    return $array;
}

function get_best_customers($db, $limit)
{

    $sql = "SELECT o.user_id, u.email, ROUND( SUM( total_price ), 2 ) AS total_purchases 
    FROM
    orders o JOIN users u ON o.user_id = u.user_id 
    GROUP BY o.user_id 
    ORDER BY total_purchases DESC 
    LIMIT $limit OFFSET 0";

    $result = $db->query($sql);

    $array = array();

    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }

    return $array;
}

function get_orders($db, $date_from, $date_to)
{
    $sql = "SELECT order_id, first_name, last_name, email, total_price as total_purchases
    FROM orders o
    JOIN users_details ud ON o.user_id = ud.user_id
    JOIN users u ON o.user_id = u.user_id
    WHERE DATE(ordered_at) BETWEEN '$date_from' AND '$date_to'
    ORDER BY total_purchases DESC";

    $result = $db->query($sql);
    $orders = array();

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row; //αποθήκευση κάθε γραμμής στον πίνακα orders
    }

    return $orders;
}

function get_most_popular_products_with_date_range($db, $date_from, $date_to, $limit)
{
    $sql = "SELECT op.product_id, p.name, sum(op.product_quantity) as total_sold
    FROM orders_products op
    JOIN orders o ON op.order_id = o.order_id
    JOIN products p ON op.product_id = p.product_id
    WHERE DATE(ordered_at) BETWEEN '$date_from' AND '$date_to'
    GROUP BY product_id
    ORDER BY total_sold DESC
    LIMIT $limit";

    $result2 = $db->query($sql);
    $popular_products = array();

    while ($row2 = $result2->fetch_assoc()) {
        $popular_products[] = $row2; //αποθήκευση κάθε γραμμής στον πίνακα popular_products
    }

    return $popular_products;
}

function generate_raw_xml($dataset, $dataset2)
{
    $xml = new DOMImplementation;
    $dtd = $xml->createDocumentType('data', '', 'orders_products.dtd');
    $dom = $xml->createDocument('', '', $dtd);

    $rootNode = $dom->appendChild($dom->createElement("data"));

    foreach ($dataset as $order) {
        if (!empty($order)) {
            $itemNode = $rootNode->appendChild($dom->createElement("order"));
            foreach ($order as $key => $value) {
                $itemNode->appendChild($dom->createElement($key, $value));
            }
        }
    }
    foreach ($dataset2 as $popular_product) {
        if (!empty($popular_product)) {
            $itemNode = $rootNode->appendChild($dom->createElement("popular_product"));
            foreach ($popular_product as $key => $value) {
                $itemNode->appendChild($dom->createElement($key, $value));
            }
        }
    }

    $dom->formatOutput = true;
    $dom->encoding = "UTF-8";

    $dom->save("xml/orders_products.xml");
}

function validate_xml_with_dtd($xmlFilepath)
{
    $validator = new DOMDocument;
    $validator->load($xmlFilepath);
    return $validator->validate();
}


function style_xml_with_xsl($xmlFilepath, $xlsFilepath)
{
    // Load XML file
    $xml = new DOMDocument;
    $xml->load($xmlFilepath);

    // Load XSL file
    $xsl = new DOMDocument;
    $xsl->load($xlsFilepath);

    // Configure the transformer
    $proc = new XSLTProcessor;

    // Attach the xsl rules
    $proc->importStyleSheet($xsl);

    // Transform XML
    echo $proc->transformToXML($xml);
}

function parse_xml($xmlFilepath)
{

    if (file_exists($xmlFilepath)) {

        $xml = simplexml_load_file($xmlFilepath);

        $data = array();

        $number_of_orders = 0;
        $total_turnover = 0;

        foreach ($xml->order as $order) {

            $number_of_orders++;
            $total_turnover += $order->total_purchases;
        }

        $data[0] = $number_of_orders;
        $data[1] = $total_turnover;

        return $data;
    }

    return null;
}
