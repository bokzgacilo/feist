<?php
  include('../connection.php');

  $show = $_POST['show'];

  $sql = '';
  $counter = '';

  switch($show){
    case 'all':
        $tables = ['new_students', 'new_teacher'];
    
        foreach ($tables as $table) {
          $find = "SELECT * FROM {$table} ORDER BY fullname ASC";
          $result = $conn -> query($find);
    
          if(($result -> num_rows) > 0){
            if($table == 'new_students'){
              while($row = $result -> fetch_array()){
                echo "<div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
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
      break;
    case 'students':
      $sql = "SELECT * FROM new_students ORDER BY fullname ASC";
      $result = $conn -> query($sql);
    
      if(($result -> num_rows) > 0){
        while($row = $result -> fetch_array()){
          echo "
          <div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
            <img src='".$row['picture_url']."'>
            <p>".$row['fullname']."</p>
            <p>".$row['lrn']."</p>
            <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
          </div>";
        }
      }
      break;
    case 'teachers':
      $sql = "SELECT * FROM new_teacher ORDER BY fullname ASC";
      $result = $conn -> query($sql);
    
      if(($result -> num_rows) > 0){
        while($row = $result -> fetch_array()){
          echo "
          <div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
            <img src='".$row['picture_url']."'>
            <p>".$row['fullname']."</p>
            <p>".$row['position']."</p>
            <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
          </div>";
        }
      }
      break;
  }

  $conn -> close();
?>