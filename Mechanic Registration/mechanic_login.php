<?php
$error = array(); // Initialize error array

@include 'mechconfig.php';

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM mechanics WHERE email = '$email' AND password = '$pass'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      // User authentication successful
      session_start();
      $_SESSION['email'] = $email;
      header('Location: success.php');
      exit();
   } else {
      $error[] = 'Invalid email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom CSS file link  -->
   <link rel="stylesheet" href="css/styling.css">

</head>

<body>

   <div class="form-container">

      <form action="" method="post">
         <h3>Login</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
         }
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="Login" class="form-btn">
         <p>Don't have an account? <a href="mechanic_reg.php">Register now</a></p>
      </form>

   </div>

</body>

</html>