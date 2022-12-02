<?php

namespace App\Libs\TgSDK;

use App\Libs\TgSDK\Facades\Facade;
use App\Libs\TgSDK\SDK\BotCommandSdk;
use App\Libs\TgSDK\SDK\ChatSdk;
use App\Libs\TgSDK\SDK\ForceReplySdk;
use App\Libs\TgSDK\SDK\InlineKeyboardButtonSdk;
use App\Libs\TgSDK\SDK\InlineKeyboardMarkupSdk;
use App\Libs\TgSDK\SDK\KeyboardButtonPollTypeSdk;
use App\Libs\TgSDK\SDK\KeyboardButtonSdk;
use App\Libs\TgSDK\SDK\MessageEntitySdk;
use App\Libs\TgSDK\SDK\MessageSdk;
use App\Libs\TgSDK\SDK\ReplyKeyboardMarkupSdk;
use App\Libs\TgSDK\SDK\ReplyKeyboardRemoveSdk;
use App\Libs\TgSDK\SDK\TelegramFunSdk;
use App\Libs\TgSDK\SDK\UpdateSdk;
use App\Libs\TgSDK\SDK\UserSdk;
use App\Libs\TgSDK\SDK\WebhookInfoSdk;

class Telegram extends Facade
{
    public static function Update(?string $token = null): UpdateSdk
    {
        // TODO: Change the autogenerated stub
        return new UpdateSdk($token);
    }
    public static function User(?string $token = null): UserSdk
    {
        // TODO: Change the autogenerated stub
        return new UserSdk($token);
    }
    public static function Chat(?string $token = null): ChatSdk
    {
        // TODO: Change the autogenerated stub
        return new ChatSdk($token);
    }
    public static function Message(?string $token = null): MessageSdk
    {
        // TODO: Change the autogenerated stub
        return new MessageSdk($token);
    }
    public static function MessageEntity(?string $token = null): MessageEntitySdk
    {
        // TODO: Change the autogenerated stub
        return new MessageEntitySdk($token);
    }
    public static function BotCommand(?string $token = null): BotCommandSdk
    {
        // TODO: Change the autogenerated stub
        return new BotCommandSdk($token);
    }
    public static function WebhookInfo(?string $token = null): WebhookInfoSdk
    {
        // TODO: Change the autogenerated stub
        return new WebhookInfoSdk($token);
    }
    public static function ReplyKeyboardMarkup(?string $token = null): ReplyKeyboardMarkupSdk
    {
        // TODO: Change the autogenerated stub
        return new ReplyKeyboardMarkupSdk($token);
    }
    public static function KeyboardButton(?string $token = null): KeyboardButtonSdk
    {
        // TODO: Change the autogenerated stub
        return new KeyboardButtonSdk($token);
    }
    public static function KeyboardButtonPollType(?string $token = null): KeyboardButtonPollTypeSdk
    {
        // TODO: Change the autogenerated stub
        return new KeyboardButtonPollTypeSdk($token);
    }
    public static function ReplyKeyboardRemove(?string $token = null): ReplyKeyboardRemoveSdk
    {
        // TODO: Change the autogenerated stub
        return new ReplyKeyboardRemoveSdk($token);
    }
    public static function InlineKeyboardMarkup(?string $token = null): InlineKeyboardMarkupSdk
    {
        // TODO: Change the autogenerated stub
        return new InlineKeyboardMarkupSdk($token);
    }
    public static function InlineKeyboardButton(?string $token = null): InlineKeyboardButtonSdk
    {
        // TODO: Change the autogenerated stub
        return new InlineKeyboardButtonSdk($token);
    }
    public static function ForceReply(?string $token = null): ForceReplySdk
    {
        // TODO: Change the autogenerated stub
        return new ForceReplySdk($token);
    }
    public static function TelegramFun(?string $token = null): TelegramFunSdk
    {
        // TODO: Change the autogenerated stub
        return new TelegramFunSdk($token);
    }
}