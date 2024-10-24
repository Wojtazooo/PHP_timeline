<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Event.php';
include_once '../utilitites.php';

function addEvent(string $title, string $start, string $end, string $description, string $picture, int $categoryId)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("INSERT INTO events (title, start, end, description, picture, category_id) VALUES (?, ?, ?, ?, ?, ?)");

    error_log('Start: ' . $start);

    // TODO: pass here $categoryId when categories will be implemented
    $xxx = 1;

    $sqlQuery->bind_param(
        "sssssi",
        $title,
        $start,
        $end,
        $description,
        $picture,
        $xxx
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

    error_log('Start: ' . $start);

    try {
        $result = addEvent($title, $start, $end, $description, $picture, $categoryId);
    } catch (Exception $e) {
        send_response(['success' => false, 'message' => $e->getMessage()], 500);
    }

    if ($result) {
        send_response(['success' => true, 'message' => 'Event created successfully.'], 201);
    } else {
        send_response(['success' => false, 'message' => 'Failed to create event.'], 500);
    }
} else {
    send_response(['success' => false, 'message' => 'Invalid http request.'], 500);
}
