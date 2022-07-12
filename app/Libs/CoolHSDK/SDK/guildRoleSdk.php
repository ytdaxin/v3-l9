<?php
/**
 * 服务器角色权限相关接口列表
 * 本文档主要列出服务器角色权限相关接口。
 * 本文档中的接口均符合接口规范，如有疑问，建议先查阅接口引言。
 * 接口    接口说明    维护状态
 * /api/v3/guild-role/list    获取服务器角色列表    正常
 * /api/v3/guild-role/create    创建服务器角色    正常
 * /api/v3/guild-role/update    更新服务器角色    正常
 * /api/v3/guild-role/delete    删除服务器角色    正常
 * /api/v3/guild-role/grant    赋予用户角色    正常
 * /api/v3/guild-role/revoke    删除用户角色    正常
 * 权限说明
 * 权限是一个unsigned int值，由比特位代表是否拥有对应的权限。 权限值与对应比特位进行按位与操作，判断是否拥有该权限。
 * // 判断是否有某权限。其中: permissions代表权限值，bitValue代表某权限比特位，1 << bitValue 代表某权限值。
 * permissions & (1 << bitValue)  == (1 << bitValue);
 * 数据位的说明如下：
 *
 * 比特位    值    权限    说明
 * 0    1    管理员    拥有此权限会获得完整的管理权，包括绕开所有其他权限（包括频道权限）限制，属于危险权限。
 * 1    2    管理服务器    拥有此权限的成员可以修改服务器名称和更换区域。
 * 2    4    查看管理日志    拥有此权限的成员可以查看服务器的管理日志。
 * 3    8    创建服务器邀请    能否创建服务器邀请链接
 * 4    16    管理邀请    拥有该权限可以管理服务器的邀请
 * 5    32    频道管理    拥有此权限的成员可以创建新的频道以及编辑或删除已存在的频道。
 * 6    64    踢出用户
 * 7    128    封禁用户
 * 8    256    管理自定义表情
 * 9    512    修改服务器昵称    拥有此权限的用户可以更改他们的昵称。
 * 10    1024    管理角色权限    拥有此权限成员可以创建新的角色和编辑删除低于该角色的身份。
 * 11    2048    查看文字、语音频道
 * 12    4096    发布消息
 * 13    8192    管理消息    拥有此权限的成员可以删除其他成员发出的消息和置顶消息。
 * 14    16384    上传文件
 * 15    32768    语音链接
 * 16    65536    语音管理    拥有此权限的成员可以把其他成员移动和踢出频道；但此类移动仅限于在该成员和被移动成员均有权限的频道之间进行。
 * 17    131072    提及@全体成员    拥有此权限的成员可使用@全体成员以提及该频道中所有成员。
 * 18    262144    添加反应    拥有此权限的成员可以对消息添加新的反应。
 * 19    524288    跟随添加反应    拥有此权限的成员可以跟随使用已经添加的反应。
 * 20    1048576    被动连接语音频道    拥有此限制的成员无法主动连接语音频道，只能在被动邀请或被人移动时，才可以进入语音频道。
 * 21    2097152    仅使用按键说话    拥有此限制的成员加入语音频道后，只能使用按键说话。
 * 22    4194304    使用自由麦    没有此权限的成员，必须在频道内使用按键说话。
 * 23    8388608    说话
 * 24    16777216    服务器静音
 * 25    33554432    服务器闭麦
 * 26    67108864    修改他人昵称    拥有此权限的用户可以更改他人的昵称
 * 27    134217728    播放伴奏    拥有此权限的成员可在语音频道中播放音乐伴奏
 */

namespace App\Libs\CoolHSDK\SDK;

use App\Libs\CoolHSDK\CoolhSdk;

class guildRoleSdk extends CoolhSDK
{
    /**
     * 获取服务器角色列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/list    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * guild_id    query    string    true    服务器 id
     * page    query    integer    false    目标页数
     * page_size    query    integer    false    每页数据数量
     * @param array $params
     * @return mixed
     */
    public function list(array $params)
    {
        return $this->get('guild-role/list', $params);
    }

    /**
     * 创建服务器角色
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/create    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * name    string    否    POST    如果不写，则为"新角色"
     * guild_id    string    是    POST    服务器 id
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->post('guild-role/create', $params);
    }

    /**
     * 更新服务器角色
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/update    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » guild_id    body    string    true    服务器 id
     * » role_id    body    integer(unsigned integer)    true    角色 id
     * » name    body    string    false    角色名称
     * » color    body    integer(unsigned integer)    false    颜色
     * » hoist    body    integer(unsigned integer)    false    只能为 0 或者 1，是否把该角色的用户在用户列表排到前面
     * » mentionable    body    integer(unsigned integer)    false    只能为 0 或者 1，该角色是否可以被提及
     * » permissions    body    integer(unsigned integer)    false    权限,参见权限说明
     * @param array $params
     * @return mixed
     */
    public function update(array $params)
    {
        return $this->post('guild-role/update', $params);
    }

    /**
     * 删除服务器角色
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/delete    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » guild_id    body    string    true    服务器 id
     * » role_id    body    integer(unsigned integer)    true    角色 id
     * @param array $params
     * @return mixed
     */
    public function delete(array $params)
    {
        return $this->post('guild-role/delete', $params);
    }

    /**
     * 赋予用户角色
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/grant    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » guild_id    body    string    true    服务器 id
     * » user_id    body    string    true    用户 id
     * » role_id    body    unsigned int    true    服务器角色 id
     * @param array $params
     * @return mixed
     */
    public function grant(array $params)
    {
        return $this->post('guild-role/grant', $params);
    }

    /**
     * 删除用户角色
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/guild-role/revoke    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » guild_id    body    string    true    服务器 id
     * » user_id    body    string    true    用户 id
     * » role_id    body    unsigned int    true    服务器角色 id
     * @param array $params
     * @return mixed
     */
    public function revoke(array $params)
    {
        return $this->post('guild-role/revoke', $params);
    }
}
