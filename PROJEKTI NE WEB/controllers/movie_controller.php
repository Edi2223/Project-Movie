<?php
require_once '../models/db.php';
require_once '../models/movie.php';

class MovieController{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }
 // Implement methods for CRUD operations on movies
    public function createMovie($title, $description, $category, $img, $imdb_link) {
        try {
            $imgPath = $this->uploadImage(); // Call a method to handle image upload
            $categoryToLower = strtolower($category);
            $stmt = $this->db->prepare("INSERT INTO movies (title, description, category, img, imbd_link) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $categoryToLower, $imgPath, $imdb_link]); // Use the uploaded image path
            header('Location: admin-dashboard.php');
            return true; // Movie creation successful
        } catch (PDOException $e) {
            return false; // Movie creation failed
        }
    }

    private function uploadImage() {
        $targetDir = "../view/img/"; // Specify the target directory for image uploads
        $targetFile = $targetDir . basename($_FILES["image"]["name"]); // Get the file name
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) { // Move the uploaded file to the target directory
            return $targetFile; // Return the path of the uploaded image
        } else {
            return false; // Return false if the file upload failed
        }
    }

    public function getMovieById($id) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMovie($id, $title, $description, $category, $img, $imdb_link) {
        try {
            $stmt = $this->db->prepare("UPDATE movies SET title = ?, description = ?, category = ?, img = ?, imdb_link = ? WHERE id = ?");
            $stmt->execute([$title, $description, $category, $img, $imdb_link, $id]);
            return true; // Movie update successful
        } catch (PDOException $e) {
            return false; // Movie update failed
        }
    }

    public function deleteMovie($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM movies WHERE id = ?");
            $stmt->execute([$id]);
            return true; // Movie deletion successful
        } catch (PDOException $e) {
            return false; // Movie deletion failed
        }
    }

    public function getMoviesByCategory($category) {
        $sql = "SELECT * FROM movies WHERE FIND_IN_SET(?, category)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$category]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function handleRequest() {

        $action = $_POST['action'] ?? $_GET['action'];
        switch ($action) {
            case 'create':
                // Call createMovie() with form data
                echo "Added";
                break;
            case 'update':
                // Call updateMovie() with form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $img = $_POST['img'];
                $imdb_link = $_POST['imdb_link'];
                $result = $this->updateMovie($id, $title, $description, $category, $img, $imdb_link);
                if ($result) {
                    echo "Movie updated successfully.";
                } else {
                    echo "Failed to update movie.";
                }
                break;
            case 'delete':
                // Call deleteMovie() with form data
                break;
            case 'getById':
                // Call getMovieById() with form data
                break;
            case 'getByCategory':
                // Call getMoviesByCategory() with form data
                break;
        }
    }

    public function getAllMovies() {
        $db = new DB();
         $movies = $db->query("SELECT * FROM movies");
        return $movies;
    }
}



// Usage example:
$movieController = new movieController();


// $movieController->handleRequest();

// Add a new movie
// $result = $movieController->createMovie("title", "desc", "comedy", "imggg", "link");
// echo $result;

// Get movie data by ID
// $movieData = $movieController->getMovieById(1);
// if ($movieData) {
//     print_r($movieData);
// } else {
//     echo "Movie not found.";
// }

// // Update movie data
// $updateResult = $movieController->updateMovie(1, "newemail@example.com", "newpassword123");
// echo $updateResult;

// Delete a movie
// $deleteResult = $movieController->deleteMovie(2);
// echo $deleteResult;

?>