<?php
  include('../connection.php');

  $profile_id = $_POST['profileID'];

  $getBasicInfo = $conn -> query("SELECT * FROM new_students WHERE profileID=$profile_id");
  $getProfileInfo = $conn -> query("SELECT * FROM profile WHERE profileID=$profile_id");
  
  $fullname = '';
  $lrn = '';
  $grade = '';
  $section = '';
  $picture_url = '';

  $gender = '';
  $age = '';
  $date_of_birth = '';
  $address = '';
  $contact = '';
  $guardian = '';
  $guardian_contact = '';

  while($basicInfo = $getBasicInfo -> fetch_array()){
    $fullname = $basicInfo['fullname'];
    $lrn = $basicInfo['lrn'];
    $grade = $basicInfo['grade'];
    $section = $basicInfo['section'];
    $picture_url = $basicInfo['picture_url'];
  }

  while($profileInfo = $getProfileInfo -> fetch_array()){
    $gender = $profileInfo['gender'];
    $age = $profileInfo['age'];
    $date_of_birth = $profileInfo['date_of_birth'];
    $address =  $profileInfo['address'];
    $contact = $profileInfo['contact'];
    $guardian =  $profileInfo['guardian'];
    $guardian_contact = $profileInfo['guardian_contact'];
  }

  echo "
    <div class='data-sheet'>
      <div class='data-sheet-basic'>
        <img src='../".$picture_url."'>
        <p>$fullname</p>
        <p>$lrn</p>
        <p>$grade, $section</p>
      </div>
      <div class='data-sheet-profile'>
        <p>Gender: $gender</p>
        <p>Age: $age</p>
        <p>Birthdate: $date_of_birth</p>
        <p>Address: $address</p>
        <p>Contact Number: $contact</p>
        <p>Guardian's Name: $guardian</p>
        <p>Guardian's Contact: $guardian_contact</p>

        <div class='data-sheet-action'>
          <a href=''>Edit</a>
          <a href=''>View Section</a>
        </div>
      </div>
    </div>
  ";

  $conn -> close();
?>