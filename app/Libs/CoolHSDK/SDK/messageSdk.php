<?php
/**
 * 频道消息相关接口列表
 * 接口    接口说明    维护状态
 * /api/v3/message/list    获取频道聊天消息列表    正常
 * /api/v3/message/create    发送频道聊天消息    正常
 * /api/v3/message/update    更新频道聊天消息    正常
 * /api/v3/message/delete    删除频道聊天消息    正常
 * /api/v3/message/reaction-list    获取频道消息某个回应的用户列表    正常
 * /api/v3/message/add-reaction    给某个消息添加回应    正常
 * /api/v3/message/delete-reaction    删除消息的某个回应    正常
 * 消息详情参数说明
 * 参数名    类型    说明
 * id    string    消息 id
 * type    int    消息类型
 * author    map    作者的用户信息
 * content    string    消息内容
 * mention    array    @特定用户 的用户ID数组，与 mention_info 中的数据对应
 * mention_all    boolean    是否含有 @全体人员
 * mention_roles    array    @特定角色 的角色ID数组，与 mention_info 中的数据对应
 * mention_here    boolean    是否含有 @在线人员
 * embeds    array    超链接解析数据
 * attachments    array    附加的多媒体数据
 * reactions    array    回应数据
 * quote    map    引用消息
 * mention_info    map    引用特定用户或特定角色的信息
 * ↳ mention_part    array    @特定用户 详情
 * ↳ mention_role_part    array    @特定角色 详情
 */

namespace App\Libs\CoolHSDK\SDK;

use App\Libs\CoolHSDK\CoolhSdk;

class messageSdk extends CoolhSdk
{
    /**
     * /api/v3/message/list    获取频道聊天消息列表    正常
     *参数列表
     * 参数名    类型    必传    参数区域    说明
     * target_id    string    是    GET    频道 id
     * msg_id    string    否    GET    参考消息 id，不传则默认为最新的消息 id
     * pin    unsigned int    否    GET    只能为0或者1，是否查询置顶消息
     * flag    string    否    GET    查询模式，有三种模式可以选择。不传则默认查询最新的消息
     * @param array $params
     * @return mixed
     */
    public function list(array $params)
    {
        return $this->get('message/list', $params);
    }

    /**
     * /api/v3/message/create    发送频道聊天消息    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * type    int    否    POST    消息类型, 见[type], 不传默认为 1, 代表文本类型。2 图片消息，3 视频消息，4 文件消息，9 代表 kmarkdown 消息, 10 代表卡片消息。
     * target_id    string    是    POST    目标频道 id
     * content    string    是    POST    消息内容
     * quote    string    否    POST    回复某条消息的 msgId
     * nonce    string    否    POST    nonce, 服务端不做处理, 原样返回
     * temp_target_id    string    否    POST    用户id,如果传了，代表该消息是临时消息，该消息不会存数据库，但是会在频道内只给该用户推送临时消息。用于在频道内针对用户的操作进行单独的回应通知等。
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->post('message/create', $params);
    }

    /**
     * /api/v3/message/update    更新频道聊天消息    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * msg_id    string    是    POST    消息 id
     * content    string    是    POST    消息内容
     * quote    string    否    POST    回复某条消息的 msgId。如果为空，则代表删除回复，不传则无影响。
     * temp_target_id    string    否    POST    用户 id，针对特定用户临时更新消息，必须是正常消息才能更新。与发送临时消息概念不同，但同样不保存数据库。
     * @param array $params
     * @return mixed
     */
    public function update(array $params)
    {
        return $this->post('message/update', $params);
    }

    /**
     * /api/v3/message/delete    删除频道聊天消息    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * msg_id    string    是    POST    消息 id
     * @param array $params
     * @return mixed
     */
    public function delete(array $params)
    {
        return $this->post('message/delete', $params);
    }

    /**
     * /api/v3/message/reaction-list    获取频道消息某个回应的用户列表    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * msg_id    string    是    GET    频道消息的id
     * emoji    string    是    GET    emoji的id, 可以为GuilEmoji或者Emoji, 注意：在get中，应该进行urlencode
     * @param array $params
     * @return mixed
     */
    public function reaction_list(array $params)
    {
        return $this->get('message/reaction-list', $params);
    }

    /**
     * /api/v3/message/add-reaction    给某个消息添加回应    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * msg_id    string    是    POST    频道消息的id
     * emoji    string    是    POST    emoji的id, 可以为GuilEmoji或者Emoji
     * @param array $params
     * @return mixed
     */
    public function add_reaction(array $params)
    {
        return $this->post('message/add-reaction', $params);
    }

    /**
     * /api/v3/message/delete-reaction    删除消息的某个回应    正常
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * msg_id    string    是    POST    频道消息的id
     * emoji    string    是    POST    emoji的id, 可以为GuilEmoji或者Emoji
     * user_id    string    否    POST    用户的id, 如果不填则为自己的id。删除别人的reaction需要有管理频道消息的权限
     * @param array $params
     * @return mixed
     */
    public function delete_reaction(array $params)
    {
        return $this->post('message/delete-reaction', $params);
    }
}
