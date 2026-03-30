
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

// Fetch bugs
$bugs = mysqli_query($conn, "SELECT * FROM bugs");

// Fetch developers only
$developers = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE role LIKE '%developer%' 
    OR role LIKE '%manager%'
");

// Assign logic
if (isset($_POST['assign'])) {
    $bug_id = $_POST['bug_id'];
    $developer_id = $_POST['developer_id'];

    $query = "INSERT INTO assignments (bug_id, developer_id)
              VALUES ($bug_id, $developer_id)";
    mysqli_query($conn, $query);

    echo "<script>alert('Bug Assigned Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Assign Bug</title>
    <style>
        body {
            font-family: Arial;
            background: #1e1e2f;
            color: white;
            text-align: center;
        }
        .container {
            width: 420px;
            margin: 80px auto;
            padding: 30px;

        /* GLASS EFFECT */
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);

            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);

            border: 1px solid rgba(255,255,255,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00adb5;
            text-shadow: 0 0 10px rgba(0,173,181,0.7);
        }
         input, textarea, select {
        width: 100%;
        padding: 12px;
        margin: 12px 0;

            border: none;
            border-radius: 8px;

            background: rgba(255,255,255,0.1);
            color: white;

            outline: none;
            transition: 0.6s;
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
    <h1>👨‍💻 Assign Bug</h1>

    <form method="POST">

        <!-- Select Bug -->
        <select name="bug_id" required>
            <option value="">Select Bug</option>
            <?php
            while ($row = mysqli_fetch_assoc($bugs)) {
                echo "<option value='{$row['id']}'>
                        {$row['title']}
                      </option>";
            }
            ?>
        </select>

        <!-- Select Developer -->
        <select name="developer_id" required>
            <option value="">Select Developer</option>

            <?php
            while ($dev = mysqli_fetch_assoc($developers)) {
            echo "<option value='{$dev['id']}'>
                {$dev['name']} - {$dev['role']}
              </option>";
        }
            ?>
        </select>

        <button type="submit" name="assign">Assign Bug</button>
    </form>
</div>
<div class="pattern"></div>

</body>
</html>