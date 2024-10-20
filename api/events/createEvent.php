<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../models/Event.php';
include_once '../utilitites.php';

function addEvent(Event $event)
{
    $mysqli = connectToDatabase();
    $stmt = $mysqli->prepare("INSERT INTO events (title, start, end, description, picture, category_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "siissi",
        $event->getTitle(),
        $event->getStart(),
        $event->getEnd(),
        $event->getDescription(),
        // TODO
        '', // $event->getPicture(),
        '' //$event->getCategoryId()
    );

    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        return false;
    }
}

if (getRequestMethod() === 'POST') {
    $title = $_POST['title'];
    $unixStart = (int)$_POST['unixStart'];
    $unixEnd = (int)$_POST['unixEnd'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $categoryId = (int)$_POST['categoryId'];

    $event = new Event(0, $title, $unixStart, $unixEnd, $description, $picture, $categoryId);

    try {
        $result = addEvent($event);
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
