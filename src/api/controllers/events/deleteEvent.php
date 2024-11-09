<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../utilitites.php';

function deleteEvent(int $eventId)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("DELETE FROM events WHERE id = ?");

    $sqlQuery->bind_param("i", $eventId);

    if ($sqlQuery->execute()) {
        return true;
    } else {
        return false;
    }
}

if (getRequestMethod() === 'DELETE') {
    auth_user();

    try {
        parse_str(file_get_contents("php://input"), $_DELETE);
        $eventId = (int)$_DELETE['id'];


        $result = deleteEvent($eventId);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'Event deleted successfully.');
    } else {
        send_response(500, 'Failed to delete event.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
