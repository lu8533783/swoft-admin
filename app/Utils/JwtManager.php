<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/18
 * Time: 15:22
 */

namespace App\Utils;

use Firebase\JWT\JWT;

class JwtManager
{
    private static $key = '12b2b5d0cd58189d74f8c1f753c36668';
    private static $cacheTime = 86400;

    /**
     * @param array $data
     * @return array|string
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function encode(array $data)
    {
        $time = time();
        $data['iat'] = $time;
        $data['exp'] = $time + self::$cacheTime;

        $token = JWT::encode($data, self::$key);

        if (!cache()->set($data['role'] . '_' . $data['userId'], $token, self::$cacheTime))
            return Message::error(Message::E_CACHE);

        return $token;
    }

    /**
     * @param string $token
     * @return array
     */
    public static function decode(string $token)
    {
        $result = (array)JWT::decode($token, self::$key, array('HS256'));
        print_r($result);
        return $result;
    }
}