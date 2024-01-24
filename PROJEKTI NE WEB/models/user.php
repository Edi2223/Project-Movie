<?php

class User {
    private $id;
    private $email;
    private $password;
    private $role;
    private $db;

    public function __construct($id, $email, $password, $role, $db) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->db = $db;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole(){
        return $this->role;
    }

    // public function register($email, $password) {
    //     // Hash the password before storing it in the database
    //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //     // Insert the user into the database
    //     try {
    //         $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    //         $stmt->execute([$email, $hashedPassword]);
    //         return true; // Registration successful
    //     } catch (PDOException $e) {
    //         return false; // Registration failed
    //     }
    // }

    public function login($email, $password) {
        // Retrieve the user's data by email
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Start a session and store user information
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            return true; // Login successful
        } else {
            return false; // Login failed
        }
    }

    public function logout() {
        // Destroy the session and log the user out
        session_start();
        session_unset();
        session_destroy();
    }

    public function isAuthenticated() {
        // Check if the user is authenticated (logged in)
        return isset($_SESSION['user_id']);
    }
}

?>