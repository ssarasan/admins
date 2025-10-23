<?php
include('../connect.php');
session_start();
$error = $success = '';
// Simple captcha
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = rand(10000, 99999);
}
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $captcha = $_POST['captcha'];
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters!';
    } elseif ($captcha != $_SESSION['captcha']) {
        $error = 'Invalid captcha!';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, 'user', 1)");
        $stmt->bind_param('sss', $username, $email, $hash);
        if ($stmt->execute()) {
            $success = 'Registration successful! You can now <a href=\'login.php\'>login</a>.';
            unset($_SESSION['captcha']);
        } else {
            $error = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    }
    $_SESSION['captcha'] = rand(10000, 99999);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/colors.css" />
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="js/semantic.min.css" />
</head>
<body class="inner_page login">
<div class="full_container">
    <div class="container">
        <div class="center verticle_center full_height">
            <div class="login_section">
                <div class="logo_login">
                    <div class="center">
                        <img width="210" src="images/logo/logo.png" alt="#" />
                    </div>
                </div>
                <div class="login_form">
                    <h3>User Registration</h3>
                    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                    <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
                    <form action="register.php" method="post" autocomplete="off">
                        <fieldset>
                            <div class="field">
                                <label class="label_field">Username</label>
                                <input type="text" name="username" class="form-control" required />
                            </div>
                            <div class="field">
                                <label class="label_field">Email</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>
                            <div class="field">
                                <label class="label_field">Password</label>
                                <input type="password" name="password" class="form-control" minlength="6" required />
                            </div>
                            <div class="field">
                                <label class="label_field">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" minlength="6" required />
                            </div>
                            <div class="field">
                                <label class="label_field">Captcha: <b><?php echo $_SESSION['captcha']; ?></b></label>
                                <input type="text" name="captcha" class="form-control" required />
                            </div>
                            <div class="field margin_0">
                                <input class="main_bt" type="submit" value="Register" name="register">
                            </div>
                            <div class="field mt-2">
                                <a href="login.php" class="btn btn-link">Back to Login</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/perfect-scrollbar.min.js"></script>
<script>
   var ps = new PerfectScrollbar('#sidebar');
</script>
<script src="js/custom.js"></script>
</body>
</html>
