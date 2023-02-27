<?php
  include('../connection.php');

    function showStudents(){
      $conn = $GLOBALS['conn'];
      $getAllStudents =  $conn -> query("SELECT * FROM new_students");
      
      $count = $getAllStudents -> num_rows;

      echo "
      <h4 class='mb-2 mt-2'>Students <span style='font-size: 12px;'>($count results found.)</span></h4>
      <div class='div-table-header'>
        <p class='col'>Actions</p>
        <p class='col'>Picture</p>
        <p class='col-3'>Name</p>
        <p class='col' style='font-size: 12px;'>Student number</p>
        <p class='col'>Grade</p>
        <p class='col'>Section</p>
        <p class='col'>Room ID</p>
      </div>
      <div class='table-content'>
      ";

      while($row = $getAllStudents -> fetch_array()){
        $room = $row['roomID'];
        $section = '';
        $sectionName = $conn -> query("SELECT name FROM rooms WHERE room_id='$room'");
        
        while($x = $sectionName -> fetch_array()){
          $section = $x['name'];
        }

        if($room == '0'){
          $room = 'Not set';
        }
        echo "
          <div class='div-table-content'>
            <div class='col div-table-content-action'>
              <a class='me-1' href='../edit/index.php?uid=".$row['profileID']."'>
                <i title='Edit' class='fa-solid fa-user-pen'></i>
              </a>
              <span class='delete-button' id='".$row['profileID']."'>
                <i title='Delete' class='fa-solid fa-trash'></i>
              </span>
            </div>
            <div class='col'>
              <img class='avatar' src='".$row['picture_url']."'>
            </div>
            <p class='col-3'>".$row['fullname']."</p>
            <p class='col'>".$row['lrn']."</p>
            <p class='col password-label'>
              ".$row['grade']."
            </p>";
            if($row['section'] == 'Not set'){
              echo " <a  class='col'>".$row['section']."</a> ";
            }else {
              echo " <a class='col' href='../section/index.php?room=".$row['section']."'>".$row['section']."</a> ";
            }
            echo "<p class='col'>".$row['roomID']."</p>
          </div>";
      }

      echo "</div>";
    }

    

    function showFaculty(){
      $conn = $GLOBALS['conn'];
      $getAllFaculty = "SELECT * FROM new_teacher ORDER BY fullname ASC";
      $faculty = $conn -> query($getAllFaculty);

      $count = $faculty -> num_rows;

      echo "
      <h4 class='mb-2 mt-2'>Faculty <span style='font-size: 12px;'>($count results found.)</span></h4>
      <div class='div-table-header'>
        <p class='col'>Actions</p>
        <p class='col-1'>Picture</p>
        <p class='col-3'>Name</p>
        <p class='col-2'>Username</p>
        <p class='col-2'>Password</p>
        <p class='col'>Position</p>
        <p class='col'>Room ID</p>
      </div>
      <div class='table-content'>
      ";

      while($row = $faculty -> fetch_array()){
        echo "
          <div class='div-table-content' title='".$row['fullname']."'>
            <div class='col div-table-content-action'>
              <a class='me-1' href='../edit/index.php?uid=".$row['profileID']."'>
                <i title='Edit' class='fa-solid fa-user-pen'></i>
              </a>
              <span class='delete-button me-1' id='".$row['profileID']."'>
                <i title='Delete' class='fa-solid fa-trash'></i>
              </span>
              <span class='change-password-button' id='".$row['password']."'>
                <i title='Change Password' class='fa-solid fa-key'></i>
              </span>
            </div>
            <div class='col-1'>
              <img class='avatar' src='".$row['picture_url']."'>
            </div>
            <p class='col-3'>".$row['fullname']."</p>
            <p class='col-2'>".$row['username']."</p>
            <p class='col-2 password-label'>
              ".$row['password']."
          
            </p>
            <p class='col'>".$row['position']."</p>
            <p class='col'>".$row['roomID']."</p>
          </div>
        ";
      }

      echo "</div>";
    }


    function showRooms(){
      $getAllRooms = "SELECT * FROM rooms ORDER BY name ASC";
      $rooms = $GLOBALS['conn'] -> query($getAllRooms);

      $count = $rooms -> num_rows;

      echo "
      <h4 class='mb-2 mt-2'>Room <span style='font-size: 12px;'>($count results found.)</span></h4>
      <div class='div-table-header'>
        <p class='col'>Action</p>
        <p class='col'>Room ID</p>
        <p class='col'>Section</p>
        <p class='col'>Grade</p>
        <p class='col-3'>Adviser</p>
        <p class='col'>Students</p>
      </div>
      <div class='table-content'>
      ";

      while($row =  $rooms -> fetch_array()){
        $member = explode('||', $row['members']);
        $counter = count($member);

        echo "
          <div class='div-table-content'>
            <div class='col div-table-content-action'>
              <a class='me-1 view-room' href='../section/index.php?room=".$row['name']."'>
                <i title='View Room' class='fa-solid fa-user-pen'></i>
              </a>
              <a class='me-1 view-room' id='".$row['room_id']."' onclick='levelUp(this.id)'>
              <i class='fa-solid fa-up'></i>
              </a>
            </div>
            <p class='col'>".$row['room_id']."</p>
            <p class='col'>".$row['name']."</p>
            <p class='col'>".$row['level']."</p>
            <p class='col-3'>".$row['coordinator']."</p>
            <p class='col'>$counter</p>
          </div>
        ";
      }

      echo "</div>";
    }
?>