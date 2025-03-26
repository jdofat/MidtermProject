<?php

class Authors {
    private $connect;
    private $table = 'authors';

    public $id;
    public $name;
    public function __construct($database) {
        $this->connect = $database;
    }

// GET all
    public function getAllAuthors() {
        $query = 'SELECT id, name FROM ' . $this->table;
        $mystatement = $this->connect->prepare($query);
        $mystatement->execute();
        return $mystatement->fetchAll(PDO::FETCH_ASSOC);
    }

// GET by auth_id
    public function getAuthorById($author_id) {
        $query = 'SELECT id, name FROM ' . $this->table . ' WHERE id = :author_id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':author_id', $author_id);
        $mystatement->execute();
    
        $result = $mystatement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            }
    }

// POST by auth_id

    public function createAuthor() {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :author';
        $mystatement = $this->connect->prepare($query);

        $mystatement->bindParam(':author', $this->name);

        if ($mystatement->execute()) {
            $this->id = $this->connect->lastInsertId();
                return true;
        }
    }

// PUT by auth and id

    public function updateAuthor() {
        $query = 'UPDATE ' . $this->table . ' SET name = :author WHERE id = :id';
        $mystatement = $this->connect->prepare($query);

        $mystatement->bindParam(':author', $this->name);
        $mystatement->bindParam(':id', $this->id);

        if ($mystatement->execute()) {
            return true;
        }
    }

// DELETE

    public function deleteAuthor($author_id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :author_id';
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':author_id', $author_id);
            if ($stmt->execute()) {
                return true;
        }
    }
}

?>