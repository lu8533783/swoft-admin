<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 16:34
 */


namespace App\Validate;

use App\Utils\MobileCode;

class UserValidate extends BaseValidate
{
    public function rules()
    {
        return [
            ['mobile', 'required|lengthEq:11'],
            ['password', 'required|string:6,16'],
            ['code', 'required|lengthEq:4|checkCode'],
            ['nickname', 'required|string:2,12'],
        ];
    }

    public function translates()
    {
        return [
            'mobile'   => '手机号',
            'password' => '密码',
            'code'     => '短信验证码',
            'nickname' => '昵称',
        ];
    }

    public function scenarios(): array
    {
        return [
            'register'     => ['mobile', 'password', 'code'],
            'login'        => ['mobile,password'],
            'forget'       => ['mobile', 'password', 'code'],
            'sendMobile'   => ['mobile'],
            'nickname'     => ['nickname'],
            'updateMobile' => ['mobile', 'code'],
        ];
    }

    /**
     * @param $code
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function checkCodeValidator($code)
    {
        $mobile = $this->get('mobile');
        return MobileCode::checkCode($mobile, $code);
    }
}