<?php

require_once '../models/db.php'; // Include your DB class
require_once '../models/user.php'; // Include your User class

session_start();
// Check if the user is authenticated (logged in)
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $isLoggedIn = true; // User is logged in
    $role = $_SESSION['user_role'];
} else {
    $isLoggedIn = false; // User is not logged in
    $userEmail = "Profile";
}

if ($isLoggedIn) {
    // Create a DB instance
    $db = new DB();

    // Create a User instance
    $user = new User($_SESSION['user_id'], $userEmail, '', '', $db);

    // Function to log out the user using the User class method
    function logout($user) {
        $user->logout();
        header('Location: login.php'); // Redirect to the login page after logging out
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>DNG Studios</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <a href="index.html"></a><h1 class="logo">The DNG</h1></a>
            </div>
            <div class="menu-container">
                <ul class="menu-list">
                    <li class="menu-list-item active"><a href="index.php">Home</a></li>
                    <li class="menu-list-item"><a href="wip.php">Movies</a></li>
                    <li class="menu-list-item"><a href="wip.php">Series</li>
                    <li class="menu-list-item"><a href="wip.php">Popular</li>
                    <li class="menu-list-item"><a href="wip.php">Trends</a></li>
                    <?php if ($role == "admin"): ?>
                        <li class="menu-list-item"><a href="wip.php">Admin Dashboard</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="profile-container">
                <!-- <div id="profile-avatar"> -->
                    <img class="profile-picture profile-avatar" src="img/profile.jpg" alt="">
                    <div class="profile-text-container">
                        <span class="profile-text" id="profile-text"><?php echo $userEmail; ?></span>
                        <!-- <i class="fas fa-caret-down"></i> -->
                    </div>
                    <!-- </div> -->
                    <div class="toggle">
                        <i class="fas fa-moon toggle-icon"></i>
                    <i class="fas fa-sun toggle-icon"></i>
                    <div class="toggle-ball"></div>
                </div>
                <?php if ($isLoggedIn): ?>
                            <button type="submit" name="logout" class="menu-list-item btn" onclick="location.href='logout.php';">Log Out</button>
                    <?php else: ?>
                        <button class="menu-list-item btn" onclick="location.href='login.php';">Log In</button>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="admin-panel">
    <div>
    <h2>Add New Movie</h2>
    <form action="../controllers/movies/movie_controller.php" method="post">
        <input type="hidden" name="action" value="create">
        <input type="text" name="title" placeholder="Title">
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="category" placeholder="Category">
        <input type="text" name="img" placeholder="Image URL">
        <input type="text" name="imdb_link" placeholder="IMDB Link">
        <button type="submit">Add Movie</button>
    </form>
    </div>

    <div>
    <h2>Edit Existing Movie</h2>
    <form action="../controllers/movies/movie_controller.php" method="post">
        <input type="hidden" name="action" value="update">
        <input type="text" name="id" placeholder="Movie ID">
        <input type="text" name="title" placeholder="New Title">
        <textarea name="description" placeholder="New Description"></textarea>
        <input type="text" name="category" placeholder="New Category">
        <input type="text" name="img" placeholder="New Image URL">
        <input type="text" name="imdb_link" placeholder="New IMDB Link">
        <button type="submit">Update Movie</button>
    </form>
    </div>

    <div>
    <h2>Delete Movie</h2>
    <form action="../controllers/movies/movie_controller.php" method="post">
        <input type="hidden" name="action" value="delete">
        <input type="text" name="id" placeholder="Movie ID">
        <button type="submit">Delete Movie</button>
    </form>
    </div>

    <div>
    <h2>Get Movie by ID</h2>
    <form action="../controllers/movies/movie_controller.php" method="get">
        <input type="hidden" name="action" value="getById">
        <input type="text" name="id" placeholder="Movie ID">
        <button type="submit">Get Movie</button>
    </form>
    </div>

    <div>
    <h2>List Movies by Category</h2>
    <form action="../controllers/movies/movie_controller.php" method="get">
        <input type="hidden" name="action" value="getByCategory">
        <input type="text" name="category" placeholder="Category">
        <button type="submit">List Movies</button>
    </form>
    </div>
</div>
    
    <script src="../view/app.js"></script>
</body>

</html>