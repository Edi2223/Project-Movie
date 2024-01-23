<?php
    
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

                </ul>
            </div>
            <div class="profile-container">
                <button class="menu-list-item btn">Sign Up</button>
                <!-- <div id="profile-avatar"> -->
                    <img class="profile-picture profile-avatar" src="img/profile.jpg" alt="">
                    <div class="profile-text-container">
                        <span class="profile-text" id="profile-text">Profile</span>
                        <!-- <i class="fas fa-caret-down"></i> -->
                    </div>
                <!-- </div> -->
                <div class="toggle">
                    <i class="fas fa-moon toggle-icon"></i>
                    <i class="fas fa-sun toggle-icon"></i>
                    <div class="toggle-ball"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <a href="wip.html"><i class="left-menu-icon fas fa-search"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-home"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-users"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-bookmark"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-tv"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-hourglass-start"></i></a>
        <a href="wip.html"><i class="left-menu-icon fas fa-shopping-cart"></i></a>
    </div>
    <div class="wip-content">
        <div class="wip-text">
            <h2>This project is a work in progress...</h2>
            <p>Click the Home link to go back</p>
        </div>
    </div>
</body>
</html>