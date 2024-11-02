<?php

include_once '../../utilitites.php';

if (getRequestMethod() === 'GET') {

    session_start();

    $response = [
        'loggedIn' => isset($_SESSION['user_id']),
        'userId' => $_SESSION['user_id'] ?? null
    ];

    try {
        send_response(200, 'Ok', $response);
    } catch (Exception $e) {
        send_response(500, 'Failed to get categories.');
    }
} else {
    send_response(500, 'Invalid http request.');
}
