
<?php include("studentnav.php"); ?>

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
if(isset($_POST['create'])){

  $alertStyle ="";
   $statusMsg="";

$subject_code=$_POST['subject_code'];
$subject_name=$_POST['subject_name'];
$facultyid=$_POST['facultyid'];



 $query=mysqli_query($con,"select * from subjects where facultyid ='$facultyid' and subject_name = '$subject_name'");
 $ret=mysqli_fetch_array($query);
 if($ret > 0){

   $alertStyle ="alert alert-danger";
   $statusMsg="This Department already exist for this Faculty!";

 }
 else{

$query=mysqli_query($con,"insert into subjects(subject_code,subject_name,facultyid) value('$subject_code','$subject_name','$facultyid')");

 if ($query) {

   $alertStyle ="alert alert-success";
   $statusMsg="Department Added Successfully!";
}
else
 {
   $alertStyle ="alert alert-danger";
   $statusMsg="An error Occurred!";
 }
}
}




/* ORIGINAL
//establishing connection
include('../connect.php');

  try{

    //validation of empty fields
    if(isset($_POST['create'])){


        if(empty($_POST['subject_code'])){
          throw new Exception("Code can't be empty.");
        }

      if(empty($_POST['subject_name'])){
        throw new Exception("Subject Name can't be empty.");
        }

       $result = mysqli_query($con, "insert into subjects(subject_code,subject_name) values('$_POST[subject_code]','$_POST[subject_name]')");
       $success_msg="Subject created Successfully!";

  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }
*/
?>

<!-- HTML STARTS HERE, DO NOT MODIFY PHP -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create Subject | KRONOS </title>
    <link rel="stylesheet" href="studentsignup.css">
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
    <div class="title">Enter Subject</div>
    <div class="content">
      <form action="v-attendance.php" method ="post">
        <div class="user-details">
          <div class="input-box">
          <?php 
               $query=mysqli_query($con,"select * from subjects ORDER BY id ASC");                        
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

        </div>
       
        <div class="button">
          <input type="submit" value="View Attendance" name="generate">
        </div>
      </form>
    </div>
  </div>

</body>
</html>