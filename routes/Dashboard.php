<?php
session_start();

if(!isset($_SESSION['userdata'])){
    header("location: ../index.html");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
$status = ($userdata['status']==0) ? "Not Voted" : "Voted";
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard | Online Voting System</title>

<style>

/* ===== BASE ===== */

body{
    margin:0;
    background:#f4f6fb;
    font-family: Arial, Helvetica, sans-serif;
    color:#0f172a;
}

/* ===== NAVBAR ===== */

.navbar{
    background:#1e3a8a;
    height:64px;
    padding:0 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;

    position:sticky;
    top:0;
    z-index:1000;
}

.nav-left{
   display:flex;
    align-items:center;
    gap:12px;
    font-size:18px;
    font-weight:600;
    letter-spacing:0.5px;

}

.nav-right{
    display:flex;
    align-items:center;
    gap:18px;
}

.nav-right a{
    color:white;
    text-decoration:none;
    font-size:14px;
    padding:8px 14px;
    border-radius:6px;
    transition:0.3s;
}

.nav-right a:hover{
    background:#2563eb;
}

.nav-right a:last-child{
    background:#2563eb;
}

.nav-right a:last-child:hover{
    background:#1d4ed8;
}

/* ===== LAYOUT ===== */

.container{
    display:flex;
    gap:25px;
    padding:30px;
}

/* ===== CARDS ===== */

.card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

/* ===== PROFILE CARD ===== */

.profile{
    width:30%;
    text-align:center;
}

.profile img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:10px;
}

.profile h3{
    margin:10px 0 5px;
}

.profile p{
    margin:5px 0;
}

.status-badge{
    display:inline-block;
    margin-top:8px;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.notvoted{
    background:#fee2e2;
    color:#b91c1c;
}

.voted{
    background:#dcfce7;
    color:#166534;
}

/* ===== GROUPS ===== */

.groups{
    width:70%;
}

.groups h3{
    margin-bottom:15px;
}

.group-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 0;
    border-bottom:1px solid #e5e7eb;
}

.group-item:last-child{
    border-bottom:none;
}

/* ===== BUTTONS ===== */

.vote-btn{
    background:#10b981;
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}

.vote-btn:hover{
    background:#059669;
}

.voted-btn{
    background:#9ca3af;
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:6px;
}
.logo{
    width:34px;
    height:34px;
    object-fit:contain;
}


.site-title{
    font-size:18px;
    font-weight:600;
}

</style>

</head>

<body>

<!-- NAVBAR -->
 


<div class="navbar">

    <div class="nav-left">
        <img src="../images/logo.png" class="logo">
        <span class="site-title">Online Voting System</span>
    </div>

    <div class="nav-right">

        <?php if($userdata['role']==2){ ?>
            <a href="addCandidate.php">Add Candidate</a>
        <?php } ?>
        <a href="results.php">Results</a>


        <a href="../index.html">Home</a>
        <a href="logout.php">Logout</a>

    </div>

</div>

<!-- MAIN CONTENT -->
<div class="container">

<!-- PROFILE -->
<div class="card profile">
    <img src="../uploads/<?php echo $userdata['photo']; ?>">
    <h3><?php echo $userdata['name']; ?></h3>
    <p><?php echo $userdata['mobile']; ?></p>
    <p><?php echo $userdata['address']; ?></p>

    <?php if($userdata['status']==0){ ?>
        <span class="status-badge notvoted">Not Voted</span>
    <?php } else { ?>
        <span class="status-badge voted">Voted</span>
    <?php } ?>
</div>

<!-- GROUPS -->
<div class="card groups">
    <h3>Available Groups</h3>

<?php
for($i=0;$i<count($groupsdata);$i++){
?>
    <div class="group-item">

        <div style="display:flex; align-items:center; gap:15px;">

    <img src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>"
         width="60"
         height="60"
         style="border-radius:50%; object-fit:cover;">

    <div>
        <b><?php echo $groupsdata[$i]['name']; ?></b><br>
        Votes: <?php echo $groupsdata[$i]['votes']; ?>
    </div>

</div>


        <form action="../api/vote.php" method="POST">
            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>">
            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">

            <?php if($userdata['status']==0){ ?>
                <button class="vote-btn">Vote</button>
            <?php } else { ?>
                <button class="voted-btn" disabled>Voted</button>
            <?php } ?>
        </form>

    </div>
<?php } ?>

</div>

</div>

</body>
</html>
