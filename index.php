<?php
//Part 1: GET
//1.quotes/ All quotes are returned
//2.quotes/?id=4 The specific quote
//3.quotes/?author_id=10 All quotes from author_id=10
//4.quotes/?category_id=8 All quotes in category_id=8
//5.quotes/?author_id=3&category_id=4 All quotes from authorId=3 that are in category_id=4
//6.If no quotes found for routes above { message: ‘No Quotes Found’ }

//Part 2: POST

//Part 3: PUT

include_once 'api/config/database.php';
include_once 'api/models/quotes.php';
include_once "api/models/authors.php";
include_once 'api/models/categories.php';

    $database = new Database();
    $db = $database->getConnection();
    $quote = new Quotes($db);
    $author = new Authors($db);
    $category = new Categories($db);
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

// Part 1: GET requests

if ($method == 'GET') {
//author_id & category_id:
    if (isset($_GET['author_id']) && isset($_GET['category_id'])) {
        $getresult = $quote->getQuotesByAuthorAndCategory($_GET['author_id'], $_GET['category_id']);
    }
// just author_id:
    elseif (isset($_GET['author_id'])) {
        $getresult = $quote->getQuotesByAuthor($_GET['author_id']);
    }
//just category_id:
    elseif (isset($_GET['category_id'])) {
        $getresult = $quote->getQuotesByCategory($_GET['category_id']);
    }
//just quote_id:
    elseif (isset($_GET['quote_id'])) {
        $getresult = $quote->getQuoteById($_GET['quote_id']);
    }
//all quotes:
    else {
        $getresult = $quote->getAllQuotes();
    }

//no quotes:
    if (!empty($getresult)) {
        echo json_encode($getresult);
    } else {
        echo json_encode(['message' => "no quotes found"]);
    }
}

// Part 2: POST requests:

if ($method == 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    $mustContain = ['quote', 'author_id', 'category_id'];
    foreach ($mustContain as $parameter) {
        if (empty($data->$parameter)) {
            echo json_encode(['message' => 'missing required parameters']);
                exit;
        }
    }

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->createQuote()) {
        echo json_encode([
            'quote' => [
                'id' => $quote->id,
                'quote' => $quote->quote,
                'author_id' => $quote->author_id,
                'category_id' => $quote->category_id
            ]
        ]);
    } 
    
    else {
        echo json_encode(['message' => 'missing required parameters']);
    }
}

// Part 3: PUT requests:

if ($method == 'PUT') {
   
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
        $quote->id = $data->id;
        $quote->quote = $data->quote;
        $quote->author_id = $data->author_id;
        $quote->category_id = $data->category_id;

        if ($quote->updateQuote()) {
            echo json_encode([
                'quote' => [
                    'id' => $quote->id,
                    'quote' => $quote->quote,
                    'author_id' => $quote->author_id,
                    'category_id' => $quote->category_id
                ]
            ]);
        } else {
            echo json_encode(['message' => 'missing required parameters']);
            }
        }
    }

// Part 4: DELETE requests:

if ($method == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) {
        $quote->id = $data->id;

        if ($quote->deleteQuote()) {
            echo json_encode(['id' => $quote->id]);
        } else {
            echo json_encode(['message' => 'no quotes found']);
        }
    }
}

//GET METHODS:

    if ($method == 'GET') {

//GET BY ID
    if (isset($_GET['author_id'])) {
        $getresult = $author->getAuthorById($_GET['author_id']);

    if ($getresult) {
        echo json_encode($getresult);
    } 
        else {
            echo json_encode(['message' => "author_id not found"]);
    }
}

//GET ALL

    elseif (empty($_GET['author_id'])) {
        $getresult = $author->getAllAuthors();
    
        if (!empty($getresult)) {
            echo json_encode($getresult);
        }   
        else {
            echo json_encode(['message' => "author_id not found"]);
        }
    }
}


//POST created auth:

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (empty($data->author)) {
        exit;
    }

    $author->name = $data->author;

    if ($author->createAuthor()) {
        echo json_encode([
            'id' => $author->id,
            'author' => $author->name
        ]);
    } else {
        echo json_encode(['message' => 'author_id not found']);
    }
}

//PUT update:

    if ($method == 'PUT') {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->id) || empty($data->author)) {
            echo json_encode(['message' => 'missing parameters']);
                exit;
        }

        if (!$author->getAuthorById($data->id)) {
            echo json_encode(['message' => "author_id not found"]);
                exit;
        }

    $author->id = $data->id;
    $author->name = $data->author;

        if ($author->updateAuthor()) {
            echo json_encode([
                'id' => $author->id,
                'author' => $author->name
            ]);
        }
        else {
            echo json_encode(['message' => "missing parameters"]);
    }
}


//DELETE:

    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"));

    if (empty($data->id)) {
        echo json_encode(['message' => 'submit id']);
            exit;
    }

    if (!$author->getAuthorById($data->id)) {
        echo json_encode(['message' => 'author_id not found']);
            exit;
    }

    if ($author->deleteAuthor($data->id)) {
        echo json_encode(['id' => $data->id]);
    }

    else {
        echo json_encode(['message' => 'none found']);
    }
}

        // GET
// categories/ All categories with their ids (id, category)
// categories/?id=7 The specific category with its id
// If no categories found for routes above { message: ‘category_id Not Found’ }


$method = $_SERVER['REQUEST_METHOD'];

// GET by id
if ($method == 'GET') {
    if (isset($_GET['category_id'])) {
        $getresult = $category->getCategoryById($_GET['category_id']);
        
        if ($getresult) {
            echo json_encode($getresult);
        } else {
            echo json_encode(["message" => "none found"]);
        }
    } else {
// GET all
        $getresult = $category->getAllCategories();
        
        if (!empty($getresult)) {
            echo json_encode($getresult);
        } else {
            echo json_encode(["message" => "none categories found"]);
        }
    }
}

// POST
// /categories/ created category (id, category)
// Note: To create a category, the POST submission MUST contain the category.
// category_id does not exist { message: ‘category_id Not Found’ }
// If missing any parameters { message: ‘Missing Required Parameters’ }

    if ($method == 'POST') {
        $data = json_decode(file_get_contents("php://input"));

    if (empty($data->category)) {
        echo json_encode(['message' => 'missing parameters']);
        exit;
    }

    $category->category = $data->category;

    if ($category->createCategory()) {
        echo json_encode([
            'id' => $category->id,
            'category' => $category->category
        ]);
        }
    else {
        echo json_encode(['message' => 'category not found']);
    }
}

// PUT
// /categories/ updated category (id, category)
// Note: To create a category, the PUT submission MUST contain the id and category.
// category_id does not exist { message: ‘category_id Not Found’ }
// If missing parameters (except id) { message: ‘Missing Required Parameters’ }

if ($method == 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    
    if (empty($data->id) || empty($data->category)) {
        echo json_encode(['message' => 'missing parameters']);
        exit;
    }

    $category->id = $data->id;
    $category->category = $data->category;

    if ($category->updateCategory()) {
        echo json_encode([
            'id' => $category->id,
            'category' => $category->category
        ]);
    } else {
        echo json_encode(['message' => 'category_id not found']);
    }
}

// DELETE
// /api/categories/ id of deleted category
// If no quotes found to delete { message: ‘No Quotes Found’ }
// Note: All delete requests require the id to be submitted.

    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"));

    if (empty($data->id)) {
        exit;
    }

    $category->id = $data->id;

    if ($category->deleteCategory()) {
        echo json_encode(['id' => $category->id]);
    } else {
        echo json_encode(['message' => 'none found']);
    }
}

    
?>
