<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 11:47
 */

namespace App\Controllers\Admin;

use App\Models\Logic\AdminUserLogic;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;

/**
 * 后台登陆控制器
 *
 * @Controller(prefix="/admin")
 */
Class LoginController
{

    /**
     * @Inject()
     * @var AdminUserLogic
     */
    private $adminUserLogic;

    /**
     * @RequestMapping(route="login",method={RequestMethod::POST})
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');

        $res = $this->adminUserLogic->login($username, $password);
        return $res;
    }
}