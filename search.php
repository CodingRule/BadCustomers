<?php include 'components/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search for a customer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            text-align: center;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        nav {
            display: flex;
            justify-content: space-between;
            background-color: #555;
            padding: 10px;
        }
        nav ul {
            list-style: none;
            display: flex;
        }
        nav li {
            margin-right: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 5px;
        }
        nav a:hover {
            background-color: #f1f1f1;
            color: #333;
        }
        h1 {
            padding: 20px;
        }
        form {
            padding: 20px;
        }
        input[type=text], input[type=submit] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: none;
        }
        input[type=submit] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #f1f1f1;
            color: #333;
        }
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }

    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="create.php">Add a new customer</a></li>
        <li><a href="search.php">Search for a customer</a></li>
        <li><a href="upd_id.php">Update a customer</a></li>
    </ul>
</nav>
<h1>Search for a Blacklisted Customer</h1>
<form method="get" action="">
    <label for="search">Search:</label>
    <input type="text" name="search" placeholder="Search by name, surname, or ID"><br><br>
    <input type="submit" name="submit" value="Search">
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
<?php
if (isset($_GET['submit'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM customers WHERE (name LIKE '%$search%' OR surname LIKE '%$search%' OR id='$search') AND status='approved'";
} else {
    $query = "SELECT * FROM customers WHERE status='approved'";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Search results:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Age</th><th>Sex</th><th>Reason</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['id']."</td><td>".$row['NAME']."</td><td>".$row['surname']."</td><td>".$row['age']."</td><td>".$row['sex']."</td><td>".$row['reason']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No customers found.</p>";
}
?>
</body>
</html>
