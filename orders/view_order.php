<?php
require_once('../config.php');
require_once('../backend_functions.php');

$sql = "SELECT pr.name, pr.price, op.product_quantity, pr.price * op.product_quantity as total_product_price
FROM orders_products op
JOIN orders o ON op.order_id = o.order_id 
JOIN products pr ON op.product_id = pr.product_id
WHERE op.order_id = " . $_GET['order_id'];

$result = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="gr">

<head>
    <title>Προβολή Παραγγελίας</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
</head>

<body>
    <section class="content" style="margin-top: 20px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h5 class="card-title">ID Παραγγελίας: <?php echo $_GET['order_id'] ?></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table table-striped table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr style='text-align: center'>
                                            <th width="60%">Προϊόν</th>
                                            <th width="15%">Τιμή</th>
                                            <th width="5%">Ποσότητα</th>
                                            <th width="15%">Σύνολο Προϊόντος</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $order_total = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            $price_per_product = ($row['price']);
                                            $product_quantity = $row['product_quantity'];
                                            $total_product_price = $row['total_product_price'];
                                            $order_total += $total_product_price;
                                        ?>
                                            <tr id='order_id-<?php echo $_GET['order_id'] ?>' style='text-align: center'>
                                                <td><?php echo $name ?></td>
                                                <td><?php echo nf($price_per_product) ?> €</td>
                                                <td><?php echo $product_quantity ?></td>
                                                <td><?php echo nf($total_product_price) ?> €</td>
                                            </tr>
                                        <?php
                                        } ?>
                                        <tr>
                                            <td colspan="4" style="text-align:center">Κόστος παραγγελίας: <strong><?php echo nf($order_total); ?> €</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>