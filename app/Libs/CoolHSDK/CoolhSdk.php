<?php


namespace App\Libs\CoolHSDK;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CoolhSdk
{
    protected $token;
    //可以为 Bot 或者Bearer
    private $type = 'Bot';
    private $language = 'zh-CN';
    private $baseUrl = 'https://www.kaiheila.cn/api/v3/';

    public function __construct(?string $token = null)
    {
        $this->token = $token ?? '1/MTA1OTQ=/4lSIn3OvJwYJmvEt2KOqwg==';
    }


    protected function get($path,$data)
    {
        $http = new Client([
            'base_uri' => $this->baseUrl,
            'headers'   =>  [
                'Authorization' => $this->type.' '.$this->token,
                'Accept-Language' => $this->language,
                'content-type'  =>  'application/json'
            ]
        ]);
        $res = $http->get($path, ['query' => $data]);
//            Log::channel('mylog')->info('|>>> SDK.get ' . oToJson(json_decode($res->getBody(),true)));
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
                'Authorization' => $this->type.' '.$this->token,
                'Accept-Language' => $this->language,
                'content-type'  =>  $type
            ]
        ]);
        $res = $http->post($path, $data);
//            Log::channel('mylog')->info('|>>> SDK.post ' . oToJson(json_decode($res->getBody(),true)));
        return json_decode($res->getBody(),true);
    }
}
