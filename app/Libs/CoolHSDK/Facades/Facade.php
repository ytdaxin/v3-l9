<?php


namespace App\Libs\CoolHSDK\Facades;


abstract class Facade
{
    public static function getUser(?string $token = null){}
    public static function getMessage(?string $token = null){}
    public static function getGuildRole(?string $token = null){}
    public static function getDirectMessage(?string $token = null){}
    public static function getGuild(?string $token = null){}
    public static function getInvite(?string $token = null){}
    public static function getAsset(?string $token = null){}

    public static function __callStatic($name, $args)
    {
        $instance = static::getInstance();
        if (! $instance) {
            throw new \Exception('A facade root has not been set.');
        }
        return $instance->$name(...$args);
    }
}
