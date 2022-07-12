<?php


namespace App\Libs\CoolHSDK\SDK;


use App\Libs\CoolHSDK\CoolhSdk;

class assetSdk extends CoolhSdk
{
    /**
     * 上传媒体文件
     * 上传媒体文件
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/asset/create    POST    Header 中 Content-Type 必须为 form-data
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » file    body    string(binary)    false    目前支持 图片, 视频(.mp4 .mov), 文件
     * @param array $params
     * @param null $type
     * @return mixed
     */
    public function create(array $params, $type = null)
    {
        return $this->post('asset/create', $params, $type);
    }
}
