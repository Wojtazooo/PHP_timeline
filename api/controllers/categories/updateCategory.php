<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../utilitites.php';

function updateCategory(mysqli $mysqli, int $id, string $name, string $color)
{
    error_log('1');
    $sqlQuery = $mysqli->prepare("UPDATE categories SET name = ?, color = ? WHERE id = ?");

    $sqlQuery->bind_param("ssi", $name, $color, $id);

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

function doesCategoryWithTheSameNameAlreadyExist(mysqli $mysqli, int $categoryId, string $categoryName)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM categories WHERE name = ? and id != ?");
    $sqlQuery->bind_param(
        "si",
        $categoryName,
        $categoryId
    );
    $sqlQuery->execute();
    $res = $sqlQuery->get_result();
    $exists = $res->num_rows == 1 ? true : false;

    return $exists;
}

if (getRequestMethod() === 'PUT') {
    auth_user();

    parse_str(file_get_contents("php://input"), $_PUT);

    $categoryId = (int)$_PUT['id'];
    $categoryName = $_PUT['name'];
    $categoryColor = $_PUT['color'];


    try {
        $mysqli = connectToDatabase();

        if (!doesCategoryExist($mysqli, $categoryId)) {
            send_response(404, 'Category does not exist.');
        }

        if (doesCategoryWithTheSameNameAlreadyExist($mysqli, $categoryId, $categoryName)) {
            send_response(400, 'Category with name \'' . $categoryName . '\' already exists.');
        }

        $result = updateCategory($mysqli, $categoryId, $categoryName, $categoryColor);
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'Category updated successfully.');
    } else {
        send_response(500, 'Failed to update category.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
