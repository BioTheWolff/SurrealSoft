<?php declare(strict_types=1);


class Path
{
    const DS = DIRECTORY_SEPARATOR;
    const APP_DIR = __DIR__ . self::DS . '..' . self::DS;
    const ROOT_DIR = self::APP_DIR . '..' . self::DS;

    /**
     * Returns the path to a file in the project directory
     *
     * @param array $path the path to the file
     * @return string the built path
     */
    public static function get(array $path): string
    {
        return self::ROOT_DIR . implode(self::DS, $path) . ".php";
    }

    /**
     * Returns the path to a file in the App directory
     *
     * @param array $path the path to the App file
     * @return string the built path
     */
    public static function getapp(array $path): string
    {
        return self::APP_DIR . implode(self::DS, $path) . ".php";
    }

    /**
     * Builds the path to a model
     *
     * @param array $path the model's filename (+ dir(s) if needed)
     * @return string the built path to the model
     */
    public static function model(array $path): string
    {
        array_unshift($path, 'model');
        return self::getapp($path);
    }

    /**
     * Builds the path to a controller
     *
     * @param array $path the controller's filename (+ dir(s) if needed)
     * @return string the built path to the controller
     */
    public static function controller(array $path): string
    {
        array_unshift($path, 'controller');
        return self::getapp($path);
    }

    /**
     * Builds the path to a view component (or main display)
     *
     * @param array $path the view's filename
     * @param bool $is_content if the requested view is a content and not a template. default = TRUE
     * @return string the built path to the view
     */
    public static function view(array $path, bool $is_content = true): string
    {
        if ($is_content) array_unshift($path, 'content');
        array_unshift($path, 'view');
        return self::getapp($path);
    }

}