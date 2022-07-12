<?php
/**
 * 用户私聊消息接口列表
 * 本文档主要列出私聊消息相关接口。
 *
 * 本文档中的接口均符合接口规范，如有疑问，建议先查阅接口引言。
 *
 * 接口    接口说明    维护状态
 * /api/v3/direct-message/list    获取私信聊天消息列表    正常
 * /api/v3/direct-message/create    发送私信聊天消息    正常
 * /api/v3/direct-message/update    更新私信聊天消息    正常
 * /api/v3/direct-message/delete    删除私信聊天消息    正常
 * /api/v3/direct-message/reaction-list    获取频道消息某个回应的用户列表    正常
 * /api/v3/direct-message/add-reaction    给某个消息添加回应    正常
 * /api/v3/direct-message/delete-reaction    删除消息的某个回应    正常
 * 消息详情参数说明
 * 参数名    类型    说明
 * id    string    消息 ID
 * type    int    消息类型
 * author_id    string    作者的用户 ID
 * content    string    消息内容
 * embeds    array    超链接解析数据
 * attachments    array    附加的多媒体数据
 * reactions    array    回应数据
 * quote    map    引用数据
 * read_status    boolean    是否已读
 */

namespace App\Libs\CoolHSDK\SDK;


use App\Libs\CoolHSDK\CoolhSdk;

class directMessageSdk extends CoolhSdk
{
    /**
     * 获取私信聊天消息列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/direct-message/list    GET    此接口非标准分页，需要根据参考消息来查询相邻分页的消息
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * chat_code    query    string    false    私信会话 Code。chat_code与target_id必须传一个
     * target_id    query    string    false    目标用户 id，后端会自动创建会话。有此参数之后可不传chat_code参数
     * msg_id    query    string    false    参考消息 id，不传则查询最新消息
     * flag    query    string    false    查询模式，有三种模式可以选择。不传则默认查询最新的消息。
     * page    query    integer    false    目标页数
     * page_size    query    integer    false    当前分页消息数量, 默认 50
     * 查询模式说明
     * flag: 查询模式，有三种模式可以选择。不传则默认查询最新的消息。
     * before: 查询参考消息之前的消息，不包括参考消息
     * around: 查询以参考消息为中心，前后一定数量的消息
     * after: 查询参考消息之后的消息，不包括参考消息
     * @param array $params
     * @return mixed|null
     */
    public function list(array $params)
    {
        return $this->get('direct-message/list', $params);
    }

    /**
     * 发送私信聊天消息
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/direct-message/create    POST
     * 参数列表
     * 参数名    类型    必传    参数区域    说明
     * type    int    否    POST    消息类型, 见[type], 不传默认为 1, 代表文本类型。2 图片消息，3 视频消息，4 文件消息，9 代表 kmarkdown 消息, 10 代表卡片消息。
     * target_id    string    否    POST    目标用户 id，后端会自动创建会话。有此参数之后可不传 chat_code参数
     * chat_code    string    否    POST    目标会话 Code，chat_code 与 target_id 必须传一个
     * content    string    是    POST    消息内容
     * quote    string    否    POST    回复某条消息的 msgId
     * nonce    string    否    POST    nonce, 服务端不做处理, 原样返回
     * @param array $params
     * @return mixed|null
     */
    public function create(array $params)
    {
        return $this->post('direct-message/create', $params);
    }

    /**
     * 更新私信聊天消息
     * 接口说明
     * 目前支持消息 type为 9、10 的修改，即 KMarkdown 和 CardMessage
     *
     * 地址    请求方式    说明
     * /api/v3/direct-message/update    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » msg_id    body    string    false    消息 id
     * » content    body    string    true    消息内容
     * » quote    body    string    false    回复某条消息的msgId。如果为空，则代表删除回复，不传则无影响。
     * @param array $params
     * @return mixed|null
     */
    public function update(array $params)
    {
        return $this->post('direct-message/update', $params);
    }

    /**
     * 删除私信聊天消息
     * 接口说明
     * 只能删除自己的消息。
     *
     * 地址    请求方式    说明
     * /api/v3/direct-message/delete    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » msg_id    body    string    false    消息 id
     * @param array $params
     * @return mixed|null
     */
    public function delete(array $params)
    {
        return $this->post('direct-message/delete', $params);
    }

    /**
     * 获取频道消息某回应的用户列表
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/direct-message/reaction-list    GET
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * msg_id    query    string    true    消息的 id
     * emoji    query    string    false    emoji 的 id, 可以为 GuildEmoji 或者 Emoji, 注意：在 get 中，应该进行 urlencode
     * @param array $params
     * @return mixed|null
     */
    public function reaction_list(array $params)
    {
        return $this->get('direct-message/reaction-list', $params);
    }

    /**
     * 给某个消息添加回应
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/direct-message/add-reaction    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » msg_id    body    string    true    消息 id
     * » emoji    body    string    true    emoji 的 id, 可以为 GuilEmoji 或者 Emoji
     * @param array $params
     * @return mixed|null
     */
    public function add_reaction(array $params)
    {
        return $this->post('direct-message/add-reaction', $params);
    }

    /**
     * 删除消息的某个回应
     * 接口说明
     * 地址    请求方式    说明
     * /api/v3/direct-message/delete-reaction    POST
     * 参数列表
     * 参数名    位置    类型    必需    说明
     * body    body    object    false    none
     * » msg_id    body    string    true    消息 id
     * » emoji    body    string    true    表情的 ID
     * » user_id    body    string    false    用户的 id, 如果不填则为自己的 id。删除别人的 reaction 需要有管理频道消息的权限
     * @param array $params
     * @return mixed|null
     */
    public function delete_reaction(array $params)
    {
        return $this->post('direct-message/delete-reaction', $params);
    }
}
