<?php 
  session_start();
  include('../connection.php');

  $newPassword = $_POST['newPassword'];
  $target = $_POST['target'];

  $sql = "UPDATE new_teacher SET password='$newPassword' WHERE fullname='$target'";
  $result = $conn -> query($sql);

  if($result){
    echo 1;
  }

  $conn -> close();
?>