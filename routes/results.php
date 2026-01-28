<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../index.php");
    exit();
}

include("../api/connect.php");

$result = mysqli_query($connect,
"SELECT name, votes, photo FROM user WHERE role=3 ORDER BY votes DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Results | Online Voting System</title>

<style>

body{
    margin:0;
    background:#f4f6fb;
    font-family:Arial;
}

/* NAVBAR */

.navbar{
    background:#1e3a8a;
    height:64px;
    padding:0 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
}

.nav-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo{
    width:34px;
    height:34px;
}

.site-title{
    font-size:18px;
    font-weight:600;
}

.nav-right a{
    color:white;
    text-decoration:none;
    margin-left:15px;
    padding:8px 14px;
    border-radius:6px;
}

.nav-right a:hover{
    background:#2563eb;
}

/* CONTENT */

.container{
    padding:40px;
}

.card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    max-width:700px;
    margin:auto;
}

.result-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #e5e7eb;
}

.result-item:last-child{
    border-bottom:none;
}

.result-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.result-left img{
    width:60px;
    height:60px;
    border-radius:50%;
    object-fit:cover;
}

.vote-count{
    background:#2563eb;
    color:white;
    padding:6px 14px;
    border-radius:20px;
}

</style>
</head>

<body>

<div class="navbar">
    <div class="nav-left">
        <img src="../images/logo.png" class="logo">
        <span class="site-title">Online Voting System</span>
    </div>

    <div class="nav-right">
        <a href="Dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

<div class="card">

<h2>Election Results</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="result-item">

    <div class="result-left">
        <img src="../uploads/<?php echo $row['photo']; ?>">
        <b><?php echo $row['name']; ?></b>
    </div>

    <div class="vote-count">
        <?php echo $row['votes']; ?> Votes
    </div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
