<?php

include_once '../../utilitites.php';
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Category.php';

function getCategories()
{
    $mysqli = connectToDatabase();
    $sqlQuery = "SELECT id, name, color FROM categories";

    $result = $mysqli->query($sqlQuery);

    if ($result->num_rows > 0) {
        $results = $result->fetch_all(MYSQLI_ASSOC);

        return $results;
    } else {
        return [];
    }
}

if (getRequestMethod() === 'GET') {
    error_log('GET categories endpoint');

    try {
        $result = getCategories();

        send_response(200, 'Categories fetched succesfully', $result);
    } catch (Exception $e) {
        send_response(500, 'Failed to get categories.');
    }
} else {
    send_response(500, 'Invalid http request.');
}