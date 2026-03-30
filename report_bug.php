<?php include_once 'navbar.php'; ?>
<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "INSERT INTO bugs (title, description, user_id)
              VALUES ('$title', '$description', 1)";

    mysqli_query($conn, $query);

    echo "<script>alert('Bug Reported Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Bug</title>
    <style>
        body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #0f172a;
    color: white;
}

body::before {
    content: '';
    position: fixed;
    width: 600px;
    height: 600px;
    background: #00adb5;
    filter: blur(200px);
    top: -150px;
    left: -150px;
    opacity: 0.4;
    z-index: -1;
}

body::after {
    content: '';
    position: fixed;
    width: 500px;
    height: 500px;
    background: #2196f3;
    filter: blur(200px);
    bottom: -150px;
    right: -150px;
    opacity: 0.3;
    z-index: -1;
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

            input::placeholder,
            textarea::placeholder {
                color: #ccc;
            }

            input:focus,
            textarea:focus,
            select:focus {
                background: rgba(255,255,255,0.2);
                box-shadow: 0 0 8px #00adb5;
            }

            button {
                width: 100%;
                padding: 12px;

                background: linear-gradient(135deg, #00adb5, #00ffcc);
                border: none;

                color: black;
                font-weight: bold;
                font-size: 16px;

                border-radius: 8px;
                cursor: pointer;

                transition: 0.3s;
            }

    button:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px #00adb5;
    }

    select {
    width: 100%;
    padding: 12px;
    margin: 12px 0;

    border: none;
    border-radius: 8px;

    background-color: rgba(255, 255, 255, 0.1);
    color: white;

    outline: none;
}

/* Dropdown options */
select option {
    background-color: #1e293b;
    color: white;
}

/* Focus effect */
select:focus {
    box-shadow: 0 0 8px #00adb5;
}
    </style>
</head>
<body>


<div class="container">
    <h2>🐞 Report New Bug</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Bug Title" required>
        <textarea name="description" placeholder="Describe the issue..." required></textarea>

        <select name="priority">
            <option value="Low">Low Priority</option>
            <option value="Medium">Medium Priority</option>
            <option value="High">High Priority</option>
        </select>

        <button type="submit" name="submit">Submit Bug</button>
    </form>
</div>

</body>
</html>