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
        $this->config = array_merge(
            require(Path::get(['config', 'config'])),
            require(Path::get(['config', 'env']))
        );
    }

    /**
     * Get a value from the config using its key
     *
     * @param string $key the key to get from the config
     * @param mixed|null $default the default value if the key doesn't exist
     * @return mixed|string|null the value, either the config or default value
     */
    public function get(string $key, $default = null)
    {
        return array_key_exists($key, $this->config) ? $this->config[$key] : $default;
    }

    /**
     * Get values from the config using array items and returns an array of corresponding values
     *
     * @param array $keys the array of keys to get from the config
     * @param mixed|null $default the default value for each key that doesn't exist in config
     * @return array the array of values built from the requested keys
     */
    public function getm(array $keys, $default = null): array
    {
        $values = [];
        foreach ($keys as $e) $values[] = $this->get($e, $default);
        return $values;
    }

}