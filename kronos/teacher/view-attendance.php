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

    /* 
  
    if (isset($_GET['ID'])){
      $ID=$_GET['ID'];
      $delete=mysqli_query($con, "DELETE FROM users WHERE ID = '$ID'");
    }

    */

  ?>


<!-- HTML STARTS HERE, DO NOT MODIFY PHP ABOVE -->
<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>View Attendance | KRONOS </title>
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
<h2>View Attendance</h2>

<br>

  <table align="center" class="content-table">
  <tr>
    <tr style="background-color: #045de9; color: white">
    <td><b><center>Student ID</td>
    <td><b><center>First Name</td>
    <td><b><center>Last Name</td>
    <td><b><center>Subject</td>
    <td><b><center>Date</td>
    <td><b><center>Status</td>
  </tr>
  


     <?php

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the selected date, students' attendance and subject
        if (isset($_POST["generate"])) {
          $selectedDate = $_POST["selected_date"];
          // $formattedDate = date('Y-m-d', strtotime($selectedDate));
          $subject = $_POST["subject"];
          
          
          // SQL query to select the record from the source table
          $selectQuery = "SELECT * FROM attendancetable WHERE subject = '$subject' AND attendanceDate = '$selectedDate'";

          $result = mysqli_query($con, $selectQuery);
          
          $count = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['studentid'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $subject = $row['subject'];
            $attendanceDate = $row['attendanceDate'];
            $status = $row['status'];
          ?>
            <tr>
              <td><?php echo $row['studentid']; ?></td>
              <td><?php echo $row['fname']; ?></td>
              <td><?php echo $row['lname']; ?></td>
              <td><?php echo $row['subject']; ?></td>
              <td><?php echo $row['attendanceDate']; ?></td>
              <td><?php echo $row['status']; ?></td>
            </tr>
      

            <?php 
            $count++; //increment for table rows
          } 
        } 
      }
       ?>
          
  </table>

</center>

</body>
<!-- Body ended  -->





</html>
