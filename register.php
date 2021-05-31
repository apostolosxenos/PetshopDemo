<?php

$email = $password = $confirm_password = '';
$email_err = $password_err = $confirm_password_err = $msg =  '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('config.php');

    if (empty(trim($_POST['email']))) {

        $email_err = 'Παρακαλώ εισάγετε e-mail.';

    } else {

        require_once('backend_functions.php');
        $email = test_input($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $email_err = 'Το e-mail δεν είναι σε σωστή μορφή.';

        } else {

            $sql = 'SELECT `user_id` FROM `users` WHERE `email` = ?';
    
            if ($stmt = $db->prepare($sql)) {

                $stmt->bind_param('s', $email);

                if ($stmt->execute()) {

                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {

                        $email_err = 'Το e-mail χρησιμοποιείται ήδη.';

                    }
                }
                
                $stmt->close();
            }
        }
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = 'Παρακαλώ εισάγετε κωδικό.';
    } elseif (strlen(trim($_POST['password'])) < 8) {
        $password_err = 'Ο κωδικός πρέπει να έχει τουλάχιστον 8 χαρακτήρες.';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = 'Παρακαλώ επαληθεύστε τον κωδικό.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = 'Οι κωδικοί δεν ταιριάζουν.';
        }
    }

    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        $sql = 'INSERT INTO `users` (`email`, `password`, `role`) VALUES (?, ?, ?)';

        if ($stmt = $db->prepare($sql)) {

            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_role = 'user';
            $stmt->bind_param('sss', $param_email, $param_password, $param_role);

            if ($stmt->execute()) {

                $last_id = $db->insert_id;
                $sql2 = 'INSERT INTO `users_details` SET `user_id` = ' . $last_id;

                if ($db->query($sql2)) {

                    $msg = 'Επιτυχής εγγραφή!';
                    header('Refresh:3; url=index.php?registration=success');
                }

                else {

                    header('Location: register.php?error=internal');
                }
            }

            $stmt->close();
        }
    }

    $db->close();
} ?>


<?php include('header.php'); ?>

<div class='container'>

    <div class='register-wrapper'>

        <h4>Δημιουργία Λογαριασμού</h4>
        <p>Συμπληρώστε τα παρακάτω στοιχεία.</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Κωδικός</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Επαλήθευση Κωδικού</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="error"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group" style="text-align:center">
                <span class="success"><?php echo $msg; ?></span>
                <input type="submit" class="form-control btn btn-primary mt-2" name="register" value="Εγγραφή">
            </div>
            <p>Έχετε ήδη λογαριασμό; <a href="login.php">Σύνδεση</a></p>
        </form>
    </div>


</div>

<?php include('footer.php'); ?>