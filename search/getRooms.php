<?php
  include('../connection.php');

  $sql = "SELECT * FROM rooms";
  $result = $conn -> query($sql);

  echo "<div class='room-container'>";
    while($row = $result -> fetch_array()){
      $members = explode('||', $row['members']);
      $countmember = count($members);

      echo "<a class='custom-card' href='../section/index.php?room=".$row['name']."'>
        <p>".$row['level'].", ".$row['name']."</p>
        <p>Students: $countmember</p>
      </a>";



      // echo "
      //   <div class='custom-card' href='../section/index.php?room=".$row['name'].">
      //     <p>".$row['name']."</p>
      //   </a>
      // ";
    }
  echo "</div>";
  $conn -> close();
?>