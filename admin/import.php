<?php
  require_once '../vendor/autoload.php';
  include('../connection.php');

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Reader\Csv;
  use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

  if (isset($_POST['submit'])) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {
    
      $arr_file = explode('.', $_FILES['excel_file']['name']);
      $extension = end($arr_file);
    
      if('csv' == $extension) {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
      } else {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }

      $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
      $sheetData = $spreadsheet -> getActiveSheet() -> toArray();
        
      if (!empty($sheetData)) {
        for ($i = 1; $i < count($sheetData); $i++) {
          $name = $sheetData[$i][0];  
          $lrn = $sheetData[$i][1];

          $profileID = rand(001,999);

          $checkDatabase = "SELECT * FROM new_students WHERE fullname='$name'";
          $validation = $conn -> query($checkDatabase);

          if($row = $validation -> fetch_array()){
            echo $name . ' was already existing. <br>';
          }else {
            $sql = "INSERT INTO new_students (fullname, lrn, profileID) VALUES('$name', '$lrn', $profileID)";

            if ($conn ->  query($sql)) {
              $createProfile = $conn -> query("INSERT INTO profile (profileID) VALUES ($profileID)");
              mkdir("../files/" . $name);
              echo $name . ' was added. <br>';
            }
          }
        }
        echo "<a href='index.php'>Back to dashboard</a>";
      }
    }else {
      echo "Invalid file format, please try again <a href='index.php'>Back</a>";
    }
  }
?>