<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 15:14
 */

namespace App\Validate;

use Inhere\Validate\FieldValidation;

class BaseValidate extends FieldValidation
{
    public function messages()
    {
        return [
            'required'  => '{attr} 是必填项。',
            'alphaDash' => '{attr} 仅包含字母、数字、破折号（ - ）以及下划线（ _ ）',
            'string'    => '{attr} 长度必须在{min} ~ {max}之间',
            'lengthEq'  => '{attr} 长度必须是 {value0}',
            'compare'   => '{attr} 和 {value0} 不相同',
            'checkCode' => '{attr} 错误',
        ];
    }
}