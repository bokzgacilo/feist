<?php
  session_start();

  if(isset($_SESSION['name'])){
    header('location: search/');
  }else {

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FeIST - Sign In</title>
  <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
  <link rel="stylesheet" href="css/base.css">

</head>
<body>
  <style>
    @media only screen and (max-width: 415px) {
      .login {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100vw;
      }

      h6 {
        font-size: 20px;
        /* font-weight: bold; */
        font-family: Poppins-Bold;
      }

      .feist-icon {
        width: 50%;
        height: auto;
        margin: 4% 0 4% 0;
      }

      .form-container {
        width: 80%;
        margin-bottom: 10%;
      }

      .feist-primary {
        background-color: #007D32;
        color: white;
        padding: 10px 0 10px 0;
        outline: none;
        border: none;
        border-radius: 20px;
        transition: 0.5s;
      }

      .feist-primary:hover {
        background-color: #03a644;
      }

      input {
        font-size: 16px !important;
      }

    }
    @media only screen and (min-width: 415px) {
      .login {
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translate(-50%, 0);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 22%;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
      }

      label {
        font-size: 16px;
        font-weight: bold;
      }

      .feist-icon {
        width: 40%;
        height: auto;
        margin: 4% 0 4% 0;
      }

      .form-container {
        width: 80%;
        margin-bottom: 10%;
      }

      .feist-primary {
        background-color: #007D32;
        color: white;
        padding: 10px 0 10px 0;
        outline: none;
        border: none;
        border-radius: 20px;
        transition: 0.5s;
      }

      .feist-primary:hover {
        background-color: #03a644;
      }
    }

    

    
  </style>
  <main class="">
    <div class="login">
      <div class="text-center mt-4 mb-4">
        <img src="uploads/admin/feist-new.png" class="feist-icon" >
      </div>
      <div class="form-container">
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
          </div>
        <?php } ?>
        <form class='mb-4' action="login.php" method="post">
          <div class="mb-4">
            <h6>Username</h6>
            <input type="text" name='miscode' placeholder="Enter your username" class="form-control">
          </div>
          <div class="mb-4">
            <h6>Password</h6>
            <input type="password" name='mispass' placeholder="Enter your password" class="form-control">
          </div>
          
          <div class="mb-3 mt-4">
            <button type="submit" class="w-100 feist-primary">
              Login
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>

          <div class="mb-3 d-flex flex-column align-items-center">
            <a href="admin-login.php">
              Login as Admin
            </a>
          </div>
        </form>
      </div>
      </div>
    </div>
    
  </main>
</body>
</html>

<?php
}
?>