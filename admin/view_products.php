<?php

include('admin_header.php');
include('navbar.php');
include('sidebar.php');

$sql = "SELECT * FROM `products`";
$result = $db->query($sql);
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md mt-2">
              <div class="card">
                <div class="card-header border-transparent">
                  <h6 class="card-title">Κατάλογος Προϊόντων</h6>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0 table-bordered table-striped">
                      <thead>
                        <tr style='text-align: center'>
                          <th>ID</th>
                          <th>Ονομασία</th>
                          <th>Κατηγορία</th>
                          <th>Φωτογραφία</th>
                          <th>Απόθεμα</th>
                          <th>Τιμή</th>
                          <th>Ενέργειες</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = $result->fetch_assoc()) {
                          $product_id = $row['product_id'];
                          $name = $row['name'];
                          $category = $row['category'];
                          $image = $row['image'];
                          $stock = $row['stock'];
                          $price = $row['price'];
                        ?>

                          <tr id='product_id-<?php echo $product_id ?>' style='text-align: center'>
                            <td><?php echo $product_id ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $category ?></td>
                            <td style="width:30%"><img src="<?php echo DOMAIN . $image ?>" width="10%"></td>
                            <td><?php echo $stock ?></td>
                            <td style="white-space:nowrap"><?php echo nf($price) ?> €</td>
                            <td>
                              <button type="button" class="btn btn-outline-primary btn-sm edit-product" id="<?php echo $product_id; ?>" data-category="<?php echo $category; ?>"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-outline-danger btn-sm delete-product" id="<?php echo $product_id; ?>"><i class="fas fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include('admin_footer.php') ?>
  <script src="js/products.js"></script>