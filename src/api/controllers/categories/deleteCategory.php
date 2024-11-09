<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../utilitites.php';

function deleteCategory(mysqli $mysqli,  int $categoryId)
{
    $sqlQuery = $mysqli->prepare("DELETE FROM categories WHERE id = ?");

    $sqlQuery->bind_param("i", $categoryId);

    if ($sqlQuery->execute()) {
        return true;
    } else {
        return false;
    }
}

function doesCategoryExist(mysqli $mysqli, string $categoryId)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM categories WHERE id = ?");
    $sqlQuery->bind_param(
        "i",
        $categoryId,
    );
    $sqlQuery->execute();
    $res = $sqlQuery->get_result();
    $exists = $res->num_rows == 1 ? true : false;

    return $exists;
}

function getEventsForCategory(mysqli $mysqli, string $categoryId)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM events WHERE category_id = ?");
    $sqlQuery->bind_param(
        "i",
        $categoryId,
    );
    $sqlQuery->execute();
    $result = $sqlQuery->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    return $results;
}

if (getRequestMethod() === 'DELETE') {
    auth_user();

    parse_str(file_get_contents("php://input"), $_DELETE);
    $categoryId = (int)$_DELETE['id'];

    try {
        $mysqli = connectToDatabase();
        if (!doesCategoryExist($mysqli, $categoryId)) {
            send_response(404, 'Category does not exist.');
        }

        $eventsForCategory = getEventsForCategory($mysqli, $categoryId);
        $eventsCount = count($eventsForCategory);
        if ($eventsCount > 0) {
            send_response(400, 'Cannot remove category which have ' . $eventsCount . ' events. For example there is event with title: \'' . $eventsForCategory[0]['title'] . '\'.');
        }

        $result = deleteCategory($mysqli, $categoryId);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'Category deleted successfully.');
    } else {
        send_response(500, 'Failed to delete category.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
