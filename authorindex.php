<?php

include_once "api/config/database.php";
include_once "api/models/authors.php";

$database = new Database();
$db = $database->getConnection();
$author = new Authors($db);

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

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












?>
