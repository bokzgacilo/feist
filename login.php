<?php 
  session_start();

  include('connection.php');

  if(isset($_POST['miscode']) && isset($_POST['mispass'])){
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $username = validate($_POST['miscode']);
    $password = validate($_POST['mispass']);

    if(empty($username)){
      header("Location: index.php?error=Teacher Code is required");
      exit();
    }else if(empty($password)){
      header("Location: index.php?error=Password is required");
      exit();
    }else {
      $sql = "SELECT * FROM new_teacher WHERE username='$username' AND password='$password'";
      $result = $conn -> query($sql);

      if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        if($row['username'] === $username && $row['password'] === $password){
          $_SESSION['name'] = $row['fullname'];
          // $_SESSION['role'] = $row['role'];  

          header("Location: search/");
          exit();
        }else {
          header("Location: index.php?error=Incorrect login credential");
          exit();
        }
      }else {
        header("Location: index.php?error=Incorrect login credential");
        exit();
      }
    }
  }else{
    echo 'sdfasd';
    header("Location: index.php");
  }

  $conn->close();
?> 