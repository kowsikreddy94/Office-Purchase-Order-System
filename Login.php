<?php
session_start();

$ser='localhost';
$user = 'kxt2384_admin';
$passw = 'Admin@94';
$dbname = 'kxt2384_db';

// initializing variables for register
$username=$password=$loginrole="";
$errors = array(); 

// connect to the database
$db = mysqli_connect($ser, $user, $passw , $dbname);

// ... login

if (isset($_POST['loginclick'])) {
  $username = $_POST['usrnm'];
  $password = $_POST['psw'];
  $loginrole = $_POST['usertype1'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	// $password = md5($password);
  	$query = "SELECT * FROM phase4_user WHERE email='$username' AND password='$password' AND usertype='$loginrole'";

    $results = mysqli_query($db, $query);

  	if (mysqli_num_rows($results) == 1) {
      //fetch name
      $user_name_fetch = "SELECT * FROM phase4_user WHERE EMAIL = '$username';";
      $result = mysqli_query($db, $user_name_fetch);
      $user = mysqli_fetch_assoc($result);
      $_SESSION['nametodisplay'] = $user['name'];
      $_SESSION['userid'] = $user['userid'];
  	  $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";

      if($loginrole == 'Student')
      {
        //   header("location: student.php");
          header("Location: Student.php");
      }
      else if($loginrole == 'Staff')
      {
          header("Location: Staff.php");
      }
      else if($loginrole == 'Manager')
      {
          header("Location: PurchaseManager.php");
      }      
      else if($loginrole == 'Admin')
      {
          header("Location: ITadmin.php");
      }

  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}        
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script type = "text/javascript" src = "jsvalidations.js"></script>
    <link rel="stylesheet" href="phase2.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="grid-container">

        <div class="header item1">
            <div class="alignleft">
                <h2>Office Purchase Order <br> System (OPO)</h2>
                <pre><h3 style="display:inline;">+1(234)-567-89-00</h3>  <h4 style="display:inline;">Available 24/7</h4></pre>
                
            </div>
            
    
            <div class="alignright">
                <a href="Login.php"><button type="submit">Login</button></a>
                <a href="https://www.instagram.com/" target="_blank"><img src="instagram.png" alt="facebook" ></a>
                <a href="https://www.youtube.com/" target="_blank"><img src="youtube.png" alt="facebook"></a>                
                <a href="https://www.facebook.com/" target="_blank"><img src="facebook-circular-logo.png" alt="facebook"></a>                    
            </div>       
        </div>
    
        <div class="homepagelinks item2">  
            <ul>
                <li><a href="Homepage.php">Homepage</a></li>
                <li><a href="AboutUs.php">About Us</a></li>
                <li><a href="http://kxt2384.uta.cloud/blog/wordpress/">Forum</a></li>
                <li><a href="ContactUs.php">Contact Us</a></li>
            </ul>
        </div>
        
        <div class="maindiv item3">
            <form name="loginForm" action="Login.php" method="post">
              <div class="lpcontainer">
                <div class="lpimgcontainer">
                  <!-- <img src="loginavatar.PNG" alt="Avatar" class="avatar"> -->
                  <!-- <i class="fas fa-users icon"></i> -->
                  <i class="fa fa-users fa-5x icon" aria-hidden="true"></i>
                </div>
                    <div>
                        <i class="fa fa-user icon"></i>
                        <input class="input-field" type="text" placeholder="Username" name="usrnm">
                    </div>

                    <div>
                        <i class="fas fa-unlock-alt icon"></i>
                        <input class="input-field" type="password" placeholder="Password" name="psw">
                    </div>

                    <div class="custom-select">
                        <i class="fas fa-users icon"></i>
                        <select name="usertype1" class="input-field">
                        <!-- <option value="" disabled selected hidden>User type</option> -->
                        <option value="Student">Student</option>
                        <option value="Staff">Staff</option>
                        <option value="Manager">Manager</option>
                        <option value="Admin">IT Admin</option>
                        </select>
                    </div>

                    <a class="lplinks" href="#" target="_blank">Forgot password</a><br>
                    <button name="loginclick" type="submit" >Login</button><br>
                    <?php include('phperrors.php'); ?></div>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                    <br>
                    <div>
                        <a href="Register.php" target="_blank"> Dont have an account? Register here</a>    <br>
                    </div>
            </form>
          </div>





          
    
        <div class="footer item6">
            <div id="footerpart1">
                <h2>UTA OPO<br> System </h2>
                <h3>1225 W Mitchell St <br>Arlington Tx</h3>
            </div>
            <div id="footerpart2">
                <ul>
                    <li><a href="Homepage.php">Homepage</a></li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="http://kxt2384.uta.cloud/blog/wordpress/">Forum</a></li>
                    <li><a href="ContactUs.php">Contact Us</a></li>
                </ul>
            </div>
            <div id="footerpart3">
                <p>Follow Us</p>
                <div>
                    <a href="https://www.facebook.com/" target="_blank"><img src="facebook-circular-logo.png" alt="facebook" style="width: 10%;"></a>
                    <a href="https://www.youtube.com/" target="_blank"><img src="youtube.png" alt="facebook" style="width: 10%;"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="instagram.png" alt="facebook" style="width: 10%;"></a>    
                </div> 
            </div>
            <div id="footerpart4">
                <a href="Login.php"><button type="submit">Login</button></a>
            </div>
        </div>
    
    
    </div>
    
</body>
</html>