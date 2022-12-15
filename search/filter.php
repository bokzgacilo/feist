<?php
  include('../connection.php');

  if(isset($_POST['grade'])){
    $grade = $_POST['grade'];

    $sql = "SELECT * FROM new_students WHERE grade='$grade'";
    $result = $conn -> query($sql);
  
    if(($result -> num_rows) > 0){
      while($row = $result -> fetch_array()){
        echo "<div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
          <img src='".$row['picture_url']."'>
          <p>".$row['fullname']."</p>
          <p>".$row['lrn']."</p>
          <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
        </div>";
      }
    }else {
      echo "<p>No results found.</p>";
    }
  }

  if(isset($_POST['position'])){
    $position = $_POST['position'];

    $sql = "SELECT * FROM new_teacher WHERE position='$position'";
    $result = $conn -> query($sql);
  
    if(($result -> num_rows) > 0){
      while($row = $result -> fetch_array()){
        echo "<div class='result' id=".$row['profileID']." onclick='openItem(this.id)'>
          <img src='".$row['picture_url']."'>
          <p>".$row['fullname']."</p>
          <p>".$row['position']."</p>
          <a class='seemore' id=".$row['profileID']." onclick='openItem(this.id)'>See More</a>
        </div>";
      }
    }else {
      echo "<p>No results found.</p>";
    }
  }

  $conn -> close();
?>