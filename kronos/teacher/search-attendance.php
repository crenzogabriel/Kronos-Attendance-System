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
    <title> Create Subject | KRONOS </title>
    <link rel="stylesheet" href="teachersignup.css">
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



  <div class="container">
    <div class="title">Enter Subject and Date of Attendance</div>
    <div class="content">
      <form action="view-attendance.php" method ="post">
        <div class="user-details">
          <div class="input-box">
          <?php 
               $query=mysqli_query($con,"select * from subjects where facultyid = '$identity' ORDER BY id ASC");                        
               $count = mysqli_num_rows($query);
                   if($count > 0){      
                      echo '<span class = "details"> Subject Name </span>';
                      echo ' <select required name="subject" class="custom-select form-control">';
                      echo '<option value="">--Select Subject--</option>';
                      
                      while ($row = mysqli_fetch_array($query)) {
                      echo'<option value="'.$row['subject_name'].'" >'.$row['subject_name'].'</option>';
                       }
                      echo '</select>';
                      }
                      ?>   
          </div>

          <div class="input-box">
            <span class="details">Attendance Date: </span>
            <input type="date" value="<?php echo date('Y-m-d');?>" name="selected_date" id="date">
          </div>

                    

        </div>
       
        <div class="button">
          <input type="submit" value="View Attendance" name="generate">
        </div>
      </form>
    </div>
  </div> 

</body>
</html>