<?php

include 'db.php';
$successful = [
    'email' => "",
    'password' => ""
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
            $successful['email'] = "register is successfully";
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
    <title>Sign here up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <i class="fa-regular fa-circle-check"></i>
        <h1>Sign Up</h1>
            <div class="main-log-in">
                <form action="register-form.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <h3 class="success"><?php echo $successful['email']; ?></h3>
                    <button type="submit" name="submit">Sign up</button>
                    <br>
                    <a href="inlog-form.php">Do you already have an account? Click here!</a>
                    <br>
                </form>
            </div>
    </div>

</body>
</html>


