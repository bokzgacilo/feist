<?php
  include('../connection.php');

    function showStudents(){
      $conn = $GLOBALS['conn'];
      $getAllStudents =  $conn -> query("SELECT * FROM new_students");
      echo "        
      <tr class='table-header'>
        <th></th>
        <th class='selector'>
          <input type='checkbox' class='select-all'> 
        </th>
        <th></th>
        <th>Name</th>
        <th>Student Number</th>
        <th>Grade</th>
        <th>Section</th>
        <th>Room ID</th>
      </tr>";
      
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
        <tr>
          <td>
            <a class='edit-profile' href='../edit/index.php?uid=".$row['profileID']."'>
              Edit Profile
            </a>
          </td>
          <td class='selector'>
            <input type='checkbox' name='select[]' value='".$row['profileID']."'> 
          </td>
          <td class='avatar'>
            <img src='".$row['picture_url']."'>
          </td>
          <td class='name'>".$row['fullname']."</td>
          <td class='reference_number'>".$row['lrn']."</td>
          <td>".$row['grade']."</td>";
          if($row['section'] == 'Not set'){
            echo "
            <td>
              <a>".$row['section']."</a>
            </td>";
          }else {
            echo "
            <td>
              <a href='../section/index.php?room=".$row['section']."'>".$row['section']."</a>
            </td>
            ";
          }
        echo "
          <td>".$row['roomID']."</td>
        </tr>";
      }
    }

    $getAllFaculty = "SELECT * FROM new_teacher ORDER BY fullname ASC";
    $faculty = $conn -> query($getAllFaculty);

    function showFaculty(){
      echo "
      <tr class='table-header'>
        <th></th>
        <th class='selector'>
          <input type='checkbox' class='select-all' name='select[]'> 
        </th>
        <th></th>
        <th>Name</th>
        <th>Position</th>
        <th>Room ID</th>
      </tr>";
      while($row = $GLOBALS['faculty'] -> fetch_array()){
        echo "
        <tr>
        <td>
          <a class='edit-profile' href='../edit/index.php?uid=".$row['profileID']."'>
            Edit Profile
          </a>
        </td>
          <td class='selector'>
            <input type='checkbox' name='select' value='".$row['profileID']."'> 
          </td>
          <td class='avatar'>
            <img src='".$row['picture_url']."'>
          </td>
          <td class='name'>".$row['fullname']."</td>
          <td class='position'>".$row['position']."</td>
          <td class='position'>".$row['roomID']."</td>
        </tr>";
      }
    }


    function showRooms(){
      
      $getAllRooms = "SELECT * FROM rooms ORDER BY name ASC";
      $rooms = $GLOBALS['conn'] -> query($getAllRooms);

      echo "
      <tr class='table-header'>
        <th class='selector'>
          <input type='checkbox' value='' class='select-all' name='select[]' > 
        </th>
        <th>Room ID</th>
        <th>Section</th>
        <th>Level</th>
        <th>Adviser</th>
        <th>Students</th>
        <th></th>
      </tr>";
      while($row =  $rooms -> fetch_array()){
        $member = explode('||', $row['members']);
        $counter = count($member);
        echo "
        <tr>
          <td class='selector'>
            <input type='checkbox' name='select' value='".$row['name']."'> 
          </td>
          <td>".$row['room_id']."</td>
          <td>".$row['name']."</td>
          <td>".$row['level']."</td>
          <td>".$row['coordinator']."</td>
          <td>$counter</td>
          <td>
            <a href='../section/index.php?room=".$row['name']."'>View Room</a>
          </td>
        </tr>";
      }
    }
?>