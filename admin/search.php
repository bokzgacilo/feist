<?php
  include('../connection.php');

  $keyword = $_POST['keyword'];
  $table = $_POST['table'];
  $sql = '';

  if($table == 'students'){
    $sql = "SELECT * FROM new_students WHERE fullname LIKE '%$keyword%'";
  }else {
    $sql = "SELECT * FROM new_teacher WHERE fullname LIKE '%$keyword%'";
  }

  $result = $conn -> query($sql);

  if($table == 'students'){
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
      
      while($row = $result -> fetch_array()){
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

  $conn -> close();
?>