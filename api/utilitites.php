<?php


/**
 * Get the API method
 * @return String The API method
 */
function getRequestMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Send an API response
 * @param  *       $response The API response
 * @param  integer $code     The response code
 * @param  boolean $encode   If true, encode response
 */
function send_response($response, $code)
{
    http_response_code($code);
    die(json_encode($response));
}

/**
 * Get data object from API data
 * @return Object The data object
 */
function get_request_data()
{
    return array_merge(empty($_POST) ? array() : $_POST, (array) json_decode(file_get_contents('php://input'), true), $_GET);
}
