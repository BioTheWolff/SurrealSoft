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
 * Redirects to a certain path
 *
 * @param string|null $controller the controller to redirect to
 * @param string|null $action the action to redirect to
 * @param array|null $args the optional arguments to add
 */
function redirect(string $controller = null, string $action = null, array $args = null)
{
    $location = get_path_fragment($controller, $action, $args);
    header("Location: ./$location");
    exit(0);
}

/**
 * Alias to the get_path_fragment function
 *
 * @see get_path_fragment()
 */
function loc(string $controller = null, string $action = null, array $extra = null): string
{
    return get_path_fragment($controller, $action, $extra);
}

/**
 * @param string|null $controller the controller
 * @param string|null $action the action
 * @param array|null $extra the optional arguments to add
 * @return string
 */
function get_path_fragment(string $controller = null, string $action = null, array $extra = null): string
{
    $s = "?";

    // controller & action
    if (!is_null($controller) && !is_null($action)) $s .= "controller=$controller&action=$action";
    else if (!is_null($controller)) $s .= "controller=$controller";
    else if (!is_null($action)) $s .= "action=$action";
    else $s = "";

    // extra arguments, if any
    if (!is_null($extra))
    {
        foreach ($extra as $k => $v)
        {
            $s .= "&$k=$v";
        }
    }

    // if nothing was provided
    if ($s === "?") $s = "";

    return $s;
}