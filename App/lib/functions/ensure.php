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
 * Ensures that the form is full, and acts against it if
 *
 * @param array $expected_keys the keys to expect in the form
 * @param array $form the form values
 * @param string $view_path the path to the displayed webpage if the form is not full
 * @param string $view_title the name of the webpage displayed if the form is not full
 */
function ensure_form_full(array $expected_keys, array $form, string $controller_name, string $view_path, string $view_title)
{
    foreach ($expected_keys as $key)
    {
        // if a field is not found or is empty
        if (!array_key_exists($key, $form) || empty($form[$key]))
        {
            // we re-display the webpage with filled-in values
            RenderEngine::_render($controller_name, $view_path, $view_title, $form);
            exit(0); // we then exit to block further execution
        }
    }
}