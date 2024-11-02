<?php

include_once '../../utilitites.php';

if (getRequestMethod() === 'POST') {
    session_start();

    try {
        session_start();
        session_unset();
        session_destroy();
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    if ($result) {
        send_response(201, 'Logged out successfully.');
    } else {
        send_response(400, 'Failed to log out.');
    }
} else {
    send_response(500, 'Invalid http request.');
}
