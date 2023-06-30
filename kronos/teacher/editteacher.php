
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

$query = "SELECT * FROM faculty WHERE id = $identity";
       $result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $pass = $row['pass'];


  try{

    //validation of empty fields
    if(isset($_POST['signup'])){
       

        $upfname =  $_POST['upfname'];
        $uplname =  $_POST['uplname'];
        $upusername =  $_POST['upusername'];
        $upemail =  $_POST['upemail'];
        $upphone =  $_POST['upphone'];
        $uppass =  $_POST['uppass'];

      
        $query = "SELECT username FROM faculty WHERE username = '$upusername' ";
        $result = mysqli_query($con, $query);
  
        if(mysqli_num_rows($result) > 0)
        {
          echo '<script language="javascript">';
        echo 'alert("Username already exists.");';
        echo'</script>';
           //$_SESSION['message'] = "Username already exists.";
              mysqli_close($con);
              
        }
        else{

       $result = mysqli_query($con, "update faculty SET fname = '$upfname',lname = '$uplname',username = '$upusername',email = '$upemail',phone = '$upphone',pass = '$uppass' where id = '$id'");
       if($result){
        echo '<script language="javascript">';
        echo 'alert("Profile updated successfully!");';
        echo'</script>';
       } else{
        echo '<script language="javascript">';
        echo 'alert("Cannot complete the updates!");';
        echo '</script>';
       }
      //  $success_msg="Signup Successfully!";
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
    <link rel="stylesheet" href="teachersignup.css">
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
      
       
       $query = "SELECT * FROM faculty WHERE id = $identity";
       $result = mysqli_query($con, $query);

       $count = 1;
       while ($row = mysqli_fetch_assoc($result)) {
         $id = $row['id'];
         $fname = $row['fname'];
         $lname = $row['lname'];
         $username = $row['username'];
         $email = $row['email'];
         $phone = $row['phone'];
         $pass = $row['pass'];
?>


<!--  Faculty information -->
<div class="container">
    <div class="title">Faculty Information</div>
    <div class="content">
        <div class="user-details">
        <table align="center" class="content-table">
       

        <tr>
            <td><b><center>Faculty ID: </td>
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
        <tr>
            <td><b><center>Username: </td>
            <td><?php echo $row['username']; ?></td>
        </tr>
        <tr>
            <td><b><center>Password: </td>
            <td><?php echo $row['pass']; ?></td>
        </tr>
        <tr>
            <td><b><center>Email Address: </td>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
            <td><b><center>Phone Number: </td>
            <td><?php echo $row['phone']; ?></td>
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
    <div class="title">Update Information</div>
    <div class="content">
      <form method ="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="upfname"  placeholder="Enter First Name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="uplname"  placeholder="Enter Last Name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="upusername" placeholder="Enter Username" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" name="uppass" placeholder="Enter Password" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="upphone" placeholder="Enter number" required>
          </div>
          <div class="input-box">
            <span class="details">Email Address</span>
            <input type="text" name="upemail" placeholder="Enter email" required>
          </div>
        </div>
       
        <div class="button">
          <input type="submit" value="Update" name="signup">
        </div>
      </form>
    </div>
  </div>

</body>
</html>