<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <div class="logo">🐞 BugTracker</div>

    <div class="nav-links">
        <a href="index.php">Dashboard</a>
        <a href="report_bug.php">Report</a>
        <a href="assign_bug.php">Assign</a>
        <a href="update_status.php">Update</a>
        <a href="view_bugs.php">View bugs</a>
    </div>


    <div class="nav-right">
        <a href="logout.php" style="float:right; margin-left:15px; margin-right:5px">Logout</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') { ?>
        <a href="db_view.php" style="float:right;">DB</a>
        <?php } ?>
        <span class="status-dot"></span>
        <a href="db_schema.php" class="hidden-db-btn">DB</a>
        <span>System Online</span>
    </div>
</div>

<style>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(12px);
    color: white;
}

/* Logo */
.logo {
    font-size: 30px;
    font-weight: bold;
    color: #00adb5;
}

/* Center links */
.nav-links {
    display: flex;
}

.nav-links a {
    font-size: 22px;
    font-weight: bold;
    margin: 3px 30px;
    text-decoration: none;
    color: white;
    position: relative;
    transition: 0.3s;
}

.nav-links a:hover {
    color: #00adb5;
}

/* underline animation */
.nav-links a::after {
    content: '';
    display: block;
    height: 2px;
    background: #00adb5;
    width: 0%;
    transition: 0.3s;
    margin-top: 5px;
}

.nav-links a:hover::after {
    width: 100%;
}

/* Right section */
.nav-right {
    display: flex;
    align-items: center;
    font-size: 22px;
    color: #ccc;
}

.status-dot {
    width: 10px;
    height: 10px;
    background: #00ff88;
    border-radius: 50%;
    margin-right: 8px;
}
</style>


<div id="loader" style="
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:white;
display:none;
z-index:9999;
text-align:center;
padding-top:200px;
font-size:20px;">
Loading...
</div>


<?php if ($_SESSION['role'] == 'Admin') { ?>
    <a href="assign_bug.php">Assign</a>
<?php } ?>

<?php if ($_SESSION['role'] == 'Tester') { ?>
    <a href="report_bug.php">Report</a>
<?php } ?>

<?php if ($_SESSION['role'] == 'Developer') { ?>
    <a href="update_status.php">Update</a>
<?php } ?>

<div class="nav-right">
    <span><?= $_SESSION['user']; ?> (<?= $_SESSION['role']; ?>)</span>
</div>

