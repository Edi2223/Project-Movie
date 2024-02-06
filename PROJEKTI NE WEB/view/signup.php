<?php
require_once '../models/db.php'; // Include your DB class
require_once '../models/user.php'; // Include your User class
require_once '../controllers/user_controller.php'; // Include the UserController

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a UserController instance
    $userController = new UserController();

    // Register the user using the UserController
    $result = $userController->addUser($email, $password, 'user');

    if ($result === "User registration successful!") {
        // Redirect to the login page after successful registration
        header('Location: login.php');
        exit;
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
    <!-- <h2>Sign Up</h2> -->
   
<div class="signup-body">
    <div class="form">
        <form class="signup-form " action="signup.php" method="POST">
        <input type="email" id="email" name="email"  placeholder="username"required><br><br>
        
        <input type="password" id="password" name="password" placeholder="password" required><br><br>
        
        <button class="signup-button" type="submit">Sign Up</button>
        <p class="message">Already have an account? <a href="login.php">Log in here</a></p>
    
        </form>
    </div>
</div>
</body>
   </html>
