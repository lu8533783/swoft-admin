<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 16:18
 */

namespace App\Utils;

use App\Validate\UserValidate;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class MobileCode
{
    private static $config = [
        'accessKeyId'     => 'LTAIbVA2LRQ1tULr',
        'accessKeySecret' => 'ocS48RUuyBPpQHsfoWokCuz8ZQbGxl',
    ];

    /**
     * @param $mobile
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getCode($mobile)
    {
        $res = UserValidate::quick(['mobile' => $mobile], 'sendMobile')->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $result = cache()->get('code_' . $mobile);
        if ($result && time() - 60 < $result['time'])
            return Message::error(Message::E_CODE_DENY);

        $code = mt_rand(1000, 9999);
        $result = self::doSend($mobile, $code);
        $result->Code = 'OK'; // 测试环境
        if (!isset($result->Code) || $result->Code != 'OK')
            return Message::error(Message::E_SEND_CODE, $result->Code);

        $result = cache()->set('code_' . $mobile, ['code' => $code, 'time' => time()], 600);
        if ($result) {
            return Message::success(Message::SUCCESS);
        } else {
            return Message::error(Message::E_CACHE);
        }
    }

    private static function doSend($mobile, $code)
    {
        $client = new Client(self::$config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($mobile);
        $sendSms->setSignName('魅力互娱');
        $sendSms->setTemplateCode('SMS_34960383');
        $sendSms->setTemplateParam(['code' => $code, 'product' => '']);
        $sendSms->setOutId('ext');
        $result = $client->execute($sendSms);
        return $result;
    }

    /**
     * @param $mobile
     * @param $code
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function checkCode($mobile, $code)
    {
        $result = cache()->get('code_' . $mobile);
        if (!$result || $result['code'] != $code)
            return false;

        return true;
    }
}