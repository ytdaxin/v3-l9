<?php

namespace App\Libs\TgSDK\SDK;

use App\Libs\TgSDK\TgSdk;

class TelegramFunSdk extends TgSdk
{
    public function getUpdates(?array $params = null)
    {
        return $this->get('getUpdates', $params);
    }

    public function setWebhook(?array $params = null, ?string $type = null)
    {
        return $this->post('setWebhook', $params, $type);
    }

    public function deleteWebhook(?array $params = null, ?string $type = null)
    {
        return $this->get('deleteWebhook', $params, $type);
    }

    public function getWebhookInfo(?array $params = null)
    {
        return $this->get('getWebhookInfo',$params);
    }

    public function getMe(?array $params = null)
    {
        return $this->get('getMe', $params);
    }

    public function getChat(?array $params = null, ?string $type = null)
    {
        return $this->post('getChat', $params, $type);
    }

    public function sendMessage(?array $params = null, ?string $type = null)
    {
        return $this->post('sendMessage', $params, $type);
    }

    public function setMyCommands(?array $params = null, ?string $type = null)
    {
        return $this->post('setMyCommands', $params, $type);
    }

    public function getMyCommands(?array $params = null)
    {
        return $this->get('getMyCommands', $params);
    }
}
