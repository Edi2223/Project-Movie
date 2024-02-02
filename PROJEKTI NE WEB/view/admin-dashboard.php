<?php

require_once '../controllers/movie_controller.php';
require_once '../models/user.php';
require_once '../models/db.php';

session_start();

$movieController = new MovieController();

$movies = $movieController->getAllMovies();
// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $isLoggedIn = true; 
    $role = $_SESSION['user_role'];
} else {
    $isLoggedIn = false;
    $userEmail = "Profile";
}

if ($isLoggedIn) {
    // Create a DB instance
    $db = new DB();

    // Create a User instance
    $user = new User($_SESSION['user_id'], $userEmail, '', '', $db);

    // Function to log out the user
    function logout($user) {
        $user->logout();
        header('Location: login.php');
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['title'], $_POST['description'], $_POST['category'],$_POST['imdb_link']) && isset($_POST['add_movie'])){ // e ndaloj errorin "undefined array key in .."
    // $email = $_POST['email'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $imdb_link = $_POST['imdb_link'];

    // Register the movie using the MovieController
    $result = $movieController->createMovie($title, $description, $category, "" ,$imdb_link);

    if ($result) {
        echo "Registration successful";
        exit;
    }} else {
        $error = "Registration failed. Please try again.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_movie'])) {
        $movieId = $_POST['id'];
        $result = $movieController->deleteMovie($movieId);
        if ($result) {
            // Movie deleted successfully
            echo "Movie deleted successfully.";
            // Redirect or refresh the page if needed
        } else {
            // Failed to delete movie
            echo "Failed to delete movie.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_movie_submit'])) {
        $editedId = $_POST['id'];
        $editedTitle = $_POST['title'];
        $editedDescription = $_POST['description'];
        $editedCategory = $_POST['category'];
        $editedImg = $_POST['img'];
        $editedImdb_link = $_POST['imdb_link'];

        $result = $movieController->updateMovie($editedId, $editedTitle, $editedDescription, $editedCategory, $editedImg, $editedImdb_link);
        
        if ($result) {
            echo "Movie updated successfully.";
        } else {
            echo "Failed to update movie.";
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
    <div class="admin-panel">
        <h2>Add New Movie</h2>
        <div class="attributes">
    
            <button id="addMovieButton">Add</button>
    <div id="addMovieForm" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h2 class="white-header-2">Add New Movie</h2>
            <form action="admin-dashboard.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create">
                        <input type="text" name="title" placeholder="Title">
                        <textarea name="description" placeholder="Description"></textarea>
                        <input  type="text" name="category" placeholder="Category">
                        <input type="file" name="image" accept="image/*">
                        <input type="text" name="imdb_link" placeholder="IMDB Link">
                                    <button type="submit" name="add_movie">Add Movie</button>
            </form>
        </div>
    </div>
    </div>

   <?php if (isset($_POST['delete_movie'])) {
    $movieId = $_POST['id'];

    $result = $movieController->deleteMovie($movieId);
    if ($result) {
       
        $movies = $movieController->getAllMovies();
    }
}
    
?>
    <?php if($movies){
        foreach ($movies as $movie) {
           
            // Display each movie
        echo "<div>";
        echo "<img src='{$movie['img']}' alt='Movie Image'>";
        echo "<h2>{$movie['title']}</h2>";
        echo "<p>{$movie['description']}</p>";
        echo "<p>Category: {$movie['category']}</p>";
        echo "<a href=\"{$movie['imdb_link']}\" target=\"_blank\">IMBD link</a>";
        // Display additional movie details as needed
        echo "</div>";

        // Form to delete the movie
        echo "<form action='admin-dashboard.php' method='post'>";
        echo "<input type='hidden' name='action' value='delete'>"; // Action to identify delete operation
        echo "<input type='hidden' name='id' value='{$movie['id']}'>"; // Movie ID input field
       
        echo "<button type='submit' name='delete_movie'>Delete</button>";
        echo "</form>";
        $escapedDescription = addslashes($movie['description']);
        // Form to edit the movie
        echo "<form action='admin-dashboard.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$movie['id']}'>"; // Movie ID input field
        echo "<button  type='button' onclick=\"openModal({$movie['id']}, '{$movie['title']}', '{$escapedDescription}', '{$movie['category']}', '{$movie['img']}', '{$movie['imdb_link']}')\" name=\"edit_movie\">Edit</button>";
        echo "</form>";
    }
}
 else {
    echo "No movies found.";
    } ?>

        
</div>
    
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeEditModal()">&times;</span>
    <h2 class="white-header-2">Edit Movie</h2>
    <form action="admin-dashboard.php" method="post">
      <input type="hidden" id="editAction" name="action" value="update">
      <input type="hidden" id="editId" name="id" value="">
      <input type="text" id="editTitle" name="title" placeholder="Title">
      <textarea id="editDescription" name="description" placeholder="Description"></textarea>
      <input type="text" id="editCategory" name="category" placeholder="Category">
      <input type="text" id="editImg" name="img" placeholder="Image URL">
      <input type="text" id="editImdbLink" name="imdb_link" placeholder="IMDB Link">
      <button type="submit" name="edit_movie_submit">Update Movie</button>
    </form>
  </div>
</div>
<script>
  function openModal(id, title, description, category, img, imdbLink) {
      console.log("function is working");
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;
    document.getElementById('editCategory').value = category;
    document.getElementById('editImg').value = img;
    document.getElementById('editImdbLink').value = imdbLink;
    document.getElementById('editModal').style.display = "block";
  }

  function closeEditModal() {
    document.getElementById('editModal').style.display = "none";
  }

  document.getElementById('addMovieButton').addEventListener('click', function() {
    // Show the "Add New Movie" form in a modal
    document.getElementById('addMovieForm').style.display = 'block';
});

function closeAddModal() {
    document.getElementById('addMovieForm').style.display = "none";
}
</script>
<script src="app.js"></script>
</body>

</html>