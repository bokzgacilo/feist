<?php
  header('Content-Type: application/json');
  include('../connection.php');
  
  $grade7 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 7'");
  $grade8 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 8'");
  $grade9 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 9'");
  $grade10 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 10'");
  $grade11 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 11'");
  $grade12 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 12'");

  $male = $conn -> query("SELECT * FROM profile WHERE gender='Male' AND profileID < 1000");
  $female = $conn -> query("SELECT * FROM profile WHERE gender='Female' AND profileID < 1000");
  $not_set = $conn -> query("SELECT * FROM profile WHERE gender='Not set' AND profileID < 1000");

  
  $data = array(
    "grade_7" => $grade7 -> num_rows,
    "grade_8" => $grade8 -> num_rows,
    "grade_9" => $grade9 -> num_rows,
    "grade_10" => $grade10 -> num_rows,
    "grade_11" => $grade11 -> num_rows,
    "grade_12" => $grade12 -> num_rows,
    "male" => $male -> num_rows,
    "female" => $female -> num_rows,
    "not_set" => $not_set -> num_rows,
  );


  echo json_encode($data);

  $conn -> close();
?>