<?php

/**
 * Ensures that the user possesses the right permission.
 * Throws an HTTP 403 if not.
 *
 * Example:
 * `ensure_user_permission('is_connected')`
 *
 * Explanation:
 * The `$session_callable` is the Session method called: i.e. `'is_connected'` will call `Session::is_connected()`
 *
 * @param string $session_callable the function to call in the Session class
 * @param array|null $args the arguments to the function
 */
function ensure_user_permission(string $session_callable, array $args = null)
{
    if(!call_user_func("Session::$session_callable", $args)) http_403();
}


/**
 * Generates a HTTP 403 request
 */
function http_403()
{
    ErrorController::http_403();
    exit(0);
}