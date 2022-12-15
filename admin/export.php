<?php
  session_start();
  include('../connection.php');

  $report = $_POST['reports'];
  $sql = '';
  $filename = '';
  $timestamp = date('Ymd') . '-' . date('Hi');

  // echo $report;

  switch($report){
    case 0:
      break;
    case 1:
      $filename = "List of Student - Feist Exported(".$timestamp.").xls";
      echo "
      <table>
        <thead>
          <tr>
            <th></th>
            <th>LRN</th>
            <th>Student Fullname</th>
            <th>Grade</th>
            <th>Section</th>
          </tr>
        </thead>
        <tbody>";
        $no = 1;
        $sql = "SELECT * FROM new_students";     
        $advresult = $conn -> query($sql);
        while ($row = $advresult -> fetch_assoc()) {
        echo "
        <tr>
          <td>$no</td>
          <td>".$row['lrn']."</td>
          <td>".$row['fullname']."</td>
          <td>".$row['grade']."</td>
          <td>".$row['section']."</td>
          </tr>"; 
          $no++;
        }
        echo "</tbody>
      </table>";
      break;
    case 2:
      $filename = "List of Teachers - Feist Exported(".$timestamp.").xls";
      echo "
      <table>
        <thead>
          <tr>
            <th></th>
            <th>Teacher Fullname</th>
            <th>Position</th>
            <th>Room ID</th>
          </tr>
        </thead>
        <tbody>";
        $no = 1;
        $sql = "SELECT * FROM new_teacher";     
        $advresult = $conn -> query($sql);
        while ($row = $advresult -> fetch_assoc()) {
        echo "
        <tr>
          <td>$no</td>
          <td>".$row['fullname']."</td>
          <td>".$row['position']."</td>
          <td>".$row['roomID']."</td>
        </tr>"; 
        $no++;
        }
        echo "</tbody>
      </table>";
      break;
    case 3:
      $filename = "List of Rooms - Feist Exported(".$timestamp.").xls";
      echo "
      <table>
        <thead>
          <tr>
            <th></th>
            <th>Room ID</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Adviser</th>
            <th>Number of Students</th>
          </tr>
        </thead>
        <tbody>";
        $no = 1;
        $sql = "SELECT * FROM rooms";     
        $advresult = $conn -> query($sql);
        while ($row = $advresult -> fetch_assoc()) {
          $members = explode('||', $row['members']);
          $count_members = count($members);


        echo "
        <tr>
          <td>$no</td>
          <td>".$row['room_id']."</td>
          <td>".$row['level']."</td>
          <td>".$row['name']."</td>
          <td>".$row['coordinator']."</td>
          <td>$count_members</td>
        </tr>"; 
        $no++;
        }
        echo "</tbody>
      </table>";
      break;
  }

  header('Content-type: application/vnd-ms-excel');
  header("Content-Disposition:attachment;filename=\"$filename\"");

  $conn -> close();
?>