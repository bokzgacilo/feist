<?php
  include('../connection.php');

  $name = $_POST['name'];
  mkdir("../files/" . $name);

  $student_number = $_POST['stud_number'];
  $profileID = rand(001,999);

  $sql = "INSERT INTO new_students (fullname, lrn, profileID) VALUES ('$name', '$student_number', $profileID)";
  $result = $conn -> query($sql);

  if($result){
    header('location: index.php?success=Record added');
    $createProfile = $conn -> query("INSERT INTO profile (profileID) VALUES ($profileID)");

    $new_log = "Student [ " . $name . " ] has been added to the database by " .$_SESSION['name']. ".";
    $conn -> query("INSERT INTO logs (message, date) VALUES ('$new_log', NOW())");
  }
  
  $conn -> close();
?>