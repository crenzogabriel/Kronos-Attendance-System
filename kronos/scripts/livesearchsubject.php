<?php

include('../connect.php');

if (!empty($_POST["input"])) {
    $input = $_POST["input"];

    $query = "SELECT subjects.id, subjects.subject_code, subjects.subject_name, faculty.lname 
    FROM subjects 
    INNER JOIN faculty ON faculty.id = subjects.facultyid
    WHERE subject_code LIKE '{$input}%' OR subject_name LIKE '{$input}%' OR lname LIKE '{$input}%'";
    
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){ ?>

            <table align="center" class="content-table">
            <tr>
                <tr style="background-color: #045de9; color: white">
                <td><b><center>Subject Code</td>
                <td><b><center>Subject Name</td>
                <td><b><center>Faculty Assigned To</td>
                <td><b><center>View Enrolled Students</td>
                <td><b><center>Delete</td>
            </tr>

    <?php
            while ($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
                $subject_code = $row['subject_code'];
                $subject_name = $row['subject_name'];
                $facultyid = $row['lname'];
      ?>
      
            <tr>
              <td><?php echo $row['subject_code']; ?></td>
              <td><?php echo $row['subject_name']; ?></td>
              <td><?php echo $row['lname']; ?></td>
              <td><a href="viewenrolled.php?edit=<?php echo $row['id'];?>">View</a></td>
              <td align='center'>
              <button class='delete btn btn-danger' id='del_<?= $id ?>' data-id='<?= $id ?>' >Delete</button>
              </td>
            </tr>
    
   
      <?php 
    
    } 
}
}
  
  ?>

<script src='../scripts/deletesubject.js.php'></script> 
</table>



        
        