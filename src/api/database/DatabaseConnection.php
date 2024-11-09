<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function connectToDatabase(): mysqli
{
    $host = 'localhost';
    $user = 'root';
    $password = 'admin';
    $dbname = 'eventsdb';

    $mysqli = new mysqli($host, $user, $password, $dbname);

    if ($mysqli->connect_error) {
        throw new Exception('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
    }

    return $mysqli;
}
