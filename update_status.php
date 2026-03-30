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

// Fetch bugs for dropdown
$bugs = mysqli_query($conn, "SELECT * FROM bugs");

// Update logic
if (isset($_POST['update'])) {
    $bug_id = $_POST['bug_id'];
    $status = $_POST['status'];

    $query = "UPDATE bugs SET status='$status' WHERE id=$bug_id";
    mysqli_query($conn, $query);

    echo "<script>alert('Status Updated!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update Bug Status</title>
    <style>
        body {
            font-family: Arial;
            background: #1e1e2f;
            color: white;
            text-align: center;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            background: #2c2c3e;
            padding: 20px;
            border-radius: 10px;
        }
        select, button {
            padding: 10px;
            margin: 10px;
            width: 90%;
        }
        button {
            background: #00adb5;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🔄 Update Bug Status</h2>

    <form method="POST">

        <select name="bug_id" required>
            <option value="">Select Bug</option>
            <?php
            while ($row = mysqli_fetch_assoc($bugs)) {
                echo "<option value='{$row['id']}'>
                        {$row['title']} (Status: {$row['status']})
                      </option>";
            }
            ?>
        </select>

        <select name="status" required>
            <option value="">Select Status</option>
            <option value="Open">Open</option>
            <option value="In Progress">In Progress</option>
            <option value="Fixed">Fixed</option>
        </select>

        <button type="submit" name="update">Update Status</button>
    </form>
</div>

</body>
</html>