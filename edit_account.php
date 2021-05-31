<?php

require_once('config.php');

$email_err = $new_password_err = $confirm_new_password_err = $msg = $err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $email_err = 'Το νέο e-mail δεν είναι στη σωστή μορφή.';
    else
        $email = trim($_POST['email']);

    if (empty(trim($_POST['new_password']))) $new_password = '';

    else {

        $new_password = trim($_POST['new_password']);

        if (strlen($new_password) < 8) {

            $new_password_err = 'Ο κωδικός πρέπει να έχει τουλάχιστον 8 χαρακτήρες.';
        } else {

            $new_password = trim($_POST['new_password']);

            if (empty(trim($_POST['confirm_new_password'])))

                $confirm_new_password_err = 'Παρακαλώ επιβεβαιώστε τον νέο κωδικό.';

            else {

                $confirm_new_password = trim($_POST['confirm_new_password']);

                if ($new_password != $confirm_new_password) {
                    $confirm_new_password_err = 'Οι κωδικοί δεν ταιριάζουν.';
                }
            }
        }
    }

    if (empty($email_err) && empty($new_password_err) && empty($confirm_new_password_err)) {

        $user_id = $_SESSION['user_id'];

        if (empty(trim($new_password))) {

            $update_user_basic_info_sql = "UPDATE `users` SET `email` = ? WHERE `user_id` = ?";
            $stmt = $db->prepare($update_user_basic_info_sql);
            $stmt->bind_param('si', $email, $user_id);
        } else {

            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_user_basic_info_sql = "UPDATE `users` SET `email` = ?, `password` = ? WHERE `user_id` = ?";
            $stmt = $db->prepare($update_user_basic_info_sql);
            $stmt->bind_param('ssi', $email, $new_password, $user_id);
        }

        $result = $stmt->execute();

        $first_name = $db->real_escape_string($_POST['first_name']) ?? '';
        $last_name = $db->real_escape_string($_POST['last_name']) ?? '';
        $mobile_number = is_int($_POST['mobile_number'] + 0) ? $_POST['mobile_number'] : '';
        $address = $db->real_escape_string($_POST['address']) ?? '';
        $postal_code = is_int($_POST['postal_code'] + 0) ? $_POST['postal_code'] : '';
        $city = $db->real_escape_string($_POST['city']) ?? '';

        $update_user_details_sql = "UPDATE `users_details` SET `first_name`= ?, `last_name`= ?, `mobile_number`= ?, `address` = ?, `postal_code` = ?, `city` = ? WHERE `user_id`= ?";
        $stmt2 = $db->prepare($update_user_details_sql);
        $stmt2->bind_param('ssisisi', $first_name, $last_name, $mobile_number, $address, $postal_code, $city, $user_id);

        $result2 = $stmt2->execute();
        $affected_rows = $stmt2->affected_rows;

        if (!$result || !$result2) {

            $err = 'Σφάλμα κατά την τροποποίηση! Προσπαθήστε ξανά.';
            
        } else if ($affected_rows == 0) {
            
            $msg = 'Δεν έγιναν αλλαγές κατά την τροποποίηση.';
        }
        
        else {

            $msg = 'Επιτυχής τροποίηση!';
        }

        $stmt->close();
        $stmt2->close();
    }
}

?>

<?php

include_once('header.php');
require_once('backend_functions.php');
$user_data = get_user_details($db);
$db->close();

?>

<div class='container'>

    <div class='edit-wrapper'>

        <h4 class="mb-5">Πληροφορίες Λογαριασμού</h4>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <div class="left-side mr-5">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $user_data['email']; ?>" required>
                    <span class="error"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Νέος Κωδικός</label>
                    <input type="password" name="new_password" class="form-control">
                    <span class="error"><?php echo $new_password_err; ?></span>
                </div>

                <div class="form-group">
                    <label>Επαλήθευση Κωδικού</label>
                    <input type="password" name="confirm_new_password" class="form-control">
                    <span class="error"><?php echo $confirm_new_password_err; ?></span>
                </div>
            </div>

            <div class="right-side">
                <div class="form-group">
                    <label>Όνομα</label>
                    <input type="text" name="first_name" class="form-control" value="<?php if (isset($user_data['first_name'])) echo $user_data['first_name']; ?>">
                    <span class="error"></span>
                </div>

                <div class="form-group">
                    <label>Επώνυμο</label>
                    <input type="text" name="last_name" class="form-control" value="<?php if (isset($user_data['last_name'])) echo $user_data['last_name']; ?>">
                    <span class="error"></span>
                </div>

                <div class="form-group">
                    <label>Τηλέφωνο Επικοινωνίας</label>
                    <input type="text" name="mobile_number" class="form-control" value="<?php if (isset($user_data['mobile_number'])) echo $user_data['mobile_number']; ?>">
                    <span class="error"></span>
                </div>


                <div class="form-group">
                    <label>Διεύθυνση</label>
                    <input type="text" name="address" class="form-control" value="<?php if (isset($user_data['address'])) echo $user_data['address']; ?>">
                    <span class="error"></span>
                </div>


                <div class="form-group">
                    <label>T.K.</label>
                    <input type="text" name="postal_code" class="form-control" value="<?php if (isset($user_data['postal_code'])) echo $user_data['postal_code']; ?>">
                    <span class="error"></span>
                </div>

                <div class="form-group">
                    <label>Πόλη</label>
                    <input type="text" name="city" class="form-control" value="<?php if (isset($user_data['city'])) echo $user_data['city']; ?>">
                    <span class="error"></span>
                </div>
            </div>

            <div class="form-group" style="text-align:center">
                <span class="success"><?php echo $msg; ?></span>
                <span class="error"><?php echo $err; ?></span>
                <input type='submit' class='form-control btn btn-primary btn-custom btn-sm mt-4' style='width: 50%' value='ΤΡΟΠΟΙΗΣΗ'>
            </div>

        </form>
    </div>
</div>

<?php include('footer.php'); ?>