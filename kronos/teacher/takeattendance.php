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


    $getid = $_GET['edit'];

    $sel = "SELECT subject_name FROM subjects WHERE id = '$getid'";
    $query = mysqli_query($con,$sel);
    $resul = mysqli_fetch_assoc($query);
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
<title>View Students | KRONOS </title>
<meta charset="UTF-8">
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>


<link rel="stylesheet" href="views.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

       
<style>
  .page-title{
    margin-bottom: 77px;
  }
</style>



</head>
<!-- head ended -->
<!--
<script>
            $(document).ready(function () {

                // Delete 
                $('.delete').click(function () {
                    var el = this;

                    // Delete id
                    var deleteid = $(this).data('id');

                    // Confirm box
                    bootbox.confirm("Do you really want to delete record?", function (result) {

                        if (result) {
                            // AJAX Request
                            $.ajax({
                                url: '../scripts/ajaxfile.php',
                                type: 'POST',
                                data: {id: deleteid},
                                success: function (response) {

                                    // Removing row from HTML Table
                                    if (response == 1) {
                                        $(el).closest('tr').css('background', 'tomato');
                                        $(el).closest('tr').fadeOut(800, function () {
                                            $(this).remove();
                                        });
                                    } else {
                                        bootbox.alert('Record not deleted.');
                                    }

                                }
                            });
                        }

                    });

                });
            });
        </script>
          -->

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
<h2 class="page-title">All Enrolled Students Of <?php echo $resul['subject_name']; ?></h2>

<br>


<form action="" method="post">
  <table align="center" class="content-table">
    <tr>
      <tr style="background-color: #045de9; color: white">
        <td><b><center>Student ID</td>
        <td><b><center>First Name</td>
        <td><b><center>Last Name</td>
        <td><b><center>Date: <input type="date" value="<?php echo date('Y-m-d');?>" name="dateOfAttendance" style="color: white; background-color: #045de9; border: 2px solid #045de9;border-radius: 5px;"></td>
        <!--<td><b><center><button class="gen-att" name="generate-attendance" style="color: white; background-color: green; border: 2px solid green;border-radius: 2px;">Generate Attendance</button></td> -->
        
        
        
        
        
      </tr>
              

      
      <?php
        
        
        
        $query = "SELECT * FROM students WHERE subjectid = '$getid' ORDER BY id asc";
        $result = mysqli_query($con, $query);

        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $studentId = $row['id'];
          $fname = $row['fname'];
          $username = $row['lname'];
          
      ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['fname']; ?></td>
        <td><?php echo $row['lname']; ?></td>
        <td>
            <?php //echo '<span class = "details"> Assign To </span>'; ?>
            <?php echo ' <select name="attendance['.$studentId.']" class="custom-select form-control" required>'; ?>
            <?php echo '<option value="">--Select Attendance--</option>'; ?>
            <?php echo '<option value="present">--Present--</option>'; ?>
            <?php echo '<option value="late">--Late--</option>'; ?>
            <?php echo '<option value="absent">--Absent--</option>'; ?>
          </td>
        
      </tr>
  
        
        <?php 
        $count++; //increment for table rows
        } ?>         
      
            
  </table>
  <center>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div>
  <button class="gen-att" name="generate-attendance">Generate Attendance</button>
      </div>
</form>
    
  </div>
    

</div>

</center>


<!-- back-end section (PHP) - Post attendance made to the database -->
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the selected date, students' attendance, and subject
  if (isset($_POST["generate-attendance"])) {
    $selectedDate = $_POST["dateOfAttendance"];
    $attendanceData = $_POST["attendance"];
    $subject = $resul['subject_name'];

    // Perform necessary validations and database operations
    // Assuming you have a database connection established

    // Process the attendance data
    foreach ($attendanceData as $studentId => $attendanceStatus) {
      // SQL query to select the record from the source table
      $selectQuery = "SELECT * FROM students WHERE id = $studentId";

      // Execute the query
      $result = mysqli_query($con, $selectQuery);

      // Check if the query was successful and fetch the record
      if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);

        // Prepare the UPDATE query for the destination table
        $updateQuery = "UPDATE attendancetable SET status = ? WHERE studentid = ? AND attendanceDate = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($con, $updateQuery);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sss", $attendanceStatus, $studentId, $selectedDate);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check the number of affected rows
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        // If no rows were affected, it means no matching record was found, so perform the INSERT
        if ($affectedRows == 0) {
          // Prepare the INSERT query for the destination table
          $insertQuery = "INSERT INTO attendancetable (fname, lname, status, subject, attendanceDate, studentid) VALUES (?, ?, ?, ?, ?, ?)";

          // Prepare the statement
          $stmt = mysqli_prepare($con, $insertQuery);

          // Bind parameters to the statement
          mysqli_stmt_bind_param($stmt, "ssssss", $record['fname'], $record['lname'], $attendanceStatus, $subject, $selectedDate, $studentId);

          // Execute the statement
          mysqli_stmt_execute($stmt);
        }
      }
    }

    // Provide feedback to the user or perform any other required actions
    echo "Attendance taken on $selectedDate has been stored in the database.<br>";

    if ($record) {
      echo '<script language="javascript">';
      echo 'alert("Attendance success!");';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("Cannot complete attendance!");';
      echo '</script>';
    }
  }
}
?>


</body>
<!-- Body ended  -->





</html>
