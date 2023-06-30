<?php

include('../connect.php');

if (!empty($_POST["input"])) {
    $input = $_POST["input"];

    $query = "SELECT * FROM students WHERE id LIKE '{$input}%' OR fname LIKE '{$input}%' OR lname LIKE '{$input}%' OR email LIKE '{$input}%' OR phone LIKE '{$input}%'";
    
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){ 

?>

            <table align="center" class="content-table">
            <tr>
               <tr style="background-color: #045de9; color: white">
                <td><b><center>Student ID</td>
                <td><b><center>First Name</td>
                <td><b><center>Last Name</td>
                <td><b><center>Enroll</td>
            </tr>

    <?php
            while ($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
         $fname = $row['fname'];
         $username = $row['lname'];
      ?>
      
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['fname']; ?></td>
              <td><?php echo $row['lname']; ?></td>
              <td><a href="enrollstudent.php?edit=<?php echo $row['id'];?>">Enroll This Student</a></td>
              </td>
            </tr>
    
   
      <?php 
    
    } 
}
}
?>


<script src='../scripts/deletestudent.js.php'></script>   

</table>



        
        