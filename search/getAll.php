<?php
  include('../connection.php');

  $tables = ['new_students', 'new_teacher'];

  foreach ($tables as $table) {
    $find = "SELECT * FROM {$table} ORDER BY fullname ASC";
    $result = $conn -> query($find);

    if(($result -> num_rows) > 0){
      if($table == 'new_students'){
        while($row = $result -> fetch_array()){
          echo "<div class='result' ".$row['grade']."' id=".$row['profileID']." onclick='openItem(this.id)'>
            <img src='".$row['picture_url']."'>
            <p>".$row['fullname']."</p>
            <p>".$row['lrn']."</p>
            <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
          </div>";
        }
      }
      
      if($table == 'new_teacher'){
        while($row = $result -> fetch_array()){
          echo "<div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
            <img src='".$row['picture_url']."'>
            <p>".$row['fullname']."</p>
            <p>".$row['position']."</p>
            <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
          </div>";
        }
      }
    }
  }

  $conn -> close();
?>