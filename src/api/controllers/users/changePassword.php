<?php
include_once '../../database/DatabaseConnection.php';
include_once '../../utilitites.php';

function updateUserPassword(mysqli $mysqli, string $userId, string $password_hash)
{
    $sqlQuery = $mysqli->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $sqlQuery = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");

    $sqlQuery->bind_param(
        "ss",
        $password_hash,
        $userId
    );


    if ($sqlQuery->execute()) {
        return true;
    } else {
        return false;
    }
}

function doesUserAlreadyExist(mysqli $mysqli, string $username)
{
    $sqlQuery = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $sqlQuery->bind_param(
        "s",
        $username,
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
        $password = $_PUT['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $mysqli = connectToDatabase();
        $userId = $_SESSION['user_id'];

        $result = updateUserPassword($mysqli, $userId, $passwordHash);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(200, 'Changed password successfully.');
    } else {
        send_response(500, 'Failed to change password.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
