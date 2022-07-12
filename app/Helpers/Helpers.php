<?php
/**
 *  构造公用函数
 */

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (! function_exists('F')){
    function F($val){
        switch ($val){
            case 'con':
                $Com = app('\App\Http\Controllers\Controller');
                return $Com;
                break;
            case 'Arr':
                $Com = app('Illuminate\Support\Arr');
                return $Com;
                break;
            case 'Str':
                $Com = app('Illuminate\Support\Str');
                return $Com;
                break;
            default:
        }
    }
}

if (! function_exists('R')) {
    /**
     * 非装 Redis 实例化
     * @param null $name [数据库名称]
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function R($name=null)
    {
        if ($name){
            return app('redis')->connection($name);
        }else return app('redis.connection');
    }
}

if (! function_exists('se')){
    /**
     * 封装序列化数组
     * @param $data [序列化值]
     * @return string
     */
    function se($data): string
    {

        return serialize($data);
    }
}

if (!function_exists('un')){
    /**
     * 封装反序列化数组
     * @param $data [反序列化值]
     * @return mixed
     */
    function un($data): mixed
    {
        return unserialize($data);
    }
}

if (! function_exists('Fill')){
    /**
     * 返回失败
     * @param string $code
     * @param string $data
     * @param array $headers
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function Fill($code = '200', $data = '', $headers = [], $status = 200){
        $status= isset($status) ? $status : 200;

        $arr = [
            'status'    =>  false,
            'code'  => -1,
            'msg'   => config('code.'.$code),
            'codeNum'   => $code,
        ];
        if (!empty($data)) {
            $arr['data'] = $data;
        }
        return response()->json($arr,$status,$headers);
    }
}

if (! function_exists('Out')){
    /**
     * 返回成功
     * @param string $data
     * @param int $code
     * @param string $count
     * @param array $headers
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    function Out($data = '', $code = 200, $count = '0', $headers = [], $status = 200){
        $status= isset($status) ? $status : 200;
        $arr = [
            'status'    =>  true,
            'code'  => 0,
            'msg'   => config('code.'.$code),
            'codeNum'   => $code,
        ];
        if (!empty($data)) {
            $isExtend = isset($data['extend']) ? $data['extend'] : null;
            $data = isset($data['data']) ? $data['data'] : $data;
            if (!empty($isExtend)) {
                $arr['extend'] = $isExtend;
            }
            $data = isset($data['data']) ? $data['data'] : $data;
            $arr['data'] = $data;
            $arr['count'] = $count;
        }
        return response()->json($arr,$status,$headers);
    }
}
if (! function_exists('F_time')){
    /**
     * 取时间
     * @param string $format
     * @param int $time
     * @return false|string
     */
    function F_time($format = 'A', $time = 0){
        switch ($format){
            case 'D':
                if ($time > 0){
                    return date('Y-m-d',$time);
                }
                return date('Y-m-d');
                break;
            case 'H':
                if ($time > 0){
                    return date('H:i:s',$time);
                }
                return date('H:i:s');
                break;
            case 'Z':
                return date("Y-m-d",strtotime("-1 day"));
                break;
            case 'M':
                return date("Y-m-d",strtotime("+1 day"));
                break;
            default:
                if ($time > 0){
                    return date('Y-m-d H:i:s',$time);
                }
                return date('Y-m-d H:i:s');
                break;
        }
    }
}

if (! function_exists('F_times')){
    /**
     * 时间字符串转时间戳
     * @param $stamp
     * @return false|int
     */
    function F_times($stamp){
        return strtotime($stamp);
    }
}

if (! function_exists('rand_code')){

}

