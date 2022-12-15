<?php
  include('../connection.php');

  $keyword = $_POST['keyword'];
  $getTable = $_POST['show'];

  $keyword = preg_replace("/<!--.*?-->/", "", $keyword);
  $keyword = isset($keyword) ? trim($keyword) : false;

  
  if(!empty($keyword)){
    if($getTable == ''){

      $tables = ['new_students', 'new_teacher'];

      foreach ($tables as $table) {
        $find = "SELECT * FROM {$table} WHERE fullname LIKE '%$keyword%' ORDER BY fullname ASC";
        $result = $conn -> query($find);

        if(($result -> num_rows) > 0){
          if($table == 'new_students'){
            while($row = $result -> fetch_array()){
              echo "<div class='result ".$row['grade']."' id=".$row['profileID']." onclick='openItem(this.id)'>
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

    }

    switch($getTable){
      case 'students':
        $sql = "SELECT * FROM new_students WHERE fullname LIKE '%$keyword%'ORDER BY fullname ASC";
        $result = $conn -> query($sql);
      
        if(($result -> num_rows) > 0){
          while($row = $result -> fetch_array()){
            echo "<div class='result'>
              <img src='".$row['picture_url']."'>
              <p>".$row['fullname']."</p>
              <p>".$row['lrn']."</p>
              <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
            </div>";
          }
        }
        break;
      case 'teachers':
        $sql = "SELECT * FROM new_teacher WHERE fullname LIKE '%$keyword%' ORDER BY fullname ASC";
        $result = $conn -> query($sql);
      
        if(($result -> num_rows) > 0){
          while($row = $result -> fetch_array()){
            echo "<div class='result'>
              <img src='".$row['picture_url']."'>
              <p>".$row['fullname']."</p>
              <p>".$row['position']."</p>
              <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
            </div>";
          }
        }
        break;
    }
  }

  // $tables = ['new_students', 'new_teacher'];
  
  $conn -> close();
?>