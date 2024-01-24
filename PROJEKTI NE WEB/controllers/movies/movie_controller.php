<?php
require_once '../../models/db.php'; // Include your DB class
require_once '../../models/movie.php';

class MovieController{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }
 // Implement methods for CRUD operations on movies
    public function createMovie($title, $description, $category, $img, $imdb_link) {
        try {
            $stmt = $this->db->prepare("INSERT INTO movies (title, description, category, img, imdb_link) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $category, $img, $imdb_link]);
            return true; // Movie creation successful
        } catch (PDOException $e) {
            return false; // Movie creation failed
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
}

// Usage example:
$movieController = new movieController();

// Add a new movie
$result = $movieController->createMovie("title", "desc", "comedy", "imggg", "link");
echo $result;

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