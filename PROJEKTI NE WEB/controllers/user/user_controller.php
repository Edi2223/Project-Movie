<?php
require_once '../models/db.php'; // Include your DB class
require_once '../models/user.php'; // Include your User class

class UserController {
    private $db;

    public function __construct() {
        // Create a DB instance
        $this->db = new DB();
    }

    public function addUser($email, $password, $role, $db) {
        // Establish a database connection
        $pdo = $this->db->connection();

        // Create a User instance
        $user = new User(null, $email, $password, $role, $db); // The "null" ID will be auto-generated by the database

        // Insert the user into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->execute([$user->getEmail(), $user->getPassword()]);
            return "User registration successful!";
        } catch (PDOException $e) {
            return "User registration failed: " . $e->getMessage();
        }
    }

    public function deleteUser($userId) {
        // Establish a database connection
        $pdo = $this->db->connection();

        // Delete the user from the database
        try {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return "User deleted successfully!";
        } catch (PDOException $e) {
            return "User deletion failed: " . $e->getMessage();
        }
    }

    public function updateUser($userId, $email, $password) {
        // Establish a database connection
        $pdo = $this->db->connection();

        // Update the user in the database
        try {
            $stmt = $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
            $stmt->execute([$email, $password, $userId]);
            return "User updated successfully!";
        } catch (PDOException $e) {
            return "User update failed: " . $e->getMessage();
        }
    }

    public function getUserById($userId) {
        // Establish a database connection
        $pdo = $this->db->connection();

        // Retrieve user data from the database
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            return null; // Return null if user retrieval fails
        }
    }
}

// Usage example:
$userController = new UserController();

// Add a new user
$result = $userController->addUser("user@example.com", "password123", "user", $db);
echo $result;

// Get user data by ID
// $userData = $userController->getUserById(1);
// if ($userData) {
//     print_r($userData);
// } else {
//     echo "User not found.";
// }

// // Update user data
// $updateResult = $userController->updateUser(1, "newemail@example.com", "newpassword123");
// echo $updateResult;

// // Delete a user
// $deleteResult = $userController->deleteUser(1);
// echo $deleteResult;
