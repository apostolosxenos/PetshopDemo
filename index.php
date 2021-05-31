<?php include('header.php'); ?>

<!--- WEBSITE DATA -->

<div class="container">

    <!-- AD -->

    <div class="mx-auto mt-4 mb-3 text-center">

        <?php //var_dump($_SESSION); 
        ?>

        <a href="https://www.petshop.demo">
            <img src="images/ad.png">
        </a>

    </div>

    <!-- LATEST ARRIVALS -->

    <h3>ΤΕΛΕΥΤΑΙΕΣ <b>ΑΦΙΞΕΙΣ</b></h3>

    <div class="row mb-5">

        <div class="owl-carousel owl-theme" id="latest-arrivals">

            <?php

            $result = get_latest_arrivals($db, 'products');

            while ($row = $result->fetch_assoc()) {

                generate_frontpage_product_div($row);
            } ?>

        </div>
    </div>


    <!-- POPULAR PRODUCTS -->

    <h3>ΔΗΜΟΦΙΛΗ <b>ΠΡΟΪΟΝΤΑ</b></h3>


    <div class="row mb-5">

        <div class="owl-carousel owl-theme" id="popular-products">

            <?php

            $result2 = get_popular_products($db);

            while ($row2 = $result2->fetch_assoc()) {

                generate_frontpage_product_div($row2);
            }
            ?>
        </div>
    </div>
</div>

<script src="/js/homepage.js"></script>
<script src="/js/cart.js"></script>

<?php include('footer.php'); ?>