<?php
  include('../connection.php');

  $section = $_POST['section'];
  $level = $_POST['grade_level'];
  $coordinator = $_POST['coord'];
  $room_id = rand(100, 1000);

  if($section != '' || $level != '' || $coordinator != ''){
    $conn -> query("UPDATE new_teacher SET roomID='$room_id' WHERE fullname='$coordinator'");

    $sql = "INSERT INTO rooms(room_id, name, level, coordinator) VALUES 
    (
      $room_id,
      '$section',
      '$level',
      '$coordinator'
    )";

    $conn -> query($sql);
  }

  echo "Room created. <a href='../admin/'>Back to dashboard</a>";
  $conn -> close();
?>