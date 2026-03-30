<?php include_once 'navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>DB Schema</title>
    <style>
        body {
            background: #1e1e2f;
            color: white;
            font-family: Arial;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th, td {
            padding: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
        }

        th {
            background: #333;
        }

        h2 {
            margin-top: 40px;
            color: #00d4ff;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>📘 Database Schema (DBMS Implementation)</h1>

    <!-- BUGS TABLE -->
    <h2>1. Bugs Table</h2>
    <table>
        <tr>
            <th>Column</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <tr><td>id</td><td>INT (PK)</td><td>Unique Bug ID</td></tr>
        <tr><td>title</td><td>VARCHAR</td><td>Bug Title</td></tr>
        <tr><td>description</td><td>TEXT</td><td>Bug Details</td></tr>
        <tr><td>priority</td><td>VARCHAR</td><td>Low/Medium/High</td></tr>
        <tr><td>status</td><td>VARCHAR</td><td>Open/In Progress/Fixed</td></tr>
    </table>

    <!-- USERS TABLE -->
    <h2>2. Users Table</h2>
    <table>
        <tr>
            <th>Column</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <tr><td>id</td><td>INT (PK)</td><td>User ID</td></tr>
        <tr><td>name</td><td>VARCHAR</td><td>Developer Name</td></tr>
        <tr><td>role</td><td>VARCHAR</td><td>UI/Backend/etc</td></tr>
    </table>

    <!-- ASSIGNMENTS TABLE -->
    <h2>3. Assignments Table (Bridge Table)</h2>
    <table>
        <tr>
            <th>Column</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
        <tr><td>id</td><td>INT (PK)</td><td>Assignment ID</td></tr>
        <tr><td>bug_id</td><td>INT (FK)</td><td>References Bugs</td></tr>
        <tr><td>developer_id</td><td>INT (FK)</td><td>References Users</td></tr>
    </table>

    <!-- RELATIONSHIP -->
    <h2>🔗 Relationships</h2>
    <table>
        <tr>
            <th>Type</th>
            <th>Explanation</th>
        </tr>
        <tr>
            <td>Many-to-Many</td>
            <td>One bug can have multiple developers and vice versa</td>
        </tr>
    </table>

</div>

</body>
</html>