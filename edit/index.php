<?php
  session_start();
  
  include('../connection.php');
  $uid = $_GET['uid'];

  $tables = ['new_students', 'new_teacher'];
  $target = '';

  $fullname = '';
  $lrn = '';
  $grade = '';
  $section = '';
  $picture_url = '';
  $position = '';
  $roomID = '';

  foreach ($tables as $table) {
    $sql = "SELECT * FROM {$table} WHERE profileID=$uid";
    $result = $conn -> query($sql);

    if(($result -> num_rows) > 0){
      $target = $table;

      while($basic = $result -> fetch_array()){
        if($table == 'new_students'){
          $fullname = $basic['fullname'];
          $lrn = $basic['lrn'];
          $grade = $basic['grade'];
          $section = $basic['section'];
          $picture_url = $basic['picture_url'];
        }

        if($table == 'new_teacher'){
          $fullname = $basic['fullname'];
          $position = $basic['position'];
          $picture_url = $basic['picture_url'];
          if($basic['roomID'] != 0){
            // echo $roomID = 'Adviser';
            $selectRoom = $conn -> query("SELECT * FROM rooms WHERE room_id='".$basic['roomID']."'");

            while($room = $selectRoom -> fetch_array()){
              $section = $room['name'];
            }

            // echo $section;
          }else {
            echo $roomID = 'Not Adviser';
          }
        }
      }
    }
  }

  $get = "SELECT * FROM $target WHERE profileID=$uid";
  $data = $conn -> query($get);

  while($row = $data -> fetch_array()){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['fullname']; ?></title>

  <link rel="stylesheet" href='../css/base.css'>
  <link rel="stylesheet" href='style.css'>
  <script src="../js/jquery.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <div class="details container d-flex flex-column justify-content-center">
    <form class="section-holder" action='update.php?uid=<?php echo $uid; ?>' method="POST" enctype='multipart/form-data'>
      <section class="1">
        <div class="section-data">
          <div class="basic-info">
            <p><?php echo $fullname; ?></p>
            <p><?php echo $position; ?></p>
            <p><?php echo $roomID; ?></p>
            <p><?php echo $lrn; ?></p>
            <p><?php echo $grade; ?></p>
            <a href='../section/index.php?room=<?php echo $section; ?>'><?php echo $section; ?></a>
          </div>
          <img class='profile-image' src='<?php echo $picture_url;?>'>
          <input type="file" id="image_upload" value="" name='image_upload' style="display:none" accept="image/*"/>
        </div>
      </section>
      <hr>
      <section class="2">
        <h5>Personal Information</h5>
        <div class="section-data-personal">
          <?php
            $personal = "SELECT * FROM profile WHERE profileID=$uid";
            $perResult = $conn -> query($personal);

            while($personalData = $perResult -> fetch_array()){
          ?>
          <div class="row">
            <div class="col-5">
              <p class="mb-2">Gender:</p>
              <p class="mb-2">Age:</p>
              <p class="mb-2">Religion:</p>
              <p class="mb-2">Date of Birth:</p>
              <p class="mb-2">Address:</p>
              <p class="mb-2">Contact:</p>
            </div>
            <div class="col-7">
              <select class="mb-1 form-control form-control-sm" name='gender'>
                <option><?php echo $personalData['gender']; ?></option>
                <option>Male</option>
                <option>Female</option>
              </select>
              <input class="mb-1 form-control form-control-sm" type='text' name='age' value="<?php echo $personalData['age']; ?>">
              <input class="mb-1 form-control form-control-sm" type='text' name='religion' value="<?php echo $personalData['religion']; ?>">
              <input class="mb-1 form-control form-control-sm" type='date' name='date_of_birth' value="<?php echo date('Y-m-d', strtotime($personalData['date_of_birth'])); ?>">
              <input class="mb-1 form-control form-control-sm" type='text' name='address' value="<?php echo $personalData['address']; ?>">
              <input class="mb-1 form-control form-control-sm" type='text' name='contact' value="<?php echo $personalData['contact']; ?>">
              

            </div>
          </div>
          <div class="emergency row mt-4">
            <span>Emergency Contact:</span>
            <input class="mb-1 form-control form-control-sm" type='text' name='guardian' value="<?php echo $personalData['guardian']; ?>">
            <input class="mb-1 form-control form-control-sm" type='text' name='guardian_contact' value="<?php echo $personalData['guardian_contact']; ?>">
          </div>
          <div class="emergency row mt-4">
            <span>Minority: (Please specify, leave blank if not.)</span>
            <select class="form-select" name='minority' aria-label="Default select example">
              <option>Not</option>
              <option>Mangyan</option>
              <option>Igorot</option>
              <option>Badjao</option>
              <option>Bangon</option>
            </select>
          </div>
          <div class="emergency row mt-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name='pwd' value="" id="flexCheckChecked" <?php
                if($personalData['is_pwd'] != 'No'){
                  echo 'checked';
                }
              ?>>
              <label class="form-check-label" for="flexCheckChecked">
                Is PWD (Uncheck if not)
              </label>
            </div>
          </div>
          <?php
            
          ?>
          
          <?php
            }
          ?>
        </div>
      </section>
      <hr>
      <section class="3">
        <h5>School and Academic Files</h5>
        <div class="file-list">
        <div>
          <label class="mb-2">Upload File: </label>
          <input name="fileToUpload" type="file" class="form-control form-control-sm mb-2">
        </div>
        <?php
            if ($handle = opendir('../files/' . $fullname)) {
              while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                  echo "
                  <div class='card mb-2'>
                    <div class='card-body'>
                      <a class='' href='../files/$fullname/$entry'>
                        $entry
                      </a>
                    </div>
                  </div>"
                  ;
                }
              }
              closedir($handle);
          }
          ?>
        </div>
      </section>
      <section class="4">
        <button class='btn btn-primary' type='submit'>Update</button>
      </section>
    </form> 
  </div>
</body>
</html>

<?php
  }
  $conn -> close();
?>