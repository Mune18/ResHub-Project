<?php 
   session_start();

   // Check if the user is already logged in
    if (isset($_SESSION['email'])) {
    // Redirect to home.php or any other page
    header("Location: home.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reg&loginstyles.css">
    <title>Login</title>
</head>
<body>
    <div class="llogo">
    <img src="images/logo.png" alt="Logo">
    </div>
      <div class="container">
        <div class="box form-box">
        <?php 
             
             include("sql/config.php");

              // Check if the login form is submitted
             if(isset($_POST['submit'])){
               $email = mysqli_real_escape_string($con,$_POST['email']);
               $password = mysqli_real_escape_string($con,$_POST['password']);

               // Query the database to check user credentials
               $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
               $row = mysqli_fetch_assoc($result);

               // If a user with matching credentials is found
               if(is_array($row) && !empty($row)){
                   $_SESSION['email'] = $row['Email'];
                   $_SESSION['username'] = $row['Username'];
                   $_SESSION['password'] = $row['Password'];
                   $_SESSION['id'] = $row['Id'];
               }else{
                    // Display an error message if credentials are incorrect
                   echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
                  echo "<a href='login.php'><button class='btn'>Go Back</button>";
        
               }
                // If user is logged in, redirect to home.php
               if(isset($_SESSION['email'])){
                   header("Location: home.php");
               }
             }else{

           
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>