<?php
session_start();
if($_SESSION['userdata']['role'] != 2){
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Candidate</title>

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

/* FORM */

.container{
    padding:40px;
}

.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    width:400px;
    margin:auto;
}

input{
    width:100%;
    padding:10px;
    margin-top:10px;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    width:100%;
    margin-top:20px;
    padding:10px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:6px;
    font-size:15px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
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

<h2>Add Candidate</h2>

<form action="../api/addCandidate.php" method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Candidate Name" required>

<input type="text" name="address" placeholder="Address" required>

<input type="file" name="photo" required>

<button>Add Candidate</button>

</form>

</div>

</div>

</body>
</html>
