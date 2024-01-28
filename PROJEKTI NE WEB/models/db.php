<?php

class DB {
    private $host;
    private $username;
    private $password;
    private $database;
    private $pdo;

    public function __construct() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "dng_studio";
    }

    public function connection() {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ];

                $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
     }

    public function prepare($sql) {
        return $this->connection()->prepare($sql);
    
    
    }
    public function query($sql) {
        $stmt = $this->connection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



?>