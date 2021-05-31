<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once('../config.php');

    $user_id = $db->real_escape_string($_POST['user_id']);
    $firstname = $db->real_escape_string($_POST['firstname']);
    $lastname = $db->real_escape_string($_POST['lastname']);
    $email = $db->real_escape_string($_POST['email']);
    $mobile_number = $db->real_escape_string($_POST['mobile_number']);
    $address = $db->real_escape_string($_POST['address']);
    $date_of_birth = $_POST['date_of_birth'];


    //ΕΠΕΞΕΡΓΑΣΙΑ
    if (isset($_POST['action']) && $_POST['action'] === 'edit-user') {
        $sql = "UPDATE `users` SET `first_name` = ?, `last_name` = ?, `email` = ?, `mobile_number` = ?,`address`=? WHERE `user_id` = ?";
        $statement = $db->prepare($sql);
        $statement->bind_param('ssssssi', $firstname, $lastname, $email, $mobile_number, $address, $date_of_birth, $user_id);
        $result = $statement->execute();
    }
    //ΔΙΑΓΡΑΦΗ
    else if (($_POST['action'] === 'delete')) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM `users` WHERE `user_id` = ?";
        $statement = $db->query($sql);
        $statement->bind_param('i', $user_id);
        $result = $statement->execute();
    }

    $statement->close();

    if ($result) {
        echo "<script>alert('Επιτυχής Ενέργεια!')</script>";
    } else {
        echo "<script>alert('Κάτι πήγε στραβά...')</script>";
    }
    echo "<script>window.opener.location.reload()</script>";
    echo "<script>window.close()</script>";
}