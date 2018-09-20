<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/14
 * Time: 11:47
 */

namespace App\Utils;

class Message
{
    const SUCCESS = [0, ''];
    const E_DEFAULT = [1001, '未知错误'];
    const E_PARAM = [1012, '参数错误'];

    /* 帐号相关 */
    const E_USER_NOT_EXIST = [1100, '账号不存在'];
    const E_USER_EXIST = [1101, '帐号已存在'];
    const E_USER_DENY = [1102, '账号禁用'];
    const E_PWD = [1103, '密码错误'];

    /* 缓存相关 */
    const E_CACHE = [1200, '设置缓存失败'];

    /* 数据库相关 */
    const E_INSERT_DATA = [1300, '数据新增失败'];
    const E_UPDATE_DATA = [1301, '数据更新失败'];
    const E_DELETE_DATA = [1302, '数据删除失败'];

    /* 短信验证码相关 */
    const E_SEND_CODE = [1400, '发送短信失败'];
    const E_CODE_DENY = [1401, '发送间隔未到'];

    /**
     * 成功返回
     * @param array $code
     * @param array $data 返回数据
     * @param string $count 数量
     * @param string $msg 成功消息
     * @return array
     */
    public static function success($code = self::SUCCESS, $data = [], $count = '', $msg = '')
    {
        if (!empty($count)) {
            return ['code' => $code['0'], 'data' => $data, 'count' => $count, 'msg' => $msg];
        }
        return ['code' => $code['0'], 'data' => $data, 'msg' => $msg];
    }

    /**
     * 错误返回
     * @param array $code
     * @param string $msg 错误消息
     * @param array $data 返回数据
     * @return array
     */
    public static function error($code = self::E_DEFAULT, $msg = '', $data = [])
    {
        return ['code' => $code['0'], 'data' => $data, 'msg' => $msg ?: $code['1']];
    }

}