<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 13:43
 */

namespace App\Validate;

class AdminUserValidate extends BaseValidate
{
    public function rules()
    {
        return [
            ['username', 'required|alphaDash|string:4,10'],
            ['password', 'required|string:6,16']
        ];
    }

    public function translates()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}