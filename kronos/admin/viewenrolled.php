<?php include("adminnav.php"); ?>
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
<h2>All Enrolled Students Of <?php echo $resul['subject_name']; ?></h2>

<br>

  <table align="center" class="content-table">
  <tr>
    <tr style="background-color: #045de9; color: white">
    <td><b><center>Student ID</td>
    <td><b><center>First Name</td>
    <td><b><center>Last Name</td>
    
    
    
    
  </tr>
  
     <?php
       
      
       
       $query = "SELECT * FROM students WHERE subjectid = '$getid' ORDER BY id asc";
       $result = mysqli_query($con, $query);

       $count = 1;
       while ($row = mysqli_fetch_assoc($result)) {
         $id = $row['id'];
         $fname = $row['fname'];
         $username = $row['lname'];
         
?>
     <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['fname']; ?></td>
       <td><?php echo $row['lname']; ?></td>
       
     </tr>
 

      <?php 
      $count++; //increment for table rows
      } ?> 
      <script src='../scripts/deletestudent.js.php'></script>          
    
          
      </table>
    
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->





</html>
