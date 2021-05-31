<?php
require_once('../config.php');
require_once('../backend_functions.php');
protect_resource('404');


require_once('../header.php');
$result = get_user_orders_history($db);
?>

<div class="container">
    <div class="row">
        <div class="col-lg">

            <?php if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {

                $hash = hash('sha512', $_GET['order_id']);

                if ($hash === $_GET['order_hash']) { ?>

                    <div class="alert alert-success text-center mt-4">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Η παραγγελία <strong> #<?php echo $_GET['order_id']; ?> </strong> καταχωρήθηκε επιτυχώς!
                    </div>

            <?php
                }
            } ?>

            <h3>ΙΣΤΟΡΙΚΟ <b>ΠΑΡΑΓΓΕΛΙΩΝ</b></h3>
            <table class="table table-bordered table-hover" id="orders-table" style="margin-bottom: 557px">
                <thead>
                    <tr style='text-align: center'>
                        <td>ID Παραγγελίας</td>
                        <td>Ημερομηνία Καταχώρησης</td>
                        <td>Κόστος Παραγγελίας</td>
                        <td>Τρόπος Παράδοσης</td>
                        <td>Κατάσταση</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        generate_orders_table_row($row);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once('../footer.php') ?>
<script src="/js/view_order.js"></script>