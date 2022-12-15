<?php
  include('../connection.php');
  $target = $_POST['room_id'];

  $sql = "SELECT * FROM new_students WHERE room_id='$target'";
  $result = $conn -> query($sql);

  while($row = $result -> fetch_array()){
    echo "
      <p>".$row['fullname']."</p>
    ";
  }

  $conn -> close();
?>