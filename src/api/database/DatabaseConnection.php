<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function connectToDatabase(): mysqli
{
    $host = getenv('DB_HOST') ?: 'localhost';
    $user = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: 'admin';
    $dbname = getenv('DB_DATABASE') ?: 'eventsdb';

    $mysqli = new mysqli($host, $user, $password, $dbname);

    if ($mysqli->connect_error) {
        throw new Exception('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
    }

    return $mysqli;
}
