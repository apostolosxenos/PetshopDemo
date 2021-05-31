<?php

include('admin_header.php');
include('navbar.php');
include('sidebar.php');

$sql = "SELECT * FROM `users` JOIN `users_details` ON `users`.`user_id` = `users_details`.`user_id`";
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
                  <h6 class="card-title">Κατάλογος Χρηστών</h6>
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
                          <th>ID Χρήστη</th>
                          <th>Email</th>
                          <th>Ρόλος</th>
                          <th>Ενέργειες</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = $result->fetch_assoc()) {

                          $user_id = $row['user_id'];
                          $email = $row['email'];
                          $role = $row['role'];
                        ?>
                          <tr style='text-align: center' id="user_id-<?php echo $row['user_id'] ?>">
                            <td><?php echo $user_id ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $role ?></td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm edit-user" id="<?php echo $user_id; ?>"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger btn-sm delete-user" id="<?php echo $user_id; ?>"><i class="fas fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
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
  <script src="js/users.js"></script>