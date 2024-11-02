<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Event.php';
include_once '../../utilitites.php';

function addEvent(string $title, string $start, string $end, string $description, string $picture, int $categoryId)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("INSERT INTO events (title, start, end, description, picture, category_id) VALUES (?, ?, ?, ?, ?, ?)");

    $sqlQuery->bind_param(
        "sssssi",
        $title,
        $start,
        $end,
        $description,
        $picture,
        $categoryId
    );

    if ($sqlQuery->execute()) {
        return $sqlQuery->insert_id;
    } else {
        return false;
    }
}

if (getRequestMethod() === 'POST') {
    $title = $_POST['title'];
    $startDateString = $_POST['start'];
    $start = DateTime::createFromFormat('d-m-Y', $startDateString)->format('Y-m-d') . ' 00:00:00';
    $endDateString = $_POST['end'];
    $end = DateTime::createFromFormat('d-m-Y', $endDateString)->format('Y-m-d') . ' 00:00:00';
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $categoryId = (int)$_POST['categoryId'];

    try {
        $result = addEvent($title, $start, $end, $description, $picture, $categoryId);
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(201, 'Event created successfully.');
    } else {
        send_response(500, 'Failed to create event.');
    }
} else {
    send_response(500, 'Invalid http request.');
}
