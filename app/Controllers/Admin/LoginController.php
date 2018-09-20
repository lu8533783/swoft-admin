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
     * @return array
     */
    public function login()
    {
        $username = request()->post('username');
        $password = request()->post('password');

        return $this->adminUserLogic->login($username, $password);
    }
}