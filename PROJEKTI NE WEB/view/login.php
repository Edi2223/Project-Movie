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
<style>
body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
      
</style>
        <body>

    <!-- <h2>Login</h2> -->
   
<div class="login-body">
    <div class="form">
        <form class="login-form" action="login.php" method="POST">
        
        <?php if (isset($error)): ?>
                    <p style="color: red" class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
           
        <!-- <label for="email">Email:</label> -->
        
            <input type="email" id="email" placeholder="username" name="email" required><br><br>
            
            <!-- <label for="password">Password:</label> -->
            <input type="password" id="password" name="password" placeholder="password" required><br><br>
            
            <button class="login-button" type="submit">Login</button>
        
            <p class="message">Not registered? <a href="signup.php">       Register Now</a></p>
    
        </form>
    </div>
</div>
</body>
</html>
