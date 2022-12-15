<?php
  include('../connection.php');
  $keyword = $_POST['keyword'];

  $sql = "SELECT * FROM new_teacher WHERE fullname LIKE '%$keyword%' AND roomID=0";
  $result = $conn -> query($sql);


  if($keyword != ''){
    if(($result -> num_rows) > 0){
      while($row = $result -> fetch_array()){
        echo "
          <p>".$row['fullname']." <span onclick='setCoord(this.title)' title='".$row['fullname']."'>Select</span><p/>
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