<?php
  include('../connection.php');

  $roomID = $_POST['roomid'];

  $sql = "SELECT * FROM rooms WHERE room_id='$roomID'";
  $result = $conn -> query($sql);

  $roomLevel = '';
  $members = '';

  while($row = $result -> fetch_array()){
    $roomLevel = $row['level'];
    $members = $row['members'];
  }

  $membersArray = explode("||", $members);

  print_r($membersArray);
  

  $roomLevel = explode(' ', $roomLevel);
  $newLevel = '';
  print_r($roomLevel);
  if($roomLevel[1] == 12){
    $newLevel = 7;
  }else {
    $newLevel = $roomLevel[1] + 1;
  }

  $newGradeLevel = "Grade $newLevel";

  foreach ($membersArray as $key) {
    $conn -> query("UPDATE new_students SET grade='$newGradeLevel' WHERE fullname='$key'");
  }

  $conn -> query("UPDATE rooms SET level='$newGradeLevel' WHERE room_id='$roomID'");
  $conn -> close();
?>