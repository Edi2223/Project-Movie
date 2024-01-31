<?php
require_once '../models/db.php'; // Include your DB class
require_once '../models/user.php'; // Include your User class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a DB instance
    $db = new DB();

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create a User instance
    $user = new User(null, $email, $password, '', $db);

    if ($user->login($email, $password)) {
        // Redirect to the dashboard upon successful login
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"  rel="stylesheet">
</head>
<body>

    <!-- <h2>Login</h2> -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
<div class="login-form">
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    </div>

    <div class="register-button"><p>Do not have an account? <button><a href="signup.php">Register Now</a></button></p></div>
</body>
</html>
