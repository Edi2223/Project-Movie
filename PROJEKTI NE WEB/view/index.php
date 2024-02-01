<?php
    require_once '../models/db.php';
    require_once '../models/user.php';
    require_once '../controllers/movie_controller.php';
    
    session_start();
    $role = "user";     
    $isLoggedIn = false;

    $movieController = new MovieController();
    $allMovies = $movieController->getAllMovies();
    $comedyMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'comedy') !== false;
    });
    $actionMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'action') !== false;
    });
    $horrorMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'horror') !== false;
    });
    $fantasyMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'fantasy') !== false;
    });
    $dramaMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'drama') !== false;
    });
    $sciFiMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'sci-fi') !== false;
    });
    $romanceMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'romance') !== false;
    });
    $thrillerMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'thriller') !== false;
    });
    $animationMovies = array_filter($allMovies, function($movie) {
        return strpos($movie['category'], 'animation') !== false;
    });

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
    if(!$isLoggedIn){
        header('Location: login.php');
        exit;
    }
?>

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
                        <li class="menu-list-item"><a href="admin-dashboard.php">Admin Dashboard</a></li>
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

    <div class="container">
        <div class="content-container">
            <div class="featured-content"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('img/f-1.jpg');">
                <img class="featured-title" src="img/f-t-1.png" alt="">
                <p class="featured-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto illo dolor
                    deserunt nam assumenda ipsa eligendi dolore, ipsum id fugiat quo enim impedit, laboriosam omnis
                    minima voluptatibus incidunt. Accusamus, provident.</p>
                <button class="featured-button">WATCH</button>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Action</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                    <?php
                            foreach ($actionMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Comedy</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($comedyMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="featured-content"
                style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('img/f-2.jpg');">
                <img class="featured-title" src="img/f-t-2.png" alt="">
                <p class="featured-desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto illo dolor
                    deserunt nam assumenda ipsa eligendi dolore, ipsum id fugiat quo enim impedit, laboriosam omnis
                    minima voluptatibus incidunt. Accusamus, provident.</p>
                <button class="featured-button">WATCH</button>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Horror</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($horrorMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Fantasy</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($fantasyMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Drama</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($dramaMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Sci-Fi</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($sciFiMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Romance</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($romanceMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Thriller</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($thrillerMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div class="movie-list-container">
                <h1 class="movie-list-title">Animation</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <?php
                            foreach ($animationMovies as $movie) {
                                echo "<div class='movie-list-item'>";
                                echo "<img class='movie-list-item-img' src='{$movie['img']}' alt='{$movie['title']}'>";
                                echo "<span class='movie-list-item-title'>{$movie['title']}</span>";
                                echo "<p class='movie-list-item-desc'>{$movie['description']}</p>";
                                echo "<button class='movie-list-item-button'>Watch</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../view/app.js"></script>
</body>

</html>
