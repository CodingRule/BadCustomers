<?php
session_start(); // start the session
if(isset($_POST['submit'])) {
    // check if the username and password are correct
    if($_POST['username'] == "admin" && $_POST['password'] == "Iubire80@") {
        // if they are, create a session variable to indicate the user is logged in
        $_SESSION['loggedin'] = true;
        // redirect to a secure page
        header("Location: secure.php");
    } else {
        // if they are not, display an error message
        $message = "Incorrect username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<a href="index.php">HOME</a>
<h1>Admin Login</h1>
<?php if(isset($message)) { ?>
    <p><?php echo $message; ?></p>
<?php } ?>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Login">
</form>
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
