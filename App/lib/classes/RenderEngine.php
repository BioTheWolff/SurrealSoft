<?php

class RenderEngine
{
    /**
     * Loads the view and sets up the required variables
     * Allows nice calling to a complex view building
     *
     * @param string $controller_name the name of the current controller we are in
     * @param string $page_path the path to the page inside its controller name's folder
     * @param string $page_title the title of the page. Will be prefixed by the sites' title
     * @param array|null $extra extra variables to set up. Will be available in the view under `$rvar_extra_NAME`
     */
    public static function render(string $controller_name, string $page_path, string $page_title, array $extra = null)
    {
        $rvar_page_title = Config::getInstance()->get("site.name", "SurrealSoft") . " | " . $page_title;
        $rvar_load_content = $controller_name . DIRECTORY_SEPARATOR . $page_path;

        if(!is_null($extra))
        {
            foreach ($extra as $k => $v)
            {
                $_name = "rvar_extra_" . $k;
                $$_name = $v;
            }
        }

        require_once Path::view('view', false);
    }

    /**
     * Uses complex things to find the controller name and route view.
     *
     * DO NOT CALL FROM SOMETHING ELSE THAN A CONTROLLER!
     *
     * @param null $extra
     * @param bool $comes_from_ensuring
     */
    public static function smart_render($extra = null, bool $comes_from_ensuring = false)
    {
        // Complex things you don't need to know about
        $limit = $comes_from_ensuring ? 3 : 2;
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $limit)[$limit-1];
        $class = $trace['class'];
        $caller = $trace['function'];

        $controller_name = $class::get_cn();
        $page_info = $class::get_route_view($caller);

        // It just works, believe me
        self::render($controller_name, $page_info[0], $page_info[1], $extra);
    }


    /**
     * Simple alias for the exit function
     */
    public static function end()
    {
        exit(0);
    }
}