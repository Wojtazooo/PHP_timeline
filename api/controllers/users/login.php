<?php
include_once '../../database/DatabaseConnection.php';
// include_once '../../models/User.php';
include_once '../../utilitites.php';

function loginUser(string $username, string $password)
{
    $mysqli = connectToDatabase();
    $sqlQuery = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $sqlQuery->bind_param(
        "s",
        $username,
    );

    $sqlQuery->execute();
    $result = $sqlQuery->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    } else {
        return false;
    }
}

if (getRequestMethod() === 'POST') {
    session_start();

    try {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $result = loginUser($username, $password);
    } catch (Throwable $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(201, 'Logged in successfully.');
    } else {
        send_response(400, 'Invalid username or password.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
