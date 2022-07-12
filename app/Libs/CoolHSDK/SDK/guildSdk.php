<?php
/**
 * 服务器相关接口列表
 * 本文档主要列出服务器相关接口。
 *
 * 本文档中的接口均符合接口规范，如有疑问，建议先查阅接口引言。
 *
 * 接口    接口说明    维护状态
 * /api/v3/guild/list    获取当前用户加入的服务器列表    正常
 * /api/v3/guild/view    获取服务器详情    正常
 * /api/v3/guild/user-list    获取服务器中的用户列表    正常
 * /api/v3/guild/nickname    修改服务器中用户的昵称    正常
 * /api/v3/guild/leave    离开服务器    正常
 * /api/v3/guild/kickout    踢出服务器    正常
 * /api/v3/guild-mute/list    服务器静音闭麦列表    正常
 * /api/v3/guild-mute/create    添加服务器静音或闭麦    正常
 * /api/v3/guild-mute/delete    删除服务器静音或闭麦    正常
 */

namespace App\Libs\CoolHSDK\SDK;


use App\Libs\CoolHSDK\CoolhSdk;

class guildSdk extends CoolhSdk
{
    /**
     * 获取当前用户加入的服务器列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/list    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * page    query    integer    false    目标页数
     * page_size    query    integer    false    每页数据数量
     * sort    query    string    false    代表排序的字段, 比如-id 代表 id 按 DESC 排序，id 代表 id 按 ASC 排序。不一定有, 如果有，接口中会声明支持的排序字段。
     * @param array|null $params
     * @return mixed
     */
    public function list(array $params = null)
    {
        return $this->get('guild/list', $params);
    }

    /**
     * 获取服务器详情
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/view    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * guild_id    query    string    true    服务器 id
     * @param array $params
     * @return mixed
     */
    public function view(array $params)
    {
        return $this->get('guild/view', $params);
    }

    /**
     * 获取服务器中的用户列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/user-list    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * guild_id    query    string    true    服务器 id
     * channel_id    query    string    false    频道 id
     * search    query    string    false    搜索关键字，在用户名或昵称中搜索
     * role_id    query    integer    false    角色 ID，获取特定角色的用户列表
     * mobile_verified    query    integer    false    只能为0或1，0是未认证，1是已认证
     * active_time    query    integer    false    根据活跃时间排序，0是顺序排列，1是倒序排列
     * joined_at    query    integer    false    根据加入时间排序，0是顺序排列，1是倒序排列
     * page    query    integer    false    目标页数
     * page_size    query    integer    false    每页数据数量
     * filter_user_id    query    string    false    获取指定 id 所属用户的信息
     * 枚举值
     * 参数    参数值
     * mobile_verified    0
     * mobile_verified    1
     * @param array $params
     * @return mixed
     */
    public function user_list(array $params)
    {
        return $this->get('guild/user-list', $params);
    }

    /**
     * 修改服务器中用户的昵称
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/nickname    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * guild_id    string    是    POST    服务器的 ID
     * nickname    string    否    POST    昵称，2 - 64 长度，不传则清空昵称
     * user_id    string    否    POST    要修改昵称的目标用户 ID，不传则修改当前登陆用户的昵称
     * @param array $params
     * @return mixed
     */
    public function nickname(array $params)
    {
        return $this->post('guild/nickname', $params);
    }

    /**
     * 离开服务器
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/leave    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * guild_id    body    string    true    服务器 id
     * @param array $params
     * @return mixed
     */
    public function leave(array $params)
    {
        return $this->post('guild/leave', $params);
    }

    /**
     * 踢出服务器
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild/kickout    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * guild_id    string    是    POST    服务器 ID
     * target_id    string    是    POST    目标用户 ID
     * @param array $params
     * @return mixed
     */
    public function kickout(array $params)
    {
        return $this->post('guild/kickout', $params);
    }

    /**
     * 服务器静音闭麦列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-mute/list    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * guild_id    query    string    true    服务器 id
     * return_type    query    string    false    返回格式，建议为"detail", 其他情况仅作为兼容
     * @param array $params
     * @return mixed
     */
    public function mute_list(array $params)
    {
        return $this->get('guild-mute/list', $params);
    }

    /**
     * 添加服务器静音或闭麦
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-mute/create    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * guild_id    string    是    POST    服务器 id
     * user_id    string    是    POST    目标用户 id
     * type    int    是    POST    静音类型，1代表麦克风闭麦，2代表耳机静音
     * @param array $params
     * @return mixed
     */
    public function mute_create(array $params)
    {
        return $this->post('guild-mute/create', $params);
    }

    /**
     * 删除服务器静音或闭麦
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-mute/delete    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * guild_id    string    是    POST    服务器 id
     * user_id    string    是    POST    用户 id
     * type    int    是    POST    静音类型，1代表麦克风闭麦，2代表耳机静音
     * @param array $params
     * @return mixed
     */
    public function mute_delete(array $params)
    {
        return $this->post('guild-mute/delete', $params);
    }
}
