<?php
include 'components/config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $reason = $_POST['reason'];
    $query = "UPDATE customers SET name='$name', surname='$surname', age='$age', sex='$sex', reason='$reason', status='pending' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<p>Customer updated successfully!</p>";
        header("Location: search.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// If ID is provided in the URL, fetch the record from the database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['NAME'];
        $surname = $row['surname'];
        $age = $row['age'];
        $sex = $row['sex'];
        $reason = $row['reason'];
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit customer</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    line-height: 1.5;
                    color: #333;
                    text-align: center;
                }
                h1 {
                    margin: 0 0 20px;
                    font-size: 28px;
                    font-weight: normal;
                }
                form {
                    max-width: 600px;
                    margin: 0 auto;
                }
                label {
                    display: block;
                    margin-bottom: 10px;
                    font-size: 18px;
                    font-weight: bold;
                }
                input[type="text"],
                input[type="number"],
                select,
                textarea {
                    display: block;
                    width: 100%;
                    padding: 10px;
                    border: 2px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                    line-height: 1.5;
                }
                input[type="submit"] {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #008CBA;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    font-size: 18px;
                    cursor: pointer;
                }
                input[type="submit"]:hover {
                    background-color: #006080;
                }
            </style>
        </head>
        <body>
        <h1>Edit customer</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo $surname; ?>" required><br><br>
            <label for="age">Age:</label>
            <input type="number" name="age" value="<?php echo $age; ?>" required><br><br>
            <label for="sex">Sex:</label>
            <select name="sex" required>
                <option value="M" <?php if ($sex == 'M') echo 'selected'; ?>>Male</option>
                <option value="F" <?php if ($sex == 'F') echo 'selected'; ?>>Female</option>
                <option value="O" <?php if ($sex == 'O') echo 'selected'; ?>>Other</option>
            </select><br><br>
            <label for="reason">Reason for visit:</label>
            <textarea name="reason" required><?php echo $reason; ?></textarea><br><br>
            <input type="submit" name="submit" value="Update                                                                                                                                                                                                                           