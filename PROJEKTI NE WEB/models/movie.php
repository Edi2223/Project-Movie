<?php
class Movie {
    private $id;
    private $title;
    private $description;
    private $category;
    private $img;
    private $imdb_link;
    private $db;

    public function __construct($id, $title, $description, $category, $img, $imdb_link, $db) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->img = $img;
        $this->imdb_link = $imdb_link;
        $this->db = $db;
    }
    // Getters

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getImg() {
        return $this->img;
    }

    public function getImbd() {
        return $this->imdb_link;
    }
}

?>
