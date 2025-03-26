<?php

function sendResponse($statusCode, $message, $data = null) {
    http_response_code($statusCode);
        $response = [
        'status' => $statusCode,
        'message' => $message,
        'data' => $data
        ];
    echo json_encode($response);
        exit();
}
?>