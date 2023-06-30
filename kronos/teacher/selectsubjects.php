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
    //establishing connection
    include('../connect.php');

    $identity = $_SESSION['identity'];

    $sel = "SELECT * FROM faculty WHERE id = $identity";
    $query = mysqli_query($con,$sel);
    $resul = mysqli_fetch_assoc($query);
  ?>


<!-- HTML STARTS HERE, DO NOT MODIFY PHP ABOVE -->
<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Select Subjects | KRONOS </title>
<meta charset="UTF-8">
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>


<link rel="stylesheet" href="views.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

       




</head>
<!-- head ended -->

<!-- body started -->
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



<center>
<h2>Select Subject</h2>

<br>

  <table align="center" class="content-table">
  <tr>
    <tr style="background-color: #045de9; color: white">
    <td><b><center>Subject Code</td>
    <td><b><center>Subject Name</td>
    <td><b><center>Faculty Assigned To</td>
    <td><b><center>View Enrolled Students</td>
    <!-- <td><b><center>Delete</td> -->
  </tr>
  
     <?php
       
      
       
       $query = ("SELECT subjects.id, subjects.subject_code, subjects.subject_name, faculty.lname
       FROM subjects
       INNER JOIN faculty ON faculty.id = subjects.facultyid
       WHERE faculty.id = $identity");
       $result = mysqli_query($con, $query);
        
        
       $count = 1;
       while ($row = mysqli_fetch_assoc($result)) {
         $id = $row['id'];
         $subject_code = $row['subject_code'];
         $subject_name = $row['subject_name'];
         $facultyid = $row['lname'];
     
?>
     <tr>
       <td><?php echo $row['subject_code']; ?></td>
       <td><?php echo $row['subject_name']; ?></td>
       <td><?php echo $row['lname']; ?></td>
       <td><a href="takeattendance.php?edit=<?php echo $row['id'];?>">View</a></td>
     </tr>
 

      <?php 
      $count++; //increment for table rows
      } ?> 
      <script src='../scripts/deletesubject.js.php'></script>          
    
          
      </table>
    
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->





</html>
