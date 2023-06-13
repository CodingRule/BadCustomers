<?php
include 'components/config.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // if the user is not logged in, redirect to the login page
    header("Location: admin.php");
    exit;
}

if(isset($_POST['reject'])) {
    // if the user clicked the reject button, update the status of the customer to "rejected"
    $id = $_POST['id'];
    $query = "UPDATE customers SET status = 'rejected' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        // if the query was successful, redirect back to the admin page
        header("Location: secure.php");
        exit;
    } else {
        // if the query was not successful, print the error message and exit
        printf("Error: %s\n", mysqli_error($conn));
        exit;
    }
} else {
    // if the user accessed this page without clicking the reject button, redirect to the admin page
    header("Location: secure.php");
    exit;
}
?>