if (! function_exists('getTime')){
    /**
     * 返回时间段的日期、时间戳
     * @param string $type  时间类型
     * @param array $map  ['pm'=>'-', 'n'=>1] pm:表示正或负， n:表示天数
     * @param boolean $slot true返回时间段，否当天时间
     * @return void
     */
    function getTime($type = "", $map = ['pm'=>'-', 'n'=>1], $slot = false)
    {
        switch ($type) {
            case 'day':  //昨天、明天、近七天、近一个月、近半年、近一年...
                $n = $map['n'] ? : 1;
                if($map['pm'] == '+') {
                    $date = date("Y-m-d", strtotime("+{$n} day"));
                    if($slot) {
                        $start_time = time();
                        $end_time = strtotime("+{$n} day");
                    }else {
                        $start_time = strtotime($date);
                        $end_time = $start_time + + 60 * 60 * 24 - 1;
                    }
                }else {
                    $date = date("Y-m-d", strtotime("-{$n} day"));
                    $start_time = strtotime($date);
                    $end_time = $slot ? time() : ($start_time + 60 * 60 * 24 - 1);
                }
                $arr = [
                    'start_time' => $start_time,
                    'start_date' => date("Y-m-d H:i:s", $start_time),
                    'end_time' => $end_time,
                    'end_date' => date("Y-m-d H:i:s", $end_time),
                ];
                break;
            default: //今日
                $start_time = strtotime(date("Y-m-d", time()));
                $end_time = $start_time + 60 * 60 * 24 - 1;
                $arr = [
                    'start_time' => $start_time,
                    'start_date' => date("Y-m-d H:i:s", $start_time),
                    'end_time' => $end_time,
                    'end_date' => date("Y-m-d H:i:s", $end_time),
                ];
                break;
        }
        return $arr;
    }
}

if (! function_exists('time_tran')){
    /**
     * 根据时间戳转年月日
     * @param $time 时间戳
     * @return string
     */
    function time_tran($time)
    {
        $t = time() - $time;
        if($t <= 0) return '刚刚';
        $f = [
            '31536000' => '年',
            '2592000' => '个月',
            '604800' => '星期',
            '86400' => '天',
            '3600' => '小时',
            '60' => '分钟',
            '1' => '秒'
        ];
        foreach ($f as $k => $v) {
            if (0 != $c = floor($t / (int)$k)) {
                return $c . $v . '前';
            }
        }
    }
}

if (! function_exists('is_mobile'))
{
    /**
     * 验证手机号
     * @param $Mobile [手机号]
     * @return bool
     */
    function is_mobile($mobile)
    {
        return preg_match('/^1[345789]\d{9}$/',$mobile) ? true : false;
    }
}

if (! function_exists('trimAll'))
{
    /**
     * 删除所有的空格
     * @param $str
     * @return array|string|string[]
     */
    function trimAll($string){
        if (!$string == false){
            //去除中文半角,全角空格
            $string = preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",$string);
            //去除其他空格，换行
            $string = str_replace([" ","　","\t","\n","\r"],["","","","",""],$string);
        }
        return $string;
    }
}

