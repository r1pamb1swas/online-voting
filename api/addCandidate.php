<?php
include("connect.php");

$name = $_POST['name'];
$address = $_POST['address'];

$image = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];

$folder = __DIR__."/../uploads/";

if(!file_exists($folder)){
    mkdir($folder);
}

$path = $folder . basename($image);

if(move_uploaded_file($tmp, $path)){

    mysqli_query($connect,
    "INSERT INTO user(name,address,photo,role,status,votes)
     VALUES('$name','$address','$image',3,0,0)");

    echo "<script>
    alert('Candidate Added Successfully');
    window.location='../routes/Dashboard.php';
    </script>";

}else{

    echo "<script>
    alert('Image Upload Failed');
    window.location='../routes/addCandidate.php';
    </script>";

}
?>
