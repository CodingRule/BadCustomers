<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "blacklisted");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
