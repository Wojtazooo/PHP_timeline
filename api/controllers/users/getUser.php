<?php

include_once '../../utilitites.php';
include_once '../../database/DatabaseConnection.php';

function getUser(int $userId)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("SELECT username, created_at FROM users WHERE id = ?");

    $sqlQuery->bind_param(
        "i",
        $userId,
    );
    $sqlQuery->execute();
    $result = $sqlQuery->get_result();
    $user = $result->fetch_assoc();

    return $user;
}

if (getRequestMethod() === 'GET') {
    session_start();
    $userId = $_GET['userId'];

    try {
        $result = getUser($userId);
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'OK', $result);
    } else {
        send_response(404, 'Not found.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
