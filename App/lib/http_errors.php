<?php


/**
 * Generates a HTTP 403 request
 */
function http_403()
{
    ErrorController::http_403();
    exit(0);
}