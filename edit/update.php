<?php
  session_start();

  include('../connection.php');
  

  $uid = $_GET['uid'];
  $tables = ['new_students', 'new_teacher'];
  $target_table = '';
  $profile_picture_url = '';
  $fullname = '';
  
  foreach ($tables as $table) {
    $check = $conn -> query("SELECT * FROM {$table} WHERE profileID=$uid");

    if(($check -> num_rows) > 0){
      $target_table = $table;

      while($row = $check -> fetch_array()){
        $fullname = $row['fullname'];
      }
    }
  }
  
  // Image Upload
  if (is_uploaded_file($_FILES ['image_upload'] ['tmp_name'])) {
    $picture_url = '';

    $extension  = pathinfo( $_FILES["image_upload"]["name"], PATHINFO_EXTENSION );
    $temp_name = $_FILES['image_upload']['tmp_name'];
    $basename = $fullname . "." . $extension;

    $picture_url = "../files/$fullname/" . $basename;
    $destination  = "../files/$fullname/{$basename}";

    move_uploaded_file($temp_name, $destination);

    $update = "UPDATE {$target_table} SET picture_url='$picture_url' WHERE profileID=$uid";
    $conn -> query($update);
  }

  // File Upload
  $target_dir = "../files/$fullname/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $uploadOk = 1;

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars(basename( $_FILES["fileToUpload"]["name"])). " has been uploaded. <br>";
  } else {
    // echo "Sorry, there was an error uploading your file.";
  }

  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $religion = $_POST['religion'];
  $date_of_birth = $_POST['date_of_birth'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $guardian = $_POST['guardian'];
  $guardian_contact = $_POST['guardian_contact'];
  $minority = $_POST['minority'];
  $pwd = 'No';
  if(isset($_POST['pwd'])){
    $pwd = 'Yes';
  }else {
    $pwd = 'No';
  }

  $tables = ['new_students', 'new_teacher'];

  $sql = "SElECT * FROM profile WHERE profileID=$uid";
  $result = $conn -> query($sql);

  if(($result -> num_rows) > 0){
    $query = "UPDATE profile SET 
      gender='$gender',
      age=$age,
      religion='$religion',
      date_of_birth='$date_of_birth',
      address='$address',
      contact='$contact',
      guardian='$guardian',
      guardian_contact='$guardian_contact',
      minority='$minority',
      is_pwd='$pwd'
    WHERE profileID=$uid";
    $update = $conn -> query($query);

    if($update){
      echo 'Profile Updated' . '<br>';
      $new_log = "Student [ " . $fullname . " ] has been updated by " .$_SESSION['name']. ".";
      $conn -> query("INSERT INTO logs (message, date) VALUES ('$new_log', NOW())");
    }
  }

  echo "<a href=\"javascript:history.go(-2)\">Done</a>";

  $conn -> close();
?>