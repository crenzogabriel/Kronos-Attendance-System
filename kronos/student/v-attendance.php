<?php include("studentnav.php"); ?>
<?php
ob_start();
session_start();

if($_SESSION['name'] != 'oasis') {
  header('location: ../index.php');
}
?>

<?php
// Establishing connection
include('../connect.php');

// Get the ID of the logged-in user
$loggedInUserID = $_SESSION['identity'];

// SQL query to select the attendance records of the logged-in user
$selectQuery = "SELECT * FROM attendancetable WHERE studentid = '$loggedInUserID' ORDER BY attendanceDate ASC";

$result = mysqli_query($con, $selectQuery);
?>

<?php
$query = "SELECT status, COUNT(*) as count FROM attendancetable WHERE studentid = '$loggedInUserID' GROUP BY status";
$results = mysqli_query($con, $query);
$data = [];
while ($row = mysqli_fetch_assoc($results)) {
    $data[] = [$row["status"], (int)$row["count"]];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Attendance | KRONOS</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="chart.css">
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> 
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
  <link rel="stylesheet" href="../admin/views.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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

  <!-- Centered chart code starts here -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id="donutchart"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Status');
    data.addColumn('number', 'Count');
    data.addRows(<?php echo json_encode($data); ?>);

    var options = {
      title: 'Your Attendance',
      titleTextStyle: {
        fontSize: 50,
        fontName: "Poppins",
        italic: false,
        bold: true,
        color: '#0069d9'
      },
      pieHole: 0.5, // Set the inner radius for the donut shape
      slices: {
        0: {color: '#FF6B6B'},
        1: {color: '#FFD93D'},
        2: {color: '#4D96FF'}
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }
</script>

<!-- Centered chart code ends here -->

  <center>
    
   
    <table align="center" class="content-table" style = "top: 0">
      <tr>
        <tr style="background-color: #045de9; color: white">
         
          <td><b><center>Subject</td>
          <td><b><center>Date</td>
          <td><b><center>Status</td>
        </tr>


        <?php
        
        while ($row = mysqli_fetch_assoc($result)) {
          
          $subject = $row['subject'];
          $attendanceDate = $row['attendanceDate'];
          $status = $row['status'];
        ?>
          <tr>
            
            
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['attendanceDate']; ?></td>
            <td><?php echo $row['status']; ?></td>
          </tr>
        <?php 
        }
        ?>
    </table>
  

  </center>

</body>
</html>