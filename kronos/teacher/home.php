<?php include("teachernav.php"); ?>

<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{

  header('location: ../index.php');
}
?>

<?php

include('../connect.php');

$identity = $_SESSION['identity'];
 ?>

 <?php
    $sel = "SELECT * FROM faculty WHERE id = $identity";
    $query = mysqli_query($con,$sel);
    $resul = mysqli_fetch_assoc($query);
?>

<!-- HTML STARTS HERE, DO NOT MODIFY PHP -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | KRONOS</title> 
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   </head>
<body>


<!-- BACKGROUND -->
<div class="wrapper">
        <div class="box">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
</div>

<!-- BACKGROUND END -->



  
  <div class="center">
    <img class = "logo" src = "../logo.png">
    <div class="title">Welcome Back, </div>
    <div class="sub_title"><?php echo $resul['fname']; ?></div>
    <div class="btns">

    </div>
  </div>
</body>
</html>
