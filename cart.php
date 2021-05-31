<?php
require_once('config.php');
require_once('backend_functions.php');
protect_resource('login');

require_once('header.php'); ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg col-md" style="border-bottom: 1px solid orange">
            <h5 style="color:rebeccapurple"><strong>Περιεχόμενα στο καλάθι</strong></h5>

            <!-- Πίνακας Περιεχομένων -->
            <table class="table mt-4">
                <thead style="color:rebeccapurple">
                    <tr>
                        <td>Προϊόν</th>
                        <td style="text-align: center">Τιμή</td>
                        <td style="text-align: center">Ποσότητα</td>
                        <td style="text-align: center">Σύνολο Προϊόντος</td>
                        <td style="text-align: center">Ενέργειες</td>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $key => $value) {

                            if (is_int($key)) { ?>

                                <tr id="<?php echo $value['product_id'] ?>">

                                    <!-- ΟΝΟΜΑ ΠΡΟΙΟΝΤΟΣ -->
                                    <td style="text-align:left">
                                        <?php echo $value['product_name']; ?>
                                    </td>

                                    <!-- ΤΙΜΗ -->
                                    <td style="text-align: center">
                                        <?php echo nf($value['product_price'] / $value['product_quantity']);  ?> €
                                    </td>

                                    <!-- ΠΟΣΟΤΗΤΑ -->
                                    <td style="text-align: center">
                                        <input type="number" value="<?php echo $value['product_quantity']; ?>" min=1 maxlength="3" style="text-align:center; width: 3em">
                                    </td>

                                    <!-- ΣΥΝΟΛΟ ΠΡΟΙΟΝΤΟΣ -->
                                    <td id="product_total_<?php echo $value['product_id']; ?>" style="text-align: center">
                                        <?php echo nf($value['product_price']); ?> €
                                    </td>

                                    <!-- ΕΝΕΡΓΕΙΕΣ -->
                                    <td style="text-align: center">
                                        <button type="button" class="btn btn-outline-success btn-sm update-product-quantity"><i class="fas fa-sync-alt"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-product"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>

                        <?php }
                        }
                        ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td style="text-align:center; font-size:larger; color:rebeccapurple" colspan=5>Κόστος παραγγελίας: <strong><span id="order_total"><?php echo nf($_SESSION['cart']['total_price']); ?> €</span></strong></td>
                    </tr>
                </tfoot>
            <?php } ?>
            </table>
        </div>
    </div>

    <?php include('order.php'); ?>

</div>

<script src='js/cart.js'></script>
<script src='js/order_validation.js'></script>
<?php include('footer.php'); ?>