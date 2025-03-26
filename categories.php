<?php

class Categories {
    private $connect;
    private $table = 'categories';

    public $id;
    public $category;
    public function __construct($database) {
        $this->connect = $database;
    }

//get all
    public function getAllCategories() {
        $query = 'SELECT id, category FROM ' . $this->table;
        $mystatement = $this->connect->prepare($query);
        $mystatement->execute();
            return $mystatement->fetchAll(PDO::FETCH_ASSOC);
    }

//get by id:
    public function getCategoryById($id) {
        $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $id);
        $mystatement->execute();
            return $mystatement->fetch(PDO::FETCH_ASSOC);
    }

//post
    public function createCategory() {
        $query = 'INSERT INTO ' . $this->table . ' SET category = :category';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':category', $this->category);

        if ($mystatement->execute()) {
            $this->id = $this->connect->lastInsertId();
                return true;
    }
}

// put
    public function updateCategory() {
        $query = 'SELECT id FROM ' . $this->table . ' WHERE id = :id';
        $mystatementmt = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $this->id);
        $mystatement->execute();

    if ($stmt->rowCount() == 0) {
        return false;
    }

    $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':category', $this->category);
        $mystatement->bindParam(':id', $this->id);

    if ($mystatement->execute()) {
        return true;
    }
}

//delete:

    public function deleteCategory() {
        $query = 'SELECT id FROM ' . $this->table . ' WHERE id = :id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $this->id);
        $mystatement->execute();

        if ($mystatement->rowCount() == 0) {
            return false;
        }

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $this->id);

        if ($mystatement->execute()) {
            return true;
    }
  }
}
?>