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

// Counts
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM bugs"))['count'];

$open = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM bugs WHERE status='Open'"))['count'];

$progress = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM bugs WHERE status='In Progress'"))['count'];

$fixed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM bugs WHERE status='Fixed'"))['count'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e1e2f, #2c2c3e);
            color: white;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .card {
            width: 220px;
            margin: 20px;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            font-size: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .card h1 {
            font-size: 40px;
            margin: 10px 0;
        }

        .container.large {
            width: 80%;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background: rgba(255,255,255,0.1);
        }

        tr:hover {
            background: rgba(255,255,255,0.05);
        }

        .total { background: #3a3a5a; }
        .open { background: #ff9800; }
        .progress { background: #2196f3; }
        .fixed { background: #4caf50; }
    </style>
</head>
<body>

<?php include_once 'navbar.php'; ?>

<h2 style="text-align:center; margin-top:30px;">📊 Bug Dashboard</h2>

<div class="dashboard">

    <div class="card total">
        <h3>Total Bugs</h3>
        <h1><?php echo $total; ?></h1>
    </div>

    <div class="card open">
        <h3>Open</h3>
        <h1><?php echo $open; ?></h1>
    </div>

    <div class="card progress">
        <h3>In Progress</h3>
        <h1><?php echo $progress; ?></h1>
    </div>

    <div class="card fixed">
        <h3>Fixed</h3>
        <h1><?php echo $fixed; ?></h1>
    </div>

</div>

<div class="container large">
    <h2>🐞 Recent Bugs</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Assigned</th>
        </tr>

        <?php
        $query = "SELECT b.id, b.title, b.priority, b.status,
                    GROUP_CONCAT(u.name SEPARATOR ', ') AS developers
                    FROM bugs b
                    LEFT JOIN assignments a ON b.id = a.bug_id
                    LEFT JOIN users u ON a.developer_id = u.id
                    GROUP BY b.id
                    LIMIT 5";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $priority = $row['priority'] ?? 'Low';
            $status = $row['status'] ?? 'Open';
            $statusClass = strtolower(str_replace(' ', '-', $status));
            $assigned = $row['developers'] ?? 'Unassigned';
            $priorityClass = strtolower(str_replace(' ', '-', $priority));
            

           echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td class='priority {$priorityClass}'>{$priority}</td>
                <td class='status {$statusClass}'>{$status}</td>
                <td>{$assigned}</td>
                <td>
                    <a href='update_status.php?id={$row['id']}&status=In Progress'>Start</a> |
                    <a href='update_status.php?id={$row['id']}&status=Fixed'>Fix</a>
                </td>
        </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>