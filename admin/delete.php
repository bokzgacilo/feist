<?php
  include('../connection.php');
  $record = $_POST['records'];
  $table = $_POST['table'];

  // print_r($record);
  // echo $record . ' , ' . $table;
  if($table == 'students'){
    foreach ($record as $key) {
      $delete = "DELETE FROM new_students WHERE profileID=$key";
      $conn -> query($delete);

      if($conn -> query("DELETE FROM profile WHERE profileID=$key")){
        echo 'Profile successfully deleted';
      }
    } 
  }

  if($table == 'faculty'){
    foreach ($record as $key) {
      $delete = "DELETE FROM new_students WHERE profileID=$key";
      $conn -> query($delete);

      if($conn -> query("DELETE FROM profile WHERE profileID=$key")){
        echo 'Profile successfully deleted';
      }
    } 
  }

  $conn -> close();
?>