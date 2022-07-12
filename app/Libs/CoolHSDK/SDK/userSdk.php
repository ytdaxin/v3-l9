<?php
/**
 * 用户相关接口列表
 * 本文档主要列出用户相关接口。
 *
 * 本文档中的接口均符合接口规范，如有疑问，建议先查阅接口引言。
 *
 * 接口    接口说明    维护状态
 * /api/v3/user/me    获取当前用户信息    正常
 * /api/v3/user/view    获取目标用户信息    正常
 */

namespace App\Libs\CoolHSDK\SDK;

use App\Libs\CoolHSDK\CoolhSdk;

class userSdk extends CoolhSdk
{
    /**
     * 获取当前用户信息
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/user/me    GET    获取当前登录的用户的信息
     * @param array|null $params
     * @return mixed|null
     */
    public function me(?array $params = null)
    {
        return $this->get('user/me', $params);
    }

    /**
     * 获取目标用户信息
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/user/view    GET    获取当前登录的用户的信息
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * user_id    query    string    true    none
     * guild_id    query    string    false    服务器 id
     * @param array $params
     * @return mixed|null
     */
    public function view(array $params)
    {
        return $this->get('user/view', $params);
    }

    /**
     * 机器人下线
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/user/offline    GET    机器人下线
     * @param array|null $params
     * @return mixed|null
     */
    public function offline(?array $params = null)
    {
        return $this->get('user/offline', $params);
    }
}
