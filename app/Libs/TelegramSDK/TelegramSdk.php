<?php

namespace App\Libs\TelegramSDK;

use GuzzleHttp\Client;

class TelegramSdk
{
    protected string $token;
    protected string $baseUrl;

    public function __construct(?string $token = null)
    {
        $this->token = $token ?? '1/MTE0NjY=/Kv9uWvWW2HsjTLu+qzv24w==';
    }

    protected function get($path = null, $data = null){
        if (!$path){
            $path = '';
        }
        $http = new Client([
            'base_uri' => $this->baseUrl,
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ],
            'verify' => false
        ]);

        $res = $http->get($path, ['query' => $data]);
        return json_decode($res->getBody(),true);
    }

    protected function post($path = null,$data = null,$type = null){
        if (!$path){
            $path = '';
        }
        if (!$type){
            $type = 'application/json';
            $data = ['form_params' => $data];
        }
        if ($type == 'multipart/form-data'){
            $data = ['multipart' => $data];
        }
        $http = new Client([
            'base_uri' => $this->baseUrl,
            'headers'   =>  [
                'content-type'  =>  $type
            ],
            'verify' => false
        ]);
        $res = $http->post($path, $data);
        return json_decode($res->getBody(),true);
    }
}
