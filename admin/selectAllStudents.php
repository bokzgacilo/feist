<?php
  include('../connection.php');
  $keyword = $_POST['keyword'];

  $sql = "SELECT * FROM new_student WHERE name LIKE '%$keyword%' AND room_id='0'";
  $result = $conn -> query($sql);


  if($keyword != ''){
    if(($result -> num_rows) > 0){
      while($row = $result -> fetch_array()){
        echo "
          <p>".$row['fullname']." <span onclick='addStudents(this.title)' title='".$row['fullname']."'>Select</span><p/>
        ";
      }  
    }else {
      echo "
        <p class='form-labe'>No results found for {$keyword}</p>
      ";
    }
  }


  $conn -> close();
?>