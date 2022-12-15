<?php
  include('../connection.php');

  $name = $_POST['name'];
  $position = $_POST['position'];

  mkdir("../files/" . $name);

  $profileID = rand(0001,9999);

  // $name_data = implode(',', $name);
  $username = 'teacher-' . $profileID;
  $password = 'feist';  

  $sql = "INSERT INTO new_teacher (username, password, fullname, position, profileID) VALUES ('$username', '$password', '$name', '$position', $profileID)";
  $result = $conn -> query($sql);

  if($result){
    header('location: index.php?success=Record added');
    $conn -> query("INSERT INTO profile (profileID) VALUES ($profileID)");
  }
  
  $conn -> close();
?>