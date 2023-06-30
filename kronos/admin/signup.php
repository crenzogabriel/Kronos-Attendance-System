
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

  try{

    //validation of empty fields
    
    if(isset($_POST['signup'])){


        if(empty($_POST['fname'])){
          throw new Exception("First name can't be empty.");
        }

      if(empty($_POST['lname'])){
        throw new Exception("Last name can't be empty.");
        }
        if(empty($_POST['username'])){
          throw new Exception("username can't be empty.");
          }

        if(empty($_POST['email'])){
          throw new Exception("Email can't be empty.");
        }

        if(empty($_POST['pass'])){
          throw new Exception("Password can't be empty.");
        }
        
      
        if(empty($_POST['phone'])){
          throw new Exception("Username can't be empty.");
       }


      $fname = $_POST['fname'];
      $lname =$_POST['lname'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $pass = $_POST['pass'];
      $cpass = $_POST['cpass'];
      $phone = $_POST['phone'];

       if($cpass != $pass)
    {
      echo '<script language="javascript">';
      echo 'alert("Passwords do not match.");';
      echo'</script>';

     /* $_SESSION['message'] = "Passwords do not match.";
      echo '         <script type="text/javascript" language="javascript">';
      echo '      function showAlert() { ';
      echo '        var myText = "Passwords do not match!!"; ';
      echo '        alert (myText); ';
      echo '      } </script> ';
    */
    }
    else
    {

      $query = "SELECT username FROM faculty WHERE username = '$username' ";
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
        $result = mysqli_query($con, "insert into faculty(fname,lname,username,pass,email,phone) values('$_POST[fname]','$_POST[lname]','$_POST[username]','$_POST[pass]','$_POST[email]','$_POST[phone]')");
        if($result){
         echo '<script language="javascript">';
         echo 'alert("Faculty Created Successfully!");';
         echo'</script>';
        } else{
         echo '<script language="javascript">';
         echo 'alert("Cannot complete the action!");';
         echo '</script>';
        }

      }
      
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
    <title> Create User | KRONOS </title>
    <link rel="stylesheet" href="adminsignup.css">
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
    <div class="title">Add Faculty</div>
    <div class="content">
      <form method ="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="fname" placeholder="Enter First Name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lname" placeholder="Enter Last Name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter Username" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" placeholder="Enter number" required>
          </div>
          <div class="input-box">
            <span class="details">Email Address</span>
            <input type="text" name="email" placeholder="Enter email" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="pass" placeholder="Enter password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="cpass" placeholder="Confirm password" required>
          </div>
        </div>
       
        <div class="button">
          <input type="submit" value="Add Faculty" name="signup">
        </div>
      </form>
    </div>
  </div>

</body>
</html>