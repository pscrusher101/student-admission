<?php
session_start();
$_SESSION['message'] = '';

$mysqli = new mysqli('localhost','root','','accounts');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['password'] == $_POST['confirmpassword']) {

      $username = $mysqli->real_escape_string($_POST['username']);
      $email = $mysqli->real_escape_string($_POST['email']);
      $password = md5($_POST['password']);//hash
      $boardschool = $mysqli->real_escape_string($_POST['boardschool']);
      $college = $mysqli->real_escape_string($_POST['college']);
      $edob = $_REQUEST['byear']."/".$_REQUEST['bmonth']."/".$_REQUEST['bday'];
      $egender=$_POST["egender"];
      $mobilenumber=$_POST['mobilenumber'];
      /*$sql = "INSERT INTO users (username, email, password,boardschool, college, edob) VALUES ( '{$mysqli->real_escape_string($_POST['username'])}','{$mysqli->real_escape_string($_POST['email'])}','{$mysqli->real_escape_string($_POST['password'])}', '{$mysqli->real_escape_string($_POST['boardschool'])}', '{$mysqli->real_escape_string($_POST['college'])}','{$mysqli->real_escape_string($_POST['sdob'])}')";*/
          $avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);
          /*$insert = $mysqli->query($sql);*/
      
          
          

      if (preg_match("!image!", $_FILES['avatar']['type'])) {

        if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {

            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = $avatar_path;

            $sql = "INSERT INTO USERS (username, email, password, boardschool, college, edob, egender, mobilenumber, avatar) "
                    . "VALUES ('$username','$email','$password','$boardschool','$college','$edob','$egender','$mobilenumber','$avatar_path')";
                    //if everything works fine..go to welcome.php page

         if ($mysqli->query($sql) === true) {

              $_SESSION['message'] = "registration successful! added $username to the database! $mobilenumber";

              header("location:welcome.php");  
         }
         else {

            $_SESSION['message'] = "user could not be added to database";
         }

        }
        else{

            $_SESSION['message'] = "FILE UPLOAD FAILED";
        }
      }
      else{

          $_SESSION['message'] = "please upload file type of png,jpg or gif images";
      }
  }
  else{

         $_SESSION['message'] = "two passwords do not match";
  }
}
?>
<!--  <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="form.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form class="form" action="form.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?=$_SESSION['message'] ?></div>
      <input type="text" placeholder="User Name" name="username" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="confirmpassword" name="confirmpassword" autocomplete="new-password" required />
      <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div> -->