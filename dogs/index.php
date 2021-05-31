<?php

include('../header.php');

$category = '';

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $_GET['category'];
}

$result = get_all_from_products($db, $category);

?>

<div class="container mt-5">

    <div class="row">

        <!--- LEFT SIDEPART -->

        <div class="col-md-3">

            <div class="text-center" style="margin: 39px 0px 23px">
                <h5 style="color: rebeccapurple"><strong>ΚΑΤΗΓΟΡΙΕΣ</strong></h5>
            </div>

            <table class="table table-hover" style="color: rebeccapurple">

                <tbody>

                    <?php
                    $categories = get_enums($db, 'products', 'category');
                    foreach ($categories as $category) { ?>

                        <tr>
                            <td class="category text-center" id="<?php echo $category; ?>">
                                <?php echo $category; ?>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <!--- RIGHT SIDEPART -->
        <div class="col-md-9">


            <div class="text-right mb-4">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ταξινόμηση
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item order-products" id="asc">Αύξουσα τιμή</button>
                        <button class="dropdown-item order-products" id="desc">Φθίνουσα τιμή</button>
                    </div>
                </div>
            </div>


            <div class="row">
                <div id="products-div">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        generate_category_product_div($row);
                    } ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script src="/js/cart.js"></script>
<script src="/js/dogs_products_filters.js"></script>
<?php include('../footer.php'); ?>