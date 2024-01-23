<?php
require_once '../models/db.php'; // Include your DB class
require_once '../models/user.php'; // Include your User class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a DB instance
    $db = new DB();

    // Create a User instance
    $user = new User(null, $email, $password, '', $db);

    if ($user->register($email, $password)) {
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
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="signup.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
