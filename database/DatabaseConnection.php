<?php

function connectToDatabase(): mysqli
{
    $host = 'localhost';
    $user = 'root';
    $password = 'admin';
    $dbname = 'eventsdb';

    $mysqli = new mysqli($host, $user, $password, $dbname);

    if ($mysqli->connect_error) {
        exit('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
    }

    return $mysqli;
}
