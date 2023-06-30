
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
$query = "SELECT * FROM students WHERE id = '$getid'";
       $result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $subjectid = $row['subjectid'];


  try{

    //validation of empty fields
    if(isset($_POST['signup'])){
       $upsubjectid = $_POST['upsubjectid'];

       $result = mysqli_query($con, "update students set subjectid = '$upsubjectid' where id = '$id'");
       if($result){
        echo '<script language="javascript">';
        echo 'alert("Student Enrolled Successfully!");';
        echo'</script>';
       } else{
        echo '<script language="javascript">';
        echo 'alert("Cannot complete the action!");';
        echo '</script>';
       }

    
  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }

?>

<!-- HTML STARTS HERE, DO NOT MODIFY PHP -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update User | KRONOS </title>
    <link rel="stylesheet" href="adminsignup.css">
    <link rel="stylesheet" href="views.css">
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


<?php //FOR DISPLAY
      
       
       $query = "SELECT * FROM students WHERE id = '$getid'";
       $result = mysqli_query($con, $query);

       $count = 1;
       while ($row = mysqli_fetch_assoc($result)) {
         $id = $row['id'];
         $fname = $row['fname'];
         $lname = $row['lname'];
       
?>


<!--  student information -->
<div class="container">
    <div class="title">Student Information</div>
    <div class="content">
        <div class="user-details">
        <table align="center" class="content-table">
       

        <tr>
            <td><b><center>Student ID: </td>
            <td><?php echo $row['id']; ?></td>
        </tr>
        <tr>
            <td><b><center>First Name: </td>
            <td><?php echo $row['fname']; ?></td>
        </tr>
        <tr>
            <td><b><center>Last Name: </td>
            <td><?php echo $row['lname']; ?></td>
        </tr>
       
            
     </tr>
        
        </div>
       </table>




        <?php 
      $count++; //increment for table rows
      } ?> 
    </div>
    </div>
    


  <div class="container">
    <div class="title">Enroll Student</div>
    <div class="content">
      <form method ="post" enctype="multipart/form-data">
        <div class="user-details">
        
        <div class="input-box">
          <?php 

                $query=mysqli_query($con,"select * from subjects ORDER BY id ASC");
                                    
               $count = mysqli_num_rows($query);
                   if($count > 0){      
                      echo '<span class = "details"> Enroll To </span>';
                      echo ' <select required name="upsubjectid" class="custom-select form-control">';
                      echo '<option value="">--Select Subject Name--</option>';
                      
                      while ($row = mysqli_fetch_array($query)) {
                      echo'<option value="'.$row['id'].'" >'.$row['subject_name'].'</option>';
                       }
                      echo '</select>';
                      }
                      ?>   
          </div>
          
        </div>
       
        <div class="button">
          <input type="submit" value="Enroll" name="signup">
        </div>
      </form>
    </div>
  </div>

</body>
</html>