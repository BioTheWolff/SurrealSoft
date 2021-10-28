<?php declare(strict_types=1);

require_once('Path.php');

class Config
{

    /**
     * @var Config $instance
     */
    private static $instance;

    /**
     * @var array $config
     */
    private $config;

    /**
     * @return Config
     */
    public static function getInstance(): Config
    {
        if (is_null(self::$instance)) self::$instance = new Config();
        return self::$instance;
    }

    private function __construct()
    {
        $this->config = array_merge(Path::get(['config', 'config']), Path::get(['config', 'env']));
    }

    /**
     * Get a value from the config using its key
     *
     * @param string $key the key to get from the config
     * @param string|null $default the default value if the key doesn't exist
     * @return mixed|string|null the value, either the config or default value
     */
    public function get(string $key, string $default = null)
    {
        return array_key_exists($key, $this->config) ? $this->config[$key] : $default;
    }

}