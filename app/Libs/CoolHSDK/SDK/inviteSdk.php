<?php
/**
 * 邀请相关接口
 * 本文档主要列出邀请相关的接口。
 * 本文档中的接口均符合接口规范，如有疑问，建议先查阅接口引言。
 *
 * 接口    接口说明    维护状态
 * /api/v3/invite/list    获取邀请列表    正常
 * /api/v3/invite/create    创建邀请链接    正常
 * /api/v3/invite/delete    删除邀请链接    正常
 */

namespace App\Libs\CoolHSDK\SDK;


use App\Libs\CoolHSDK\CoolhSdk;

class inviteSdk extends CoolhSdk
{
    /**
     * 获取邀请列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/invite/list    GET
     * 参数列表
     * 服务器 id 或者频道 id 必须填一个    参数名    位置    类型    必需    说明
     * guild_id    query    string    false    服务器 id
     * channel_id    query    string    false    频道 id
     * page    query    integer    false    目标页数
     * page_size    query    integer    false    每页数据数量
     * @param array|null $params
     * @return mixed
     */
    public function list(array $params = null)
    {
        return $this->get('invite/list', $params);
    }

    /**
     * 创建邀请链接
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/invite/create    POST
     * 参数列表
     * 服务器 id 或者频道 id 必须填一个    参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » guild_id    body    string    false    服务器 id
     * » channel_id    body    string    false    服务器频道 id
     * » duration    body    integer    false    邀请链接有效时长（秒），默认 7 天。可选值： 0 => 永不； 1800 => 0.5 小时； 3600 => 1 个小时； 21600 => 6 个小时； 43200 => 12 个小时； 86400 => 1 天； 604800 => 7 天
     * » setting_times    body    integer    false    设置的次数，默认-1。可选值： -1 => 无限制； 1 => 1 次使用； 5 => 5 次使用； 10 => 10 次使用 ；25 => 25 次使用； 50 => 50 次使用； 100 => 100 次使用
     * @param array|null $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->post('invite/create', $params);
    }

    /**
     * 删除邀请链接
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/invite/delete    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » url_code    body    string    true    邀请码
     * » guild_id    body    string    false    服务器 id
     * » channel_id    body    string    false    服务器频道 ID
     * @param array|null $params
     * @return mixed
     */
    public function delete(array $params)
    {
        return $this->post('invite/delete', $params);
    }
}
