<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();
include("connect.php");

$username = $_POST['username'];

$password = $_POST['password'];


$query = "SELECT * FROM user 
          WHERE username='$username'

          AND password='$password'";

$result = mysqli_query($connect,$query);

if(mysqli_num_rows($result)>0){

    $userdata = mysqli_fetch_array($result);

    $groups = mysqli_query($connect,"SELECT * FROM user WHERE role=3");

    $groupsdata = mysqli_fetch_all($groups,MYSQLI_ASSOC);

    $_SESSION['userdata']=$userdata;
    $_SESSION['groupsdata']=$groupsdata;

    header("location: ../routes/Dashboard.php");
}
else{
    echo "<script>
        alert('Invalid Credentials');
        window.location='../index.html';
    </script>";
}
?>
