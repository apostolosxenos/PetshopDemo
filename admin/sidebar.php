<?php $active_file = $_SERVER['PHP_SELF']; ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="img/admin.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['email']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <?php if ($active_file == '/admin/dashboard.php') { ?>
                        <a href="dashboard.php" class="nav-link active">
                        <?php } else { ?>
                            <a href="dashboard.php" class="nav-link">
                            <?php } ?>
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <p>Dashboard</p>
                            </a>
                </li>


                <li class="nav-item">
                    <?php if ($active_file == '/admin/view_sales.php') { ?>
                        <a href="view_sales.php" class="nav-link active">
                        <?php } else { ?>
                            <a href="view_sales.php" class="nav-link">
                            <?php } ?>
                            <i class="fas fa-euro-sign nav-icon"></i>
                            <p>Προβολή Πωλήσεων</p>
                            </a>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <?php if ($active_file == '/admin/view_products.php' || $active_file == '/admin/add_product.php') { ?>
                        <a href="#" class="nav-link active">
                        <?php } else { ?>
                            <a href="#" class="nav-link">
                            <?php } ?>
                            <i class="fab fa-shopware nav-icon"></i>
                            <p>Προϊόντα</p>
                            <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/admin/view_products.php') { ?>
                                        <a href="view_products.php" class="nav-link active">
                                        <?php } else { ?>
                                            <a href="view_products.php" class="nav-link">
                                            <?php } ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Προϊόντων</p>
                                            </a>
                                </li>
                                <li class="nav-item">
                                    <?php if ($active_file == '/admin/add_product.php') { ?>
                                        <a href="add_product.php" class="nav-link active">
                                        <?php } else { ?>
                                            <a href="add_product.php" class="nav-link">
                                            <?php } ?>
                                            <i class="far fa-keyboard nav-icon"></i>
                                            <p>Προσθήκη Προϊόντος</p>
                                            </a>
                                </li>
                            </ul>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <?php if ($active_file == '/admin/view_orders.php') { ?>

                        <a href="#" class="nav-link active">
                        <?php } else { ?>

                            <a href="#" class="nav-link">
                            <?php } ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Παραγγελίες
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/admin/view_orders.php') { ?>
                                        <a href="view_orders.php" class="nav-link active">
                                        <?php } else { ?>
                                            <a href="view_orders.php" class="nav-link">
                                            <?php } ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Παραγγελιών</p>
                                            </a>
                                </li>
                            </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <?php if ($active_file ==  '/admin/view_users.php') { ?>
                        <a href="#" class="nav-link active">
                        <?php } else { ?>

                            <a href="#" class="nav-link">
                            <?php } ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Χρήστες
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file ==  '/admin/view_users.php') { ?>
                                        <a href="view_users.php" class="nav-link active">
                                        <?php } else { ?>
                                            <a href="view_users.php" class="nav-link">
                                            <?php } ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Χρηστών</p>
                                            </a>
                                </li>
                            </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>