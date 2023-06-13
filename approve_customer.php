<?php
include 'components/config.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // if the user is not logged in, redirect to the login page
    header("Location: admin.php");
    exit;
}

if(isset($_POST['approve'])) {
    $id = $_POST['id'];

    $query = "UPDATE customers SET STATUS = 'approved' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if($result) {
        // if the query was successful, redirect to the secure page
        header("Location: secure.php");
        exit;
    } else {
        // if the query was not successful, print the error message and exit
        printf("Error: %s\n", mysqli_error($conn));
        exit;
    }
} else {
    // if the user accessed this page without clicking the approve button, redirect to the secure page
    header("Location: secure.php");
    exit;
}
?>
