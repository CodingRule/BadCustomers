<?php include 'components/config.php'?>

<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // if the user is not logged in, redirect to the login page
    header("Location: admin.php");
    exit;
}

if(isset($_POST['logout'])) {
    // if the user clicked the logout button, destroy the session and redirect to the login page
    session_destroy();
    header("Location: admin.php");
    exit;
}

$query = "SELECT * FROM customers WHERE STATUS = 'pending'";
$result = mysqli_query($conn, $query);

if(!$result) {
    // if the query was not successful, print the error message and exit
    printf("Error: %s\n", mysqli_error($conn));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Page</title>
    <style>
        body{
            text-align: center;
        }
        /* Table styles */
        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Form styles */
        form {
            display: inline-block;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
<h1>Welcome to the Secure Page</h1>
<p>You are logged in as admin.</p>
<form method="post" action="">
    <input type="submit" name="logout" value="Logout">
</form>
<form method="post" action="delete_all.php">
    <input type="submit" name="delete_all" value="Delete All">
</form>
<form method="post" action="delete_one.php">
    <input type="submit" name="delete_one" value="Delete One">
</form>
<form method="post" action="upd_id.php">
    <input type="submit" name="update" value="Update">
</form>
<br>
<h2>Approved Customers:</h2>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Age</th>
        <th>Sex</th>
        <th>Reason</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['NAME']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['sex']; ?></td>
            <td><?php echo $row['reason']; ?></td>
            <td>
                <form method="post" action="approve_customer.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="approve" value="Approve">
                </form>
                <form method="post" action="reject_customer.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="reject" value="Reject">
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script src='https://storage.ko-fi.com/cdn/scripts/overlay-widget.js'></script>
<script>
    kofiWidgetOverlay.draw('badcustomers', {
        'type': 'floating-chat',
        'floating-chat.donateButton.text': 'Tip Me',
        'floating-chat.donateButton.background-color': '#00b9fe',
        'floating-chat.donateButton.text-color': '#fff'
    });
</script>
</body>
</html>