if (!function_exists('check_idcard')) {
    function check_idcard($idCard)
    {
        $idCard = (string) $idCard;
        $pattern = '/(?:^\d{15}$)|(?:^\d{18}$)|^\d{17}[\dXx]$/';
        if (!preg_match($pattern, $idCard)) {
            return false;
        }
        if (strlen($idCard) == 18) {
            $idCardWi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);//将前17位加权因子保存在数组里
            $idCardY = array(1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2); //这是除以11后，可能产生的11位余数、验证码，也保存成数组
            $idCardWiSum = 0; //用来保存前17位各自乖以加权因子后的总和
            for ($i = 0; $i < 17; $i ++) {
                $idCardWiSum += substr($idCard, $i, 1) * $idCardWi[$i];
            }

            $idCardMod = $idCardWiSum % 11;        //计算出校验码所在数组的位置
            $idCardLast = substr($idCard, 17, 1);    //得到最后一位身份证号码

            //如果等于2，则说明校验码是10，身份证号码最后一位应该是X
            if ($idCardMod == 2) {
                if ($idCardLast == "X" || $idCardLast == "x") {
                    return true;
                } else {
                    return false;
                }
            } else {

                //用计算出的验证码与最后一位身份证号码匹配，如果一致，说明通过，否则是无效的身份证号码
                if ($idCardLast == $idCardY[$idCardMod]) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}

if (! function_exists('get_uuid')){
    /**
     * 获取UUID
     * @return string
     */
    function get_uuid()
    {
        $uuid = \Illuminate\Support\Str::uuid ();
        if ($uuid instanceof \Ramsey\Uuid\UuidInterface) {
            return $uuid->toString ();
        } else {
            $str  = md5 (uniqid (mt_rand (), true));
            $uuid = substr ($str, 0, 8) . '-';
            $uuid .= substr ($str, 8, 4) . '-';
            $uuid .= substr ($str, 12, 4) . '-';
            $uuid .= substr ($str, 16, 4) . '-';
            $uuid .= substr ($str, 20, 12);
            return $uuid;
        }
    }
}

if (! function_exists('human_filesize')){
    /**
     * 返回可读性更好的文件尺寸
     * @param string $bytes  原字符串
     * @param int    $decimals  保留长度
     * @return string
     */
    function human_filesize(string $bytes, $decimals = 2){
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).@$size[$factor];
    }
}

if (! function_exists('getHttp')){
    /**
     * get 请求方式
     * @param $baseUri          //网站地址
     * @param $path             //路由地址
     * @param $params           //提交参数
     * @param array $headers    //协议头
     * @return mixed
     * @throws GuzzleException
     */
    function getHttp($baseUri, $path, $params, array $headers = [
        'Accept-Language' => 'zh-CN',
        'content-type'  =>  'application/json'
    ]){
        $http = new \GuzzleHttp\Client([
            'base_uri' => $baseUri,
            'headers'   =>  $headers
        ]);
        try {
            $res = $http->get($path, ['query' => $params]);
            return json_decode($res->getBody(),true);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }

    }
}

if (! function_exists('postHttp')){
    /**
     * post 请求方式
     * @param $baseUri          //网站地址
     * @param $path             //路由地址
     * @param $params           //提交参数
     * @param array $headers    //协议头
     * @param $type             //协议类型
     * @return mixed
     * @throws GuzzleException
     */
    function postHttp($baseUri, $path, $params, array $headers = [
        'Accept-Language' => 'zh-CN',
    ], $type = null){
        if (!$type){
            $headers['content-type'] = 'application/json';
        }else{
            $headers['content-type'] = $type;
        }
        $params = ['form_params' => $params];
        if ($type == 'form-data'){
            $headers['content-type'] = 'multipart/form-data';
            $params = ['multipart' => $params];
        }
        $http = new \GuzzleHttp\Client([
            'base_uri' => $baseUri,
            'headers'   =>  $headers
        ]);
        try {
            $res = $http->post($path, $params);
            return json_decode($res->getBody(),true);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }

    }
}

if (! function_exists('oToJson')){
    /**
     * 数组转原JSON（非转义格式）
     * @param $array
     * @return false|string
     */
    function oToJson($array){
        return json_encode($array,JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);
    }
}

if (! function_exists('setEnv')){
    /**
     * 动态修改evn
     * @param array $envArr
     * @return void
     */
    function setEnv(array $envArr){
        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        foreach ($envArr as $k=>$v){
            $contentArray->transform(function ($item) use ($k,$v){
                $info = explode('=',$item);
                if (Str::contains($info[0], $k)){
                    return $k . '=' . $v;
                }
                return $item;
            });
        }
        $content = implode( PHP_EOL,$contentArray->toArray());
        File::put($envPath,$content);
    }
}

if (! function_exists('is_se')){
    /**
     * 判断是否序列化
     * @param $data
     * @return bool
     */
    function is_se($data): bool
    {
        $data = trim($data);
        if ('N;' === $data)
            return true;
        if (!preg_match('/^([adObis]):/', $data, $basins))
            return false;
        switch ($basins[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$basins[1]}:[0-9]+:.*[;}]\$/s", $data)) {
                    return true;
                }
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$basins[1]}:[0-9.E-]+;\$/", $data)) {
                    return true;
                }
                break;
        }
        return false;
    }
}
