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
  $query = "SELECT COUNT(*) FROM students ORDER BY id asc";
  $result = mysqli_query($con, $query);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM students LIMIT $offset, $no_of_records_per_page";
  $res_data = mysqli_query($con,$sql);
  ?>

<!-- SCRIPT FOR SEARCH BAR -->
<script type="text/javascript">
  $(document).ready(function(){
    
      $("#live_search").keyup(function(){
        var input = $(this).val();
        //alert(input);

        if(input != ""){
          $.ajax({

            url:"../scripts/livesearchenroll.php",
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
<h2>Enroll Student</h2>

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
  <table align="center" class="content-table">
  <tr>
    <tr style="background-color: #045de9; color: white">
    <td><b><center>Student ID</td>
    <td><b><center>First Name</td>
    <td><b><center>Last Name</td>

    <td><b><center>Enroll</td>
   
  </tr>
  
     <?php
       
      
       
      // $query = "SELECT * FROM students ORDER BY id asc";
      // $result = mysqli_query($con, $query);

       $count = 1;
       while ($row = mysqli_fetch_assoc($res_data)) {
         $id = $row['id'];
         $fname = $row['fname'];
         $username = $row['lname'];

?>
     <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['fname']; ?></td>
       <td><?php echo $row['lname']; ?></td>

       <td><a href="enrollstudent.php?edit=<?php echo $row['id'];?>">Enroll This Student</a></td>
     </tr>
 

      <?php 
      $count++; //increment for table rows
      } ?>           

      </table>
    </div>
  </div>
    

</div>

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
<!-- Body ended  -->





</html>
