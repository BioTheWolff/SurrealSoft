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
}