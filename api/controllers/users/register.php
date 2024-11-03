<?php
include_once '../../database/DatabaseConnection.php';
// include_once '../../models/User.php';
include_once '../../utilitites.php';

function registerUser(mysqli $mysqli, string $username, string $password_hash)
{
    $sqlQuery = $mysqli->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");

    $sqlQuery->bind_param(
        "ss",
        $username,
        $password_hash
    );


    if ($sqlQuery->execute()) {
        $id = mysqli_insert_id($mysqli);
        $_SESSION['user_id'] = $id;
        return $sqlQuery->insert_id;
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

if (getRequestMethod() === 'POST') {
    session_start();

    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $mysqli = connectToDatabase();

        if (doesUserAlreadyExist($mysqli, $username)) {
            send_response(400, 'User with given username already exists!');
        };

        $result = registerUser($mysqli, $username, $passwordHash);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(201, 'Registered successfully.');
    } else {
        send_response(500, 'Failed to register user.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
