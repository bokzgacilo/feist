<?php
  include('../connection.php');

  $uid = $_POST['uid'];
  $room_level = $_POST['room_level'];
  $room_name = $_POST['room_name'];
  $roomID = $_POST['roomID'];

  $selectStudent = $conn -> query("SELECT * FROM new_students WHERE profileID=$uid");
  $student_name = '';

  while($row = $selectStudent -> fetch_array()){
    $student_name = $row['fullname'];
  }

  $update = "UPDATE new_students SET 
    roomID = $roomID,
    grade = '$room_level',
    section = '$room_name' WHERE profileID=$uid
  ";

  $updateStudent = $conn -> query($update);

  if($updateStudent){
    $selectRoom = $conn -> query("SELECT * FROM rooms WHERE room_id=$roomID");

    $room_member = '';

    while($row = $selectRoom -> fetch_array()){
      if($row['members'] == ''){
        $conn -> query("UPDATE rooms SET members='$student_name' WHERE room_id=$roomID");
      }else {
        $current_member = $row['members'];
        $updated_member = $current_member . '||' . $student_name;

        $conn -> query("UPDATE rooms SET members='$updated_member' WHERE room_id=$roomID");

        echo "$student_name was succesfully added to the room.";
      }
    }
    
  }

  $conn -> close();
?>