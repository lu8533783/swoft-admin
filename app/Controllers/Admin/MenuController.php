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
use Swoft\Http\Message\Server\Request;
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

    /**
     * @RequestMapping(route="/add_menu", method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function addMenu(Request $request)
    {
        return $this->menuLogic->addMenu($request->getParsedBody());
    }

    /**
     * @RequestMapping(route="/update_menu", method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function updateMenu(Request $request)
    {
        $id = $request->input('id');
        $data = [
            'name'   => $request->input('name'),
            'parent' => $request->input('parent'),
            'route'  => $request->input('route'),
            'order'  => $request->input('order'),
        ];
        return $this->menuLogic->updateMenu($id, $data);
    }

    /**
     * @RequestMapping(route="/del_menu", method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function delMenu(Request $request)
    {
        $id = $request->input('id');

        return $this->menuLogic->delMenu($id);
    }
}