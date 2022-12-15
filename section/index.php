<?php
  include('../connection.php');

  $room_name = $_GET['room'];
  $room_level = '';
  $room_ID = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $room_name; ?></title>
  <link rel="stylesheet" href='../css/base.css'>
  <link rel="stylesheet" href='style.css'>
  <script src="../js/jquery.js"></script>
  <script src="script.js"></script>
</head>
<body>
  <style>
    
  </style>
  <div id='add-member' class="custom-modal">
    <div class="custom-modal-content">
      <div class="custom-modal-header">
        <h5>Add member</h5>
        <i class="close fa-solid fa-x"></i>
      </div>
      <div class="custom-modal-body">
        <input type="text" class="form-control" value="" placeholder="Search student.." id='search_student'>
        <div class="search-result"></div>
        <!-- <button class="btn btn-primary">Add Student</button> -->
      </div>
    </div>
  </div>
  <div class="room">
    <section>
      <?php
        $sql = "SELECT * FROM rooms WHERE name='$room_name'";
        $result = $conn -> query($sql);

        $adviser = '';
        $member_list = '';

        while($row = $result -> fetch_array()){
          $adviser = $row['coordinator'];
          $member_list = $row['members'];
          $room_level = $row['level'];
          $room_ID = $row['room_id'];
        }
      ?>
      <h4 class="header"><?php echo $room_level . ' - ' . $room_name; ?></h4>
      <div class="adviser">
        <?php
          $getAdviserPicture = "SELECT * FROM new_teacher WHERE fullname='$adviser'";
          $getResultAdviser = $conn -> query($getAdviserPicture);
          $adviser_picture_url = '';

          while($row = $getResultAdviser -> fetch_array()){
            $adviser_picture_url = $row['picture_url'];
          }

          $member_list_array = explode('||', $member_list);
          $member_count = count($member_list_array);

        ?>
        <p>Adviser: </p>
        <img src='<?php echo $adviser_picture_url; ?>'>
        <h5><?php echo $adviser; ?></h5>
      </div>
      <div class="member-sect">
        <a class="btn btn-primary mb-2 add-member">
          Add member
        </a>
        <h5>Members: <?php echo $member_count; ?>/40</h5>
        <div class="member-list">
          <?php
            
            foreach ($member_list_array as $member) {
              $getMemberPicture = $conn -> query("SELECT * FROM new_students WHERE fullname='$member'");
              
              while($row = $getMemberPicture -> fetch_array()){
                echo "<a href='../details/index.php?uid=".$row['profileID']."' class='member'>
                  <img src='".$row['picture_url']."'>
                  <h6>".$row['fullname']."</h6>
                </a>";
              }
            }
          ?>
        </div>
      </div>
      
    </section>
  </div>
  <script>
    function addStudent(id){
      $.ajax({
        type: 'post',
        url: 'addstudent.php',
        data: {
          uid : id,
          room_level : '<?php echo $room_level;?>',
          room_name : '<?php echo $room_name;?>',
          roomID : <?php echo $room_ID;?>
        },
        success: function(response){
          alert(response);
          window.location.reload();
        }
      })
    }
  </script>
</body>
</html>

<?php
  $conn -> close();
?>