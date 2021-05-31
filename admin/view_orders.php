<?php

include('admin_header.php');
include('navbar.php');
include('sidebar.php');

$sql = "SELECT `orders`.*,`users`.email FROM `orders` JOIN `users` ON `orders`.`user_id` = `users`.`user_id` ORDER BY `ordered_at`";
$result = $db->query($sql);

$statuses = get_enums($db, 'orders', 'status');

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
                <h6 class="card-title">Κατάλογος Παραγγελιών</h6>
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
                    <table class="table m-0 table-bordered table-hover">
                      <thead>
                        <tr style='text-align: center'>
                          <th>ID Παραγγελίας</th>
                          <th>ID Χρήστη</th>΄
                          <th>Email</th>
                          <th>Δημιουργήθηκε</th>
                          <th>Συνολικό Κόστος</th>
                          <th>Κατάσταση</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = $result->fetch_assoc()) {

                          $order_id = $row['order_id'];
                          $user_id = $row['user_id'];
                          $email = $row['email'];
                          $ordered_at = $row['ordered_at'];
                          $total_price = $row['total_price'];
                          $current_status = $row['status'];
                        ?>

                          <tr style='text-align: center'>
                            <td style='background-color:#0277bd; color:whitesmoke' id='<?php echo $order_id ?>' class="view-order"><strong><?php echo $order_id ?></strong></td>
                            <td><?php echo $user_id ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $ordered_at ?></td>
                            <td><?php echo nf($total_price) ?> €</td>
                            <td>
                              <select class="status-option form-control" id="<?php echo $order_id ?>" style="text-align:center">
                                <?php foreach ($statuses as $s) { ?>
                                  <?php if ($statuses === $s) { ?>
                                    <option value="<?php echo $s ?>" selected><?php echo $s ?></option>
                                  <?php } else { ?>
                                    <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                <?php }
                                } ?>
                              </select>
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
  <?php include('admin_footer.php'); ?>
  <script src="js/orders.js"></script>