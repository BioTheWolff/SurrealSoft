<?php

/**
 * @see htmlspecialchars()
 * @param string $s the string to escape
 * @return string
 */
function e(string $s): string
{
    return htmlspecialchars($s);
}

/**
 * @see htmlspecialchars_decode()
 * @param string $s the string to un-escape
 * @return string
 */
function d(string $s): string
{
    return htmlspecialchars_decode($s);
}


/**
 * @see rawurlencode()
 * @param string $s the url to encode
 * @return string
 */
function re(string $s): string
{
    return rawurlencode($s);
}

/**
 * @see rawurldecode()
 * @param string $s the url to decode
 * @return string
 */
function rd(string $s): string
{
    return rawurldecode($s);
}


/**
 * Generates a HTTP 403 request
 */
function http_403()
{
    ErrorController::http_403();
    exit(0);
}