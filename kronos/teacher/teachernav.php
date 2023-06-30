<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<style>
/*NAVIGATION BAR HEADER */
/* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
a {
  text-decoration: none;
}
.header { 
  position: fixed;
  height: 80px;
  width: 100%;
  z-index: 100;
  padding: 0 20px;
}
.nav { 
  max-width: calc(100% - 400px);
  width: 100%;
  margin: 0 auto;
  
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
.nav,
.nav_item { 
  display: flex;
  height: 100%;
  align-items: center;
  justify-content: space-between;
}

.nav_link{
  
  
}
.nav_logo,
.nav_link,
.button {
  color: #0069d9;
}
.nav_logo {
  position: relative;
    font-size: 25px;
    top: 20px;
}
.nav_item {
  
  width: 100%;
}
.nav_link:hover {
  color: #d9d9d9;
}


a.buttons1{
  padding: 6px 24px;
  border: 2px solid #0069d9;
  background: #0069d9;
  border-radius: 6px;
  cursor: pointer;
  color: #ffff;
}
a.buttons1:hover{
  padding: 6px 24px;
  border: 2px solid #0069d9;
  background: transparent;
  border-radius: 6px;
  cursor: pointer;
  color: #0069d9;
}



.nav-links{
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  background: #ffff;
  width:100%;
 /* padding: 15px 100px; */
}
.nav-links li{
  list-style: none;
  align-items: center;
  justify-content: space-evenly;
  display: flex;
  width: 100%
}

.nav-links li a{
  position: relative;
  color: #4070f4;
  font-size: 20px;
  font-weight: 500;
  padding: 10px 20px;
  text-decoration: none;
  text-align: center;
}
.nav-links li a:before{
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3px;
  width: 0%;
  background: #34efdf;
  border-radius: 12px;
  transition: all 0.4s ease;
}
.nav-links li a:hover:before{
  width: 100%;
  
}

.nav-links li.forward a:before{
  width: 100%;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.4s ease;
}
.nav-links li.forward a:hover:before{
  transform: scaleX(1);
  transform-origin: left;
}

li.forward{
  width:100%;
  text-align:center;
}


.nav-links .nav_item ul{
  /*position: absolute;
  background: red;
  top: 0px;
  z-index: -1;
  opacity: 0;
  visibility: visible;  */

  position: absolute;
  top: 37px;
  visibility: hidden;
  opacity: 0;
  /*transform: translateY(-2em); */
  z-index: 1;
  transition: all 0.3s ease-in-out 0s, visibility 0s linear 0.3s, z-index 0s linear 0.01s;
  background: #fff;
}

.nav-links .nav_item li:hover ul{
  top: 65px;
  opacity: 1;
  visibility: visible;
  transition: all 0.3s ease;
  
}

.nav-links .nav_item ul li a{
  display: block;
  width: 100%;
  line-height: 30px;
  border-radius: 0px!important;
}

.nav-links .nav_item ul ul{
  position: absolute;
  top: 0;
  right: calc(-100% + 8px);
}
.nav-links .nav_item ul li{
  position: relative;
}
.nav-links .nav_item ul li:hover ul{
  top: 0;
  display:block;
}
.nav-links .nav_item li a.desktop-link{
    display: none;
  }

.content .links #show-manage:checked ~ ul{
    max-height: 100vh;
  }



  </style>
</head>
<body>
    
<!-- header section starts  -->

<header class="header">
      <nav class="nav">
        <a href="home.php" class="nav_logo"><img src="../logo.png" width="180"></a>
       
        <div class = "nav-links">
          <ul class="nav_item">
            <li class="forward"><a href="home.php" class="nav_link">Home</a> </li>
            <li class="forward"><a href="" class="nav_link">Attendance</a> 
              <ul>
                  <li><a href="selectsubjects.php">Take Attendance</a></li>
                  <li><a href="search-attendance.php">View Attendance</a></li>
                  <li><a href="search-gradebook.php">View Gradebook</a></li>
              </ul>
            </li>
            <li class="forward"><a href="editteacher.php" class="nav_link">Manage Profile</a> </li>
            

          </ul>
        </div>
        <a href ="../logout.php" class="buttons1 " id="form-open">Logout</a> 
      </nav>
</header>
