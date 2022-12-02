<?php


namespace App\Libs\TgSDK\Facades;


abstract class Facade
{
    public static function Update(?string $token = null){}
    public static function User(?string $token = null){}
    public static function Chat(?string $token = null){}
    public static function Message(?string $token = null){}
    public static function MessageEntity(?string $token = null){}
    public static function BotCommand(?string $token = null){}
    public static function WebhookInfo(?string $token = null){}
    public static function ReplyKeyboardMarkup(?string $token = null){}
    public static function KeyboardButton(?string $token = null){}
    public static function KeyboardButtonPollType(?string $token = null){}
    public static function ReplyKeyboardRemove(?string $token = null){}
    public static function InlineKeyboardMarkup(?string $token = null){}
    public static function InlineKeyboardButton(?string $token = null){}
    public static function ForceReply(?string $token = null){}
    public static function TelegramFun(?string $token = null){}

    public static function __callStatic($name, $args)
    {
        $instance = static::getInstance();
        if (! $instance) {
            throw new \Exception('A facade root has not been set.');
        }
        return $instance->$name(...$args);
    }
}
