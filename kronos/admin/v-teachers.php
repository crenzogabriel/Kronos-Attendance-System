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

  ?>


<!-- HTML STARTS HERE, DO NOT MODIFY PHP ABOVE -->
<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>View Teachers | KRONOS </title>
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
  $query = "SELECT COUNT(*) FROM faculty ORDER BY id asc";
  $result = mysqli_query($con, $query);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  
  
  $query = "SELECT * FROM faculty LIMIT $offset, $no_of_records_per_page";
  $result = mysqli_query($con, $query);
  ?>

<!-- SCRIPT FOR SEARCH BAR -->
<script type="text/javascript">
  $(document).ready(function(){
    
      $("#live_search").keyup(function(){
        var input = $(this).val();
        //alert(input);

        if(input != ""){
          $.ajax({

            url:"../scripts/livesearchfaculty.php",
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
<!-- END OF SCRIPT FOR SEARCH BAR -->


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
<h2>All Teachers</h2>

<br>

<!-- SEARCH BAR -->

<div class = "search">
  <div class ="container" style="max-width: 17%;">
          <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search Faculty...">
      </div>
</div>

<!-- END OF SEARCH BAR-->

<br>

<!-- DISPLAY RESULTS -->
<div id="searchresult">

  <table align="center" class="content-table" id="table">
   
    <tr>
    <tr style="background-color: #045de9; color: white">
    <td><b><center>Teacher ID</td>
    <td><b><center>First Name</td>
    <td><b><center>Last Name</td>
    <td><b><center>Username</td>
    <td><b><center>Email Address</td>
    
    <td><b><center>Phone Number</td>
    <td><b><center>Edit</td>
    <td><b><center>Delete</td>
  </tr>

  <?php

       $count = 1;
       while ($row = mysqli_fetch_assoc($result)) {
         $id = $row['id'];
         $fname = $row['fname'];
         $lname = $row['lname'];
         $lname = $row['username'];
         $email = $row['email'];
         $phone = $row['phone'];
?>
     <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['fname']; ?></td>
       <td><?php echo $row['lname']; ?></td>
       <td><?php echo $row['username']; ?></td>
       <td><?php echo $row['email']; ?></td>
       <td><?php echo $row['phone']; ?></td>
       <td><a href="editteacher.php?edit=<?php echo $row['id'];?>">Edit</a></td>
       <td align='center'>
       <button class='delete btn btn-danger' id='del_<?= $id ?>' data-id='<?= $id ?>' >Delete</button>
       </td>
     </tr>
 
  <?php 
          $count++;
          
        } 

        
  ?>

</div>      
      <script src='../scripts/deleteteacher.js.php'></script>
    </table>
    
  </div>

</div>
<!-- END OF DISPLAY RESULTS -->

<br>
<br>
<br>
<br>
<br>

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

</center>


</body>
</html>
