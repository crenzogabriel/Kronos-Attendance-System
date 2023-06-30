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
  ?>


<!-- HTML STARTS HERE, DO NOT MODIFY PHP ABOVE -->
<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>View Gradebook | KRONOS </title>
<meta charset="UTF-8">
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>

<link rel="stylesheet" href="views.css">

<!-- FOR SEARCH BAR (DO NOT REMOVE) -->
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>
<!-- head ended -->

<!-- body started -->
<body>

  <?php
  //FOR PAGINATION
      if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;


  //FETCH DATA FROM DATABASE
 /* $query = "SELECT COUNT(*) FROM students ORDER BY id asc";
  $result = mysqli_query($con, $query);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM students LIMIT $offset, $no_of_records_per_page";
  $res_data = mysqli_query($con,$sql);
*/





/*
$query = "SELECT fname, lname, studentid, COUNT(*) AS total_present
          FROM attendancetable
          WHERE status = 'present'
          GROUP BY fname, lname, studentid;";
$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $studentid = $row['studentid'];
        $total_present = $row['total_present'];

        echo "First Name: " . $fname . "<br>";
        echo "Last Name: " . $lname . "<br>";
        echo "Student ID: " . $studentid . "<br>";
        echo "Total present: " . $total_present . "<br><br>";
    }
}
*/
  ?>





<!-- SCRIPT FOR SEARCH BAR 
<script type="text/javascript">
  $(document).ready(function(){
    
      $("#live_search").keyup(function(){
        var input = $(this).val();
        //alert(input);

        if(input != ""){
          $.ajax({

            url:"../scripts/livesearchstudent.php",
            method:"POST",
            data:{input:input},

            success:function(data){
              $("#searchresult").html(data);
              $("#searchresult").css("display","block");
            }
          });
        }else{
          $("#searchresult").html(table);
          //$("#searchresult").css("display","none");
        }
      });
    });

  </script>
 END OF SCRIPT FOR SEARCH BAR -->

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

<!-- END OF BACKGROUND -->

<center>
<h2>All Students</h2>

<br>

<!-- SEARCH BAR -->

<div class = "search">
  <div class ="container" style="max-width: 17%;">
          <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search Student...">
      </div>
</div>

<!-- END OF SEARCH BAR-->

<br>

<!-- DISPLAY RESULTS -->
<div id="searchresult">

  <table align="center" class="content-table" id="table">
    <tr>
      <tr style="background-color: #045de9; color: white">
      <td><b><center>Student ID</td>
      <td><b><center>First Name</td>
      <td><b><center>Last Name</td>
      <td><b><center>Total Present</td>
      <td><b><center>Total Late</td>
      <td><b><center>Total Absent</td>
      <td><b><center>Total Score Percentage</td>

    
    </tr>

    <?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the selected date, students' attendance and subject
    if (isset($_POST["generate"])) {
      // $formattedDate = date('Y-m-d', strtotime($selectedDate));
      $subject = $_POST["subject"];




//$query = "SELECT * FROM students WHERE subject = '$subjectname' ORDER BY id asc";

$query = "SELECT fname, lname, studentid,
          SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) AS total_present,
          SUM(CASE WHEN status = 'late' THEN 1 ELSE 0 END) AS total_late,
          SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) AS total_absent
          FROM attendancetable
          WHERE subject = '$subject'
          GROUP BY fname, lname, studentid;";
        
$result = mysqli_query($con, $query);







if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $studentid = $row['studentid'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $total_present = $row['total_present'];
        $total_late = $row['total_late'];
        $total_absent = $row['total_absent'];

//score calculation
        $total_days = $total_present + $total_late + $total_absent;
        $pres = ($total_present / $total_days) * 1 ;
        $score = $pres * 100;
        ?>

        <tr>
            <td><?php echo $studentid; ?></td>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $total_present; ?></td>
            <td><?php echo $total_late; ?></td>
            <td><?php echo $total_absent; ?></td>
            <td><?php echo ceil($score); ?>%</td>
        </tr>
        <?php
    }
}
    }}

        /*  $count = 1;
                while ($row = mysqli_fetch_assoc($statres)) { 
                    $studentid = $row['studentid'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $total_present = $row['total_present'];
    ?>
          
                <tr>
                  <td><?php echo $row['studentid']; ?></td>
             
                  <td><?php echo $row['fname']; ?></td>
                  <td><?php echo $row['lname']; ?></td>
                  <td><?php echo $row['total_present']; ?></td>
               
        
                </tr>
                
    <?php 
                $count++;
          
               } 
*/
        
    ?>

</div>      
              
  </table>
    
  </div>
  
</div>

<!-- END OF DISPLAY RESULTS -->

<br>
<br>
<br>
<br>
<br>
<!--
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
            -->
</center>


</body>
</html>
