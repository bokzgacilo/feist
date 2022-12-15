<?php
  include('../connection.php');
  
  $keyword = $_POST['keyword'];
  
  $sql = "SELECT * FROM new_students WHERE fullname LIKE '%$keyword%' AND roomID=0";
  $result = $conn -> query($sql);

  if(($result -> num_rows) > 0){
    while($row = $result -> fetch_array()){
      echo "<a class='student'>
        <p>".$row['fullname']."</p>
        <button id='".$row['profileID']."' onclick='addStudent(this.id)'>Add</button>
      </a>";
      
    }
  }else {
    echo 'No result found.';
  }



  $conn -> close();
?>