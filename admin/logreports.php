<?php
  session_start();

  include('../connection.php');

  $getLogs = $conn -> query("SELECT * FROM logs");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../css/base.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logs and Reporting</title>

  <script src="../js/jquery.js"></script>
</head>
<body>
  <div class="container">
    <form id='report' class="mb-4 mt-4" action="export.php" method="post">
      <h4 class="mb-2">Export Report: </h4>
      <div>
        <select class="form-control mb-2" name="reports">
          <option value="0">Select what to export</option>
          <option value="1">List of Student</option>
          <option value="2">List of Teacher</option>
          <option value="3">List of Rooms</option>
        </select>
        <button class="btn btn-primary" name="submit">Export</button>
      </div>
    </form>
    <hr>
    <div>
      <h4 class="mb-2">Logs:</h4>
      <div class="logs-list">
        <?php
          while($row = $getLogs -> fetch_array()){
            echo "<div class='card mb-2'>
            <div class='card-body'>
              $row[0]. ".$row['message']." - ".$row['date']."
            </div>
          </div>";
          }
        ?>
      </div>
    </div>
    
  </div>
</body>
</html>

<?php
?>