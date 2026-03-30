<?php include_once 'navbar.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include 'db.php';

$query = "SELECT * FROM bugs";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>View Bugs</title>
    <style>
        body {
            font-family: Arial;
            background: #1e1e2f;
            color: white;
            text-align: center;
        }
        table {
            margin: 50px auto;
            border-collapse: collapse;
            width: 80%;
            background: #2c2c3e;
        }
        th, td {
            padding: 12px;
            border: 1px solid #444;
        }
        th {
            background: #00adb5;
        }
    </style>
</head>
<body>

<h2>📋 Bug List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

<?php
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['description']}</td>
            <td>{$row['status']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}
?>

</table>

</body>
</html>