<?php
  session_start();
  include('../connection.php');
  include('count_queries.php');

  if(isset($_SESSION['name'])){
    $show = '';

    if(isset($_GET['show'])){
      $show = $_GET['show'];
    }else {
      // $show = 'all';
    }

    $user_name = $_SESSION['name'];

    $area = ['admin', 'new_teacher'];
    $getUserInfo = '';
    $table = '';
  
    foreach ($area as $key) {
      $searchTable = $conn -> query("SELECT * FROM {$key} WHERE fullname='$user_name'");

      if(($searchTable -> num_rows) > 0){
        $table = $key;
      }
    }

    $user_picture_url = '';
    $user_position = '';
    $user_isAdviser = '';
    $user_room_id = '';

    $getUserInfo = $conn -> query("SELECT * FROM {$table} WHERE fullname='$user_name'");

    while($user = $getUserInfo -> fetch_array()){
      $user_picture_url = $user['picture_url'];
      $user_role = $user['role'];

      if($table == 'new_teacher'){
        $user_position = $user['position'];
        $user_isAdviser = $user['isAdviser'];
        $user_room_id = $user['roomID'];
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FeIST - Search</title>
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="search.css">
  <script src="../js/jquery.js"></script>
  <script src="search.js"></script>
</head>
<body>
  <div id='usermod' class="mod">
    <div class="mod-content">
      <div class="mod-header">
        <p>Data Sheet</p>
        <i title='close' class="close-mod fa-solid fa-x"></i>
      </div>
      <div class="mod-body">
        
      </div>
    </div>
  </div>

  <div id='account' class="side">
    <div class="side-content">
      <div class="side-header">
        <p ><?php echo $user_name; ?></p>
        <i title='close' class="close-mod fa-solid fa-x"></i>
      </div>
      <div class="side-body">
        <img src='<?php echo $user_picture_url;?>'>
        <div class="side-action">
          <?php
            if($user_role == 'Admin'){
              echo "
              <a href='../admin/'>
                Go to Admin
              </a>";
            }

            if($user_isAdviser == 1){
              $room_name = $conn -> query("SELECT * FROM rooms WHERE room_id='$user_room_id'");
              $advisory = '';
              while($r2 = $room_name -> fetch_array()){
                $advisory = $r2['name'];
              } 

              echo "
              <a href='../section/index.php?room=$advisory  '>
                My Advisory
              </a>";
            }
          ?>
          <!-- <a>
            Change Display Picture
          </a> -->
          <a href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <header>
    <div class="brand">
      <img src='../uploads/admin/feist-new.png'>
    </div>
    <form class='search-form'>
      <div class="search-input">
        <i class="fa-solid fa-magnifying-glass me-2"></i>
        <input type="search" name='keyword' placeholder="Start Searching">
      </div>
    </form>
    <div class="right">
      <div class="account" title='<?php echo $user_name; ?>'>
        <img src='<?php echo $user_picture_url; ?>'>
      </div>
    </div>
  </header>
  <nav>
    <a class="nav-item" id='<?php echo $user_name; ?>' onclick="getAllMyStudent(this.id)">My Students</a>
    <!-- <a class="nav-item" href='../search/' id="all">All Students</a>
    <a class="nav-item" href='index.php?show=students' id="students">Students</a> -->
    <!-- <a class="nav-item" href='index.php?show=teachers' id="teachers">Teachers</a> -->
    <!-- <a class="nav-item" href='index.php?show=rooms' id="rooms">Rooms</a> -->
  </nav>
  <main class="result-container">
    <div class="left-container">
      <div class="filter-list">
        <h5 class="mt-4 mb-4">Filter By:</h5>
        <button class="accordion">
          Grade (Students)
        </button>
          <div class="panel">
            <p class="panel-item-grade" title='Not set'>Not Assigned <span><?php echo $not_assigned ?></span></p>
            <p class="panel-item-grade" title='Grade 7'>Grade 7 <span><?php echo $grade7count; ?></span></p>
            <p class="panel-item-grade" title='Grade 8'>Grade 8 <span><?php echo $grade8count; ?></span></span></p>
            <p class="panel-item-grade" title='Grade 9'>Grade 9 <span><?php echo $grade9count; ?></span></span></p>
            <p class="panel-item-grade" title='Grade 10'>Grade 10 <span><?php echo $grade10count; ?></span></span></p>
            <p class="panel-item-grade" title='Grade 11'>Grade 11 <span><?php echo $grade11count; ?></span></span></p>
            <p class="panel-item-grade" title='Grade 12'>Grade 12 <span><?php echo $grade12count; ?></span></span></p>
          </div>
        <button class="accordion">
          Position (Teachers)
        </button>
          <div class="panel">
            <p class="panel-item-position" title='Teacher I'>Teacher I <span><?php echo $teacherIcount; ?></span></p>
            <p class="panel-item-position" title='Teacher II'>Teacher II <span><?php echo $teacherIIcount; ?></span></p>
            <p class="panel-item-position" title='Teacher III'>Teacher III <span><?php echo $teacherIIIcount; ?></span></p>
            <p class="panel-item-position" title='Teacher IV'>Teacher IV <span><?php echo $teacherIVcount; ?></span></p>
          </div>
      </div>
      <!-- <hr>
      <h5>Sort By:</h5>
      <div class="sort-list">
        <a href="">Alphabetical A-Z</a>
        <a href="">Alphabetical Z-A</a>
      </div> -->
    </div>

    <div class="right-container">

    </div>
  </main>
  <footer>

  </footer>
  
  <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "flex") {
          panel.style.display = "none";
        } else {
          panel.style.display = "flex";
        }
      });
    }
  </script>
  <script>
    $(document).ready(function(){
      var getShow = '<?php echo $show; ?>';
      console.log(getShow)

      if(getShow == 'rooms'){
        $.ajax({
        type: 'post',
        url: 'getRooms.php',
        data: {
          show: getShow
        },
        success: function(response){
          
          $('.right-container').html(response)
        }
      })
      }else {
        $.ajax({
          type: 'post',
          url: 'get.php',
          data: {
            show: getShow
          },
          success: function(response){
            $('.right-container').html(response)
            
          }
        })
      }
      
    })
  </script>
</body>
</html>

<?php
  }else {
    header('location: ../');
    // echo 'not set';
  }
?>