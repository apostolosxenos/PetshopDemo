<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /?loggedin=true');
    exit;
}

$email = $password = '';
$email_err = $password_err = $err = $msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('config.php');
    require_once('backend_functions.php');

    if (empty(trim($_POST['email']))) {

        $email_err = 'Παρακαλώ πληκτρολογήστε το e-mail.';

    } 
    
    else {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $email_err = 'Το e-mail δεν είναι σε σωστή μορφή.';
        
        }

        else $email = test_input($_POST['email']);
    }



    if (empty(trim($_POST['password']))) {

        $password_err = 'Παρακαλώ εισάγετε κωδικό.';

    } else {

        $password = trim($_POST['password']);
    }


    if (empty($email_err) && empty($password_err)) {

        $sql = 'SELECT `user_id`, `email`, `password`, `role` FROM `users` WHERE `email` = ?';

        if ($stmt = $db->prepare($sql)) {

            $stmt->bind_param('s', $email);

            if ($stmt->execute()) {

                $stmt->store_result();

                if ($stmt->num_rows == 1) {

                    $stmt->bind_result($user_id, $email, $hashed_password, $role);

                    if ($stmt->fetch()) {

                        if (password_verify($password, $hashed_password)) {

                            // Store data in session variables
                            $_SESSION['loggedin'] = true;
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['email'] = $email;
                            $_SESSION['role'] = $role;


                            if($_SESSION['role'] === 'admin') {
                                $msg = 'Welcome Admin!';
                                header('Refresh:1; url=/admin/index.php?login=success');
                            }
                            

                            else {
                                $msg = 'Επιτυχής σύνδεση!';
                                header('Refresh:1; url=index.php?login=success');
                            }
                            

                        } else {

                            $err = 'Η διεύθυνση ηλεκτρονικού ταχυδρομείου ή ο κωδικός είναι λάθος! Προσπαθήστε ξανά.';
                        }
                    }

                } else {

                    $err = 'Η διεύθυνση ηλεκτρονικού ταχυδρομείου ή ο κωδικός είναι λάθος! Προσπαθήστε ξανά.';
                }

            } else {

                header('Location: login.php?error=internal');
            }

            $stmt->close();
        }
    }

    $db->close();
} ?>

<?php include('header.php'); ?>

<div class="container">

    <div class="login-wrapper">

        <h4>Σύνδεση</h4>
        <p>Παρακαλώ συμπληρώστε τα παρακάτω στοιχεία για να συνδεθείτε.</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Κωδικός</label>
                <input type="password" name="password" class="form-control">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group" style="text-align:center">
                <span class="success"><?php echo $msg; ?></span>
                <span class="error"><?php echo $err; ?></span>
                <input type="submit" class="form-control btn btn-primary mt-3" value="Σύνδεση">
            </div>
            <p>Δεν έχετε λογαριασμό; <a href="register.php"> Εγγραφή</a></p>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>