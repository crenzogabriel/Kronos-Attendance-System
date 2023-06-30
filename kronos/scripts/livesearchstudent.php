<?php

include('../connect.php');

if (!empty($_POST["input"])) {
    $input = $_POST["input"];

    $query = "SELECT * FROM students WHERE id LIKE '{$input}%' OR fname LIKE '{$input}%' OR lname LIKE '{$input}%' OR username LIKE '{$input}%' OR email LIKE '{$input}%' OR phone LIKE '{$input}%'";
    
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){ ?>

            <table align="center" class="content-table">
            <tr>
                <tr style="background-color: #045de9; color: white">
                <td><b><center>Student ID</td>
                <td><b><center>First Name</td>
                <td><b><center>Last Name</td>
                <td><b><center>Username</td>
                <td><b><center>Email Address</td>
                <td><b><center>Phone Number</td>
                <td><b><center>Edit</td>
                <td><b><center>Delete</td>
            </tr>

    <?php
            while ($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $username = $row['username'];
                $email = $row['email'];
                $phone = $row['phone'];
      ?>
      
            <tr>
              <td><?php echo $id; ?></td>
              <td><?php echo $fname; ?></td>
              <td><?php echo $lname; ?></td>
              <td><?php echo $username; ?></td>
              <td><?php echo $email; ?></td>
              <td><?php echo $phone; ?></td>
              <td><a href="editstudent.php?edit=<?php echo $row['id'];?>">Edit</a></td>
              <td align='center'>
              <button class='delete btn btn-danger' id='del_<?= $id ?>' data-id='<?= $id ?>' >Delete</button>
              </td>
            </tr>
    
   
      <?php 
    
    } 
}
}
  
  ?>


<script src='../scripts/deletestudent.js.php'></script>   

</table>



        
        