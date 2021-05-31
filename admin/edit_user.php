 <?php

    include_once('admin_header.php');

    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {

        $user_id = $_GET['user_id'];
        $sql = "SELECT `user_id`,`email`,`password`,`role` FROM `users` WHERE `user_id` = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {

            $role = $row['role'];
            $email = $row['email'];
            $password = $row['password'];
        }

        $statement->close();
    }
    ?>
 <div class="content-wrapper">
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-6 mt-2">
                     <div class="card">
                         <div class="card-body text-center">
                             <form method="POST" action="<?php echo htmlspecialchars('user_check.php') ?>">
                                 <div class="form-group">
                                     <label for="user_id">
                                         <h6>User ID</h6>
                                     </label>
                                     <input type="text" name="user_id" class="form-control mx-auto" style="text-align:center" value="<?php echo $user_id ?>" readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="email">
                                         <h6>Email</h6>
                                     </label>
                                     <input type="email" name="email" class="form-control mx-auto" style="text-align:center" value="<?php echo $email ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="role">
                                         <h6>Ρόλος</h6>
                                     </label>
                                     <input type="text" name="role" class="form-control mx-auto" style="text-align:center" value="<?php echo $role ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="password">
                                         <h6>Κωδικός</h6>
                                     </label>
                                     <input type="password" name="password" class="form-control mx-auto" style="text-align:center" value="<?php echo $password ?>" required>
                                 </div>
                                 <div>
                                     <input class="btn btn-primary" type="submit" name="edit-user" class="form-control" value="Επεξεργασία">
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
     </section>
 </div>