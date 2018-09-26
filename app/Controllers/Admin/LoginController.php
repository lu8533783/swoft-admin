<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 11:47
 */

namespace App\Controllers\Admin;

use App\Middlewares\ApiMiddleware;
use App\Models\Logic\AdminUserLogic;
use Swoft\Http\Message\Bean\Annotation\Middleware;
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
     * @Middleware(class=ApiMiddleware::class)
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        return $this->adminUserLogic->login($data);
    }
}