<?php

include 'db.php';

$successful = [
    'email' => ""
];

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    /*error handlers*/
    if (empty($email) || empty($password)) {
        header("location: register-form.php?error=emptyfild");
        exit();
    } else {
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();
        $password_hash = password_hash($password,PASSWORD_DEFAULT); /*bescherm password in database*/
        /*insert user in database*/
        $sql = "INSERT INTO users(email, password) VALUES (:email, :password) ";
        if ($conn->prepare($sql)->execute(['email' => $email, 'password' => $password_hash])) {
            $successful['email'] = "reset password is successfully";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <div class="main">
        <i class="fa-regular fa-circle-check"></i>
        <h1>Forget Password </h1>
        <div class="main-log-in">
            <form action="" method="POST">
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="New Password" name="password" required>
                
                <button type="submit" class="btnSubmit" name="submit" value="Reset Password">Reset Password</button><br>
                <h3 class="success"><?php echo $successful['email']; ?></h3>
                <a href="inlog-form.php">New login? Click here!</a>
                <br>
                <br>
                <a href="register-form.php">Don't have an account? Click here!</a>
                <br>
            </form>
		</div>
	</div>
</div>
</body>
</html>
