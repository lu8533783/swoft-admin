<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 15:57
 */

namespace App\Controllers\Index;

use App\Models\Entity\User;
use App\Models\Logic\UserLogic;
use App\Utils\Message;
use App\Utils\MobileCode;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/")
 */
Class LoginController
{
    /**
     * @Inject()
     * @var UserLogic
     */
    private $userLogic;

    /**
     * @RequestMapping(route="/register",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $data = [
            'mobile'   => $request->input('mobile'),
            'code'     => $request->input('code'),
            'password' => $request->input('password'),
        ];

        return $this->userLogic->register($data);
    }

    /**
     * @RequestMapping(route="/login",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $data = [
            'mobile'   => $request->input('mobile'),
            'password' => $request->input('password'),
        ];

        return $this->userLogic->login($data);
    }

    /**
     * @RequestMapping(route="/get_code",method={RequestMethod::GET})
     * @param Request $request
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getCode(Request $request)
    {
        $type = $request->input('type');
        $mobile = $request->input('mobile');
        $hasMobile = User::findOne(['username' => $mobile], ['field' => ['id']])->getResult();
        if ($type == 1 && $hasMobile) {
            return Message::error(Message::E_USER_EXIST);
        } else if ($type == 2 && !$hasMobile) {
            return Message::error(Message::E_USER_NOT_EXIST);
        }
        return MobileCode::getCode($mobile);
    }

    /**
     * @RequestMapping(route="/forget",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function forget(Request $request)
    {
        $step = $request->input('step');
        $data = [
            'mobile'   => $request->input('mobile'),
            'code'     => $request->input('code'),
            'password' => $step == 1 ? '123123' : $request->input('password'),
            'step'     => $step,
        ];
        return $this->userLogic->forget($data);
    }

}