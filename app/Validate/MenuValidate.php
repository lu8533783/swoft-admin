<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/19
 * Time: 11:55
 */

namespace App\Validate;

class MenuValidate extends BaseValidate
{
    public function rules()
    {
        return [
            ['name', 'required'],
            ['route', 'required']
        ];
    }

    public function translates()
    {
        return [
            'name' => '菜单名',
            'route' => '路由地址',
        ];
    }
}