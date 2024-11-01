<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Event.php';
include_once '../../utilitites.php';

function addCategory(string $name, string $color)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("INSERT INTO categories (name, color) VALUES (?, ?)");

    error_log($color);

    $sqlQuery->bind_param(
        "ss",
        $name,
        $color
    );

    if ($sqlQuery->execute()) {
        return $sqlQuery->insert_id;
    } else {
        return false;
    }
}

if (getRequestMethod() === 'POST') {
    $name = $_POST['name'];
    $color = $_POST['color'];

    try {
        $result = addCategory($name, $color);
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(201, 'Category created successfully.');
    } else {
        send_response(500, 'Failed to create category.');
    }
} else {
    send_response(500, 'Invalid http request.');
}
