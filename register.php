<?php
require_once "config.php";

$username = $password = $confirm_password = $gmail = "";
$username_err = $password_err = $confirm_password_err = $gmail_err = "";
$success_message = ""; // Variable to store the success message

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST['username']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }

        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Passwords do not match";
        }
    }

    // Validate Gmail
    if (empty(trim($_POST['gmail']))) {
        $gmail_err = "Please enter your Gmail";
    } else {
        $gmail = trim($_POST['gmail']);
        // Add validation rules for the Gmail field if necessary
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($gmail_err)) {
        $sql = "INSERT INTO users (username, password, gmail) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_gmail);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_gmail = $gmail;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit;
            } else {
                echo "Something went wrong... cannot redirect!";
            }

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "You have been successfully registered!"; // Assign the success message
                header("location: index.php");
                exit;
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
          <!--  -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <p>Please fill in your credentials to create an account.</p>
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($gmail_err)) ? 'has-error' : ''; ?>">
            <label>Gmail</label>
            <input type="email" name="gmail" class="form-control" value="<?php echo $gmail; ?>">
            <span class="help-block"><?php echo $gmail_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Register">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-Skyl8Pm9f1e5gXn0KXYxs1zkHuy6dLh7a8RI2+E2hy/Sc7g4VBGFh8z9R6Fy"
        crossorigin="anonymous"></script>
</body>
</html>
