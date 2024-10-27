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
 * @param  integer $httpCode     HTTP response code
 * @param  boolean $responseMessage   If true, encode response
 */
// function send_response($httpCode, $responseMessage)
// {
//     $success = false;
//     if ($httpCode >= 200 && $httpCode < 300) {
//         $success = true;
//     }

//     $response = ['success' => $success, 'message' => $responseMessage];

//     http_response_code($httpCode);
//     die(json_encode($response));
// }

/**
 * Send an Json API response
 * @param  *       $response The API response
 * @param  integer $httpCode     HTTP response code
 * @param  boolean $responseMessage   If true, encode response
 */
function send_response($httpCode, $responseMessage, $result = null)
{
    $success = false;
    if ($httpCode >= 200 && $httpCode < 300) {
        $success = true;
    }

    $response = ['success' => $success, 'message' => $responseMessage, 'result' => $result];

    http_response_code($httpCode);
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
