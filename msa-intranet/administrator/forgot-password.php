<?php
include('../connect.php');
$error = $success = '';
if (isset($_POST['forgot'])) {
    $email = trim($_POST['email']);
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        // In production, generate a token, store it, and email a reset link
        $success = 'If this email exists, a reset link will be sent.';
    } else {
        $success = 'If this email exists, a reset link will be sent.';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body class="inner_page login">
<div class="full_container">
    <div class="container">
        <div class="center verticle_center full_height">
            <div class="login_section">
                <div class="login_form">
                    <h3>Forgot Password</h3>
                    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                    <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
                    <form action="forgot-password.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <button type="submit" name="forgot" class="btn btn-primary">Send Reset Link</button>
                        <a href="login.php" class="btn btn-link">Back to Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
