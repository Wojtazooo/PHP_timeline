<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../utilitites.php';

function updateEvent(
    mysqli $mysqli,
    int $id,
    string $title,
    string $start,
    string $end,
    string $description,
    string $picture,
    int $categoryId
) {
    error_log('1');
    $sqlQuery = $mysqli->prepare("UPDATE events SET title = ?, start = ?, end = ?, description = ?, picture = ?, category_id = ? WHERE id = ?");

    $sqlQuery->bind_param(
        "sssssii",
        $title,
        $start,
        $end,
        $description,
        $picture,
        $categoryId,
        $id
    );

    if ($sqlQuery->execute()) {
        return true;
    } else {
        return false;
    }
}

function doesEventExist(mysqli $mysqli, string $eventId)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM events WHERE id = ?");
    $sqlQuery->bind_param(
        "i",
        $eventId,
    );
    $sqlQuery->execute();
    $res = $sqlQuery->get_result();
    $exists = $res->num_rows == 1 ? true : false;

    return $exists;
}

function doesEventWithTheSameNameAlreadyExist(mysqli $mysqli, int $eventId, string $eventTitle)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM events WHERE title = ? and id != ?");
    $sqlQuery->bind_param(
        "si",
        $eventTitle,
        $eventId
    );
    $sqlQuery->execute();
    $res = $sqlQuery->get_result();
    $exists = $res->num_rows == 1 ? true : false;

    return $exists;
}

if (getRequestMethod() === 'PUT') {
    auth_user();

    try {
        parse_str(file_get_contents("php://input"), $_PUT);

        $eventId = $_PUT['id'];
        $title = $_PUT['title'];
        $startDateString = $_PUT['start'];
        $start = DateTime::createFromFormat('d-m-Y', $startDateString)->format('Y-m-d') . ' 00:00:00';
        $endDateString = $_PUT['end'];
        $end = DateTime::createFromFormat('d-m-Y', $endDateString)->format('Y-m-d') . ' 00:00:00';
        $description = $_PUT['description'];
        $picture = $_PUT['picture'];
        $categoryId = (int)$_PUT['categoryId'];

        $mysqli = connectToDatabase();

        if (!doesEventExist($mysqli, $eventId)) {
            send_response(404, 'Event does not exist.');
        }

        if (doesEventWithTheSameNameAlreadyExist($mysqli, $eventId, $title)) {
            send_response(400, 'Event with name \'' . $eventTitle . '\' already exists.');
        }

        $result = updateEvent($mysqli, $eventId, $title, $start, $end, $description, $picture, $categoryId);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'Event updated successfully.');
    } else {
        send_response(500, 'Failed to update event.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
