<?php
  session_start();
  include('../connection.php');
  $sql = "";

  if($_SESSION['role'] == 'Admin'){
  $sql = "SELECT * FROM new_teacher WHERE fullname='".$_SESSION['name']."'";

  }else {
    $sql = "SELECT * FROM new_teacher WHERE fullname='".$_SESSION['name']."'";

  }


  $result = $conn -> query($sql);

  if($result -> num_rows == 0 ){
    echo "This teacher is not assigned to any rooms";
  }else {

    $roomID = '';

    while($row = $result -> fetch_array()){
      $roomID = $row['roomID'];
    }

    $selectRoom = $conn -> query("SELECT * FROM rooms WHERE room_id='$roomID'");
    $members = '';

    while($row = $selectRoom -> fetch_array()){
      $members = $row['members'];
    }
    
    $members = explode("||", $members);

    for($i = 0; $i < count($members); $i++){
      $selectStudent = $conn -> query("SELECT * FROM new_students WHERE fullname='$members[$i]'");
      // echo ;
      while($row = $selectStudent -> fetch_array()){
        echo "<div class='result' ".$row['grade']."' id=".$row['profileID']." onclick='openItem(this.id)'>
          <img src='".$row['picture_url']."'>
          <p>".$row['fullname']."</p>
          <p>".$row['lrn']."</p>
          <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
        </div>";
      }
    }
  }

  $conn -> close();
?>