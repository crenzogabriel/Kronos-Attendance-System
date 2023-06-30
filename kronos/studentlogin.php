<?php

if(isset($_POST['login'])) //FOR LOGIN
{
  $username = $_POST['username'];
  $pass = $_POST['pass'];
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("username is required!");
			
		}
		if(empty($_POST['pass'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		

    
    //session_start();
      $numrows=0;
		$result=mysqli_query($con, "select * from students where username='$_POST[username]' and pass='$_POST[pass]'");
		$numrows=mysqli_num_rows($result);

      if($numrows!=0){
        while($row=mysqli_fetch_assoc($result)){
          $dbusername=$row['username'];
          $dbpassword=$row['password'];
          $dbid=$row['id'];
        }
            session_start();
            $_SESSION['name'] = "oasis";
            $_SESSION['identity'] = $dbid;
            header('location: student/home.php');
      }
            
    else{
			throw new Exception("ID/Password is invalid. Try again!");
			
			header('location: index.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
}
	//end of try-catch
  

?>




<?php
//SIGNUP
include('connect.php');

  try{
    
      if(isset($_POST['signup'])){


        if(empty($_POST['fname'])){
          throw new Exception("First name can't be empty.");
        }

       if(empty($_POST['lname'])){
        throw new Exception("Last name can't be empty.");
        }

        if(empty($_POST['username'])){
            throw new Exception("First name can't be empty.");
          }

        if(empty($_POST['email'])){
          throw new Exception("Email can't be empty.");
        }

        if(empty($_POST['pass'])){
           throw new Exception("Password can't be empty.");
        }
        if(empty($_POST['cpass'])){
          throw new Exception("Password can't be empty.");
       }
        
       
        if(empty($_POST['phone'])){
           throw new Exception("Phone can't be empty.");
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
     
      }
      else
      {

        
      $query = "SELECT username FROM students WHERE username = '$username' ";
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
  $result = mysqli_query($con, "insert into students(fname,lname,username,pass,email,phone) values('$_POST[fname]','$_POST[lname]','$_POST[username]','$_POST[pass]','$_POST[email]','$_POST[phone]')");
  if($result){
    echo '<script language="javascript">';
    echo 'alert("Signup Successful!");';
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


<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>

<!-- START OF HTML, DO NOT MODIFY PHP -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Kronos Attendance System </title>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
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
    <!-- Header -->
    <header class="header">
      <nav class="nav">
      <img class = "logo" src="logo.png" alt="">
      
        <button class="button" id="form-open">Student Login</button>
      </nav>
    </header>

    <ul><a href="#" class="nav_logo">KRONOS ATTENDANCE SYSTEM</a>
        <hr class="line">
        <a class="nav_tagline">
          Efficiency in Every Clock Tick: <br> Empower Your Organization with Seamless Attendance Management!</a>
    </ul>

    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>

        <!-- Login Form -->
        <div class="form login_form">
          <form method="post">


          <div class = "logo-container">
            <img class = "logo1" src = "logo.png">
            <h2>Student Login</h2>
          </div>
            <div class="input_box">
              <input type="text" name="username" id="input1" placeholder="Enter your username" required />
              <i class="uil uil-user user"></i>
            </div>

          

            <div class="input_box">
              <input type="password" name="pass" id="input1" placeholder="Enter your password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
           

            <button class="button" input type="submit" name="login">Login Now</button>
            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
            <a href="#" class="forgot_pw"><p style="text-align: center">Forgot password?</p></a>
            <div class="login_signup">Login as: <a href="index.php">Admin |</a> <a href="teacherlogin.php">Faculty</a></div> 
      
          </form>
        </div>


        <!-- Signup Form -->
        <div class="form signup_form">
          <form method="post">

          <div class = "logo-container">
            <img class = "logo1" src = "logo.png">
            <h2>Student Signup</h2>
          </div>
            

            <div class="input_box">
              <input type="text" name="fname" placeholder="First Name" required />
              <i class="uil uil-user user"></i>
            </div>
            <div class="input_box">
              <input type="text" name="lname" placeholder="Last Name" required />
              <i class="uil uil-user user"></i>
            </div>
            <div class="input_box">
              <input type="text" name="username" placeholder="Username" required />
              <i class="uil uil-user-square usersquare"></i>
            </div>
            <div class="input_box">
              <input type="number" name="phone" placeholder="Contact Number" required />
              <i class="uil uil-phone-alt phone"></i>
            </div>
            <div class="input_box">
              <input type="email" name="email" placeholder="Email Address" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            
            <div class="input_box">
              <input type="password" name = "pass" placeholder="Create password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" name="cpass" placeholder="Confirm password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

         
                                                                  

            <button type = "submit" name="signup" class="button">Signup Now</button>

            <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          </form>
        </div>
      </div>
    </section>
    </div>

    <script src="scripts/script.js"></script>
</body>
</html>
    

    