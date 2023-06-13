<?php
include 'components/config.php';

if(isset($_POST['delete_all'])) {
    // if the user clicked the Delete All button, delete all customers and reset the auto-increment primary key to 1
    $query = "TRUNCATE TABLE customers";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        // if the query was not successful, print the error message and exit
        printf("Error: %s\n", mysqli_error($conn));
        exit;
    }
    $query = "ALTER TABLE customers AUTO_INCREMENT = 1";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        // if the query was not successful, print the error message and exit
        printf("Error: %s\n", mysqli_error($conn));
        exit;
    }
    header("Location: secure.php");
    exit;
} else {
    // if the user accessed this page directly without clicking the Delete All button, redirect to this page
    header("Location: secure.php");
    exit;
}
