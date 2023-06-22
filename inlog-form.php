
<?php

include 'db.php';

$errors = [
    'email' => "",
    'password' => ""
];

if(isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $password_hash = password_verify($password,PASSWORD_DEFAULT);
    $statment = $conn-> prepare("SELECT * FROM users WHERE email= :email");
    if ($statment) {
        $statment->execute([
            ':email' => $_POST['email']
        ]);
        
        $result = $statment->fetch(PDO::FETCH_ASSOC);
        $correct_password = password_verify($password, $result['password']);
        
        if ($correct_password) {
            header('location: list.php');
            exit();
        } else {
            $errors['email'] = "wrong email or password";
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
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <div class="main">
        <i class="fa-regular fa-circle-check"></i>
        <h1>Sign in</h1>
        <div class="main-log-in">
            <form action="inlog-form.php" method="post">
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" required>
                <h3 class="error"><?php echo $errors['email']; ?></h3>
                <button type="submit" name="submit">Sign in</button>
                <br>
                <a href="forget-password.php">Forgot your password?</a>
                <br>
                <br>
                <a href="register-form.php">Don't have an account? Click here!</a>
                <br>
            </form>
        </div>
    </div>
</body>
</html>
