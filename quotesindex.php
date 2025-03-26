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

$database = new Database();
$db = $database->getConnection();
$quote = new Quotes($db);

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

?>
