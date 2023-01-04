<?php
  session_start();

  if(!isset($_SESSION['role'])){
    header('location: ../search/');
  }else {
    require('queries.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - FeIST</title>
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="style.css">
  <script defer src="../js/jquery.js"></script>
  <script defer src="script.js"></script>
</head>
<body>
  <div id="importModal" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Import Excel File</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">
        <form enctype="multipart/form-data" action='import.php' method='post' class="import-form">
          <div class="target">
            <p>
              Select where to import:
            </p>
            <p>
              <input type="radio" value="Students" name='targetTable'>
              <label>Students</label>
            </p>
            <p>
              <input type="radio" value="Faculty" name='targetTable'>
              <label>Faculty</label>
            </p>
          </div>
          <input type="file" name="excel_file">
          <button class="btn btn-primary mt-3" name='submit'>Import</button>
        </form>
      </div>
    </div>
  </div>

  <div id="pictureModal" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Change Display Picture</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">

      </div>
    </div>
  </div>

  <div id="single-student" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Create Single Data (Student)</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">
        <form action='add-single-student.php' method='post'>
          <input required class='form-control' type='text' name='name' placeholder='Fullname (Lastname, Firstname)'>
          <input required class='form-control mt-2' type='number' name='stud_number' placeholder='Student Number'>
          <div class="mt-2">
            <button class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="single-teacher" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Create Single Data (Teacher)</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">
        <form action='add-single-teacher.php' method='post'>
          <input required class='form-control mb-2' type='text' name='name' placeholder='Fullname (Lastname, Firstname)'>
          <select required class="form-control" name="position">
            <option value="">Select Position</option>
            <option>Teacher I</option>
            <option>Teacher II</option>
            <option>Teacher III</option>
            <option>Teacher IV</option>
          </select>
          <div class="mt-2">
            <button class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="change-password" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Change Password</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">
        <form id='changePasswordForm'>
          <input type='text' id='new-password' name='newPassword' class='form form-control' placeholder='<?php ?>' value="<?php echo "asdasd"; ?>" required>
          <div class="mt-2">
            <button class="btn btn-primary">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="createRoomModal" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p>Create Room</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body">
        <form enctype="multipart/form-data" action='create-room.php' method='post' class="import-form">
          <div class="mt-2 mb-3">
            <input required type="text" class='form-control' name='section' placeholder="Enter Section name">
          </div>
          <div class="mb-3 ">
            <select required name='grade_level' class="form-select">
              <option value="Grade 7">Grade 7</option>
              <option value="Grade 8">Grade 8</option>
              <option value="Grade 9">Grade 9</option>
              <option value="Grade 10">Grade 10</option>
              <option value="Grade 11">Grade 11</option>
              <option value="Grade 12">Grade 12</option>
            </select>
          </div>
          <div class="mb-3 ">
            <div class="form-control search-coord">
              <div class="ss-top">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                <input required placeholder='Assign Adviser' name='coord'>
              </div>
              <div class="advisers">
              </div>
            </div>
          </div>
          <button class="btn btn-primary mb-3">Create Room</button>
        </form>
      </div>
    </div>
  </div>

  <div id="viewStudents" class="import-modal">
    <div class="import-modal-content">
      <div class="import-modal-header">
        <p class="room-name">Room Name</p>
        <i class="fa-solid fa-xmark close"></i>
      </div>
      <div class="import-modal-body all-students">
      </div>
    </div>
  </div>

  <!-- Content -->
  <main>
    <aside>
      <!-- <img src='../uploads/admin/feist-new.png'> -->
      <div class="sidebar">
        <h4 class="mb-3">Menu</h4>
        <a href='../search/'>
          <i class="fa-solid fa-magnifying-glass me-2"></i>
          <span>Search</span>
        </a>
        <a href='index.php?table=students'>
          <i class="fa-solid fa-eye me-2"></i>
          <span>View Students</span>
        </a>
        <a href='index.php?table=faculty'>
          <i class="fa-solid fa-eye me-2"></i>
          <span>View Faculty</span>
        </a>
        <a href='index.php?table=rooms'>
          <i class="fa-solid fa-eye me-2"></i>
          <span>View Rooms</span>
        </a>
        <a class="singe-data-button-student">
          <i class="fa-solid fa-user-plus me-2"></i>
          <span>Add Single Data (Student)</span>
        </a>

        <a class="singe-data-button-teacher">
          <i class="fa-solid fa-user-plus me-2"></i>
          <span>Add Single Data (Teacher)</span>
        </a>
        <a href='Feist-Import-Student-Template.xlsx' download>
          <i class="fa-solid fa-user-plus me-2"></i>
          <span>Download Excel Template (xlxs)</span>
        </a>
        <a class="import-button">
          <i class="fa-solid fa-file-excel me-2"></i>
          <span>Batch add using Excel (xlsx)</span>
        </a>
        <a class="create-room">
          <i class=" fa-solid fa-house me-2"></i>
          <span>Create Room</span>
        </a>
        <a class='logs-and-report' href="logreports.php">
          <i class="fa-solid fa-square-question me-2"></i>
          <span>Log and Reports</span>
        </a>
        <a href="../logout.php">
          <i class="fa-solid fa-right-from-bracket me-2"></i>
          <span>Signout</span>
        </a>
      </div>
    </aside>
    <div class="main-table">
      <?php
        if(!isset($_GET['table'])){
          showStudents();
        }else {
          switch($_GET['table']){
            case 'students':
              showStudents();
              break;
            case 'faculty':
              showFaculty();
              break;
            case 'rooms':
              showRooms();
              break;
            default:
          }
        }
      ?>
    </div>
  </main>
</body>
</html>
<?php
  }
?>