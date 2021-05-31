<body>

    <div class="container">

        <nav class="navbar navbar-expand-md navbar-light">

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <div class="navbar-nav">

                    <a href="<?php echo DOMAIN . 'index.php' ?>" class="nav-item nav-link">
                        <img src="<?php echo DOMAIN . 'images/logo.png' ?>" width="100">
                    </a>
                </div>

                <div class="navbar-nav ml-auto">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Αναζήτηση...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary btn-custom"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="navbar-nav ml-auto">

                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>

                        <div class="dropdown nav-item nav-link">
                            <div class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="dropdown-menu" style="text-align:center; background-color: #F1F1F1">

                                <?php if ($_SESSION['role'] === 'admin') { ?>
                                    <a class="dropdown-item" href="<?php echo DOMAIN . "/admin" ?>"><i class="fas fa-user-ninja"></i>
                                        <p>Admin Panel</p>
                                    </a>
                                <?php } ?>
                                <a class="dropdown-item" href="<?php echo DOMAIN . "edit_account.php" ?>"><i class="fas fa-user-circle"></i>
                                    <p>Λογαριασμός</p>
                                </a>
                                <a class="dropdown-item" href="<?php echo DOMAIN . "/orders" ?>"><i class="fas fa-list"></i>
                                    <p>Παραγγελίες</p>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo DOMAIN . "logout.php" ?>"><i class="fas fa-sign-out-alt"></i>
                                    <p>Αποσύνδεση</p>
                                </a>
                            </div>
                        </div>

                        <a href="<?php echo DOMAIN . "cart.php" ?>" class="nav-item nav-link"><i class="fas fa-shopping-cart"></i>
                            <span id="headcart_qty">
                                <?php
                                if (isset($_SESSION['cart'])) {

                                    if ($_SESSION['cart']['total_quantity'] > 1)
                                        echo $_SESSION['cart']['total_quantity'] . " προϊόντα ";
                                    else if ($_SESSION['cart']['total_quantity'] == 1)
                                        echo $_SESSION['cart']['total_quantity'] . " προϊόν ";
                                    else echo "";
                                }
                                ?>
                            </span>

                            <span id="headcart_price">
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    if ($_SESSION['cart']['total_price'] > 0)
                                        echo nf($_SESSION['cart']['total_price']) . " €";
                                } else echo "";
                                ?>
                            </span>
                        </a>

                    <?php } else { ?>

                        <a href="<?php echo DOMAIN . "login.php" ?>" class="nav-item nav-link"><i class="fas fa-user"></i></a>

                    <?php } ?>
                </div>

            </div>

        </nav>

    </div>

    <div class="content-wrapper">

        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar10">
                    <ul class="navbar-nav nav-fill w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo DOMAIN . 'index.php' ?>">
                                <h5>ΑΡΧΙΚΗ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo DOMAIN . 'dogs/' ?>">
                                <h5>ΣΚΥΛΟΙ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΓΑΤΕΣ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΠΟΥΛΙΑ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΨΑΡΙΑ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΜΙΚΡΑ ΖΩΑ</h5>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>