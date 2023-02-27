<?php
  include('../connection.php');
  
  $minority = $conn -> query("SELECT * FROM profile WHERE minority!='Not' AND profileID < 1000");
  $pwd = $conn -> query("SELECT * FROM profile WHERE is_pwd!='No' AND profileID < 1000");
  $all = $conn -> query("SELECT * FROM new_students");
  
  echo "
    <p>Number of All Student this year: ".$all -> num_rows."</p>
    <p>Number of Minorities: ".$minority -> num_rows."</p>
    <p>Number of PWDs: ".$pwd -> num_rows."</p>
  ";

  $conn -> close();
?>