<?php
class Config
{
    public static function DB_HOST()     { return self::get_env('DB_HOST', 'DB_HOST'); }
    public static function DB_PORT()     { return self::get_env('DB_PORT', 1234); }
    public static function DB_NAME()     { return self::get_env('DB_NAME', 'DB_NAME'); }
    public static function DB_USER()     { return self::get_env('DB_USER', 'DB_USER'); }
    public static function DB_PASSWORD() { return self::get_env('DB_PASSWORD', 'DB_PASSWORD'); }

    public static function get_env($name, $default)
    {
        $value = getenv($name);
        return ($value !== false && trim($value) !== '') ? $value : $default;
    }
}
?>