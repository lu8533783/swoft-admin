<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/14
 * Time: 10:50
 */

namespace App\Controllers\Admin;

use App\Middlewares\ApiMiddleware;
use App\Models\Logic\MenuLogic;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * @Controller()
 * Class MenuController
 * @package App\Controllers
 */
class MenuController
{
    /**
     * @Inject()
     * @var MenuLogic
     */
    private $menuLogic;

    /**
     * @RequestMapping(route="/menu", method={RequestMethod::GET})
     * @Middleware(class=ApiMiddleware::class)
     */
    public function index()
    {
        return $this->menuLogic->getMenu();
    }
}