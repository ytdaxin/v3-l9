<?php

namespace App\Libs\TgSDK\SDK;

use App\Libs\TgSDK\TgSdk;

class TelegramFunSdk extends TgSdk
{
    public function getUpdates(?array $params = null)
    {
        $this->get('getUpdates',$params);
    }

    public function setWebhook()
    {

    }

    public function deleteWebhook()
    {

    }

    public function getWebhookInfo()
    {

    }

    public function getMe()
    {

    }

    public function getChat()
    {

    }

    public function sendMessage()
    {

    }

    public function setMyCommands()
    {

    }

    public function getMyCommands()
    {

    }
}
