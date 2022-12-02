<?php

namespace App\Libs\TgSDK;

use GuzzleHttp\Client;

class TgSdk
{
    protected string $token;
    protected string $baseUrl;

    public function __construct(?string $token = null)
    {
        $this->token = $token ?? '1/MTA1OTQ=/4lSIn3OvJwYJmvEt2KOqwg==';
    }

    protected function get($path,$data)
    {
        $http = new Client([
            'base_uri' => $this->baseUrl,
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ]
        ]);
        $res = $http->get($path, ['query' => $data]);
        return json_decode($res->getBody(),true);
    }

    protected function post($path,$data,$type = null)
    {

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
            ]
        ]);
        $res = $http->post($path, $data);
        return json_decode($res->getBody(),true);
    }
}
