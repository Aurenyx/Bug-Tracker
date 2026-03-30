<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (isset($_POST['login'])) {
    $name = $_POST['name'];

    $query = "SELECT * FROM users WHERE name='$name'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php");
        exit();
    } else {
        echo "User not found";
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Enter Name" required>
    <button name="login">Login</button>
</form>