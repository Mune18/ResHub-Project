<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reg&loginstyles.css">
    <title>Register</title>
</head>
<body>
<div class="llogo">
    <img src="images/logo.png" alt="Logo">
    </div>
      <div class="container">
        <div class="box form-box">

        <?php 
          // Include the database configuration file
         include("sql/config.php");

          // Check if the registration form is submitted
         if(isset($_POST['submit'])){
            // Get user input from the form
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

         //verifying the unique email
         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

          // If email is not unique, show an error message
         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{
            // If email is unique, insert user data into the database
            mysqli_query($con,"INSERT INTO users(Username,Email,Password) VALUES('$username','$email','$password')") or die("Erroe Occured");

             // Show success message
            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <!-- Registration form -->
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>