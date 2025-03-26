<?php

class Quotes {
    private $connect;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    public function __construct($database) {
        $this->connect = $database;
    }

// 1. get all quotes:

    public function getAllQuotes() {
        $query = 'SELECT * FROM ' . $this->table;
        $mystatement = $this->connect->prepare($query);
        $mystatement->execute();
            return $mystatement->fetchAll(PDO::FETCH_ASSOC);
    }

// 2. get by auth_id:

    public function getQuotesByAuthor($author_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE author_id = :author_id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $mystatement->execute();
            return $mystatement->fetchAll(PDO::FETCH_ASSOC);
    }

// 3. get by cat_id:

    public function getQuotesByCategory($category_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE category_id = :category_id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':category_id', $category_id);
        $mystatement->execute();
            return $mystatement->fetchAll(PDO::FETCH_ASSOC);
}

// 4. get by both:

    public function getQuotesByAuthorAndCategory($author_id, $category_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE author_id = :author_id AND category_id = :category_id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':author_id', $author_id);
        $mystatement->bindParam(':category_id', $category_id);
        $mystatement->execute();
            return $mystatement->fetchAll(PDO::FETCH_ASSOC);
}

// 5. get by quote_id:

    public function getQuoteById($quote_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :quote_id ';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':quote_id', $quote_id);
        $mystatement->execute();
            return $mystatement->fetch(PDO::FETCH_ASSOC);
}

// 6. POST request:


    public function createQuote() {
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)';
        $mystatement = $this->connect->prepare($query);

        $mystatement->bindParam(':quote', $this->quote);
        $mystatement->bindParam(':author_id', $this->author_id);
        $mystatement->bindParam(':category_id', $this->category_id);

            if ($mystatement->execute()) {
                $this->id = $this->connect->lastInsertId();
                    return true;
            }
            return false;
}

// 6. PUT request:

    public function updateQuote() {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $this->id);
        $mystatement->execute();
    
    if ($mystatement->rowCount() > 0) {
        $query = 'UPDATE ' . $this->table . ' SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id';
        $mystatement = $this->connect->prepare($query);

        $mystatement->bindParam(':id', $this->id);
        $mystatement->bindParam(':quote', $this->quote);
        $mystatement->bindParam(':author_id', $this->author_id);
        $mystatement->bindParam(':category_id', $this->category_id);

        if ($mystatement->execute()) {
            return true;
        }
    }
    return false;
}

// 7. DELETE request:

    public function deleteQuote() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $mystatement = $this->connect->prepare($query);
        $mystatement->bindParam(':id', $this->id);

            if ($mystatement->execute()) {
                return true;
            }
          return false;
        }
    };
?>