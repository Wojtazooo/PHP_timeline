<?php

include_once '../../utilitites.php';

if (getRequestMethod() === 'POST') {
    try {
        session_start();
        session_unset();
        session_destroy();
    } catch (Exception $e) {
        send_response(500, $e->getMessage());
    }

    send_response(200, 'Logged out successfully.');
} else {
    send_response(405, 'Method not allowed.');
}
