<?php

// GET
// categories/ All categories with their ids (id, category)
// categories/?id=7 The specific category with its id
// If no categories found for routes above { message: ‘category_id Not Found’ }

include_once 'api/config/database.php';
include_once 'api/models/categories.php';

    $database = new Database();
    $db = $database->getConnection();
    $category = new Categories($db);

    header('Content-Type: application/json');

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