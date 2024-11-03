<?php

include_once '../../utilitites.php';

if (getRequestMethod() === 'GET') {
    session_start();

    try {
        $response = [
            'loggedIn' => isset($_SESSION['user_id']),
            'userId' => $_SESSION['user_id'] ?? null
        ];

        send_response(200, 'Ok', $response);
    } catch (Throwable $e) {
        send_response(500, 'Failed to get categories.');
    }
} else {
    send_response(405, 'Method not allowed.');
}
