<?php


namespace App\Libs\TgSDK\Facades;


abstract class Facade
{

    public static function __callStatic($name, $args)
    {
        $instance = static::getInstance();
        if (! $instance) {
            throw new \Exception('A facade root has not been set.');
        }
        return $instance->$name(...$args);
    }
}
