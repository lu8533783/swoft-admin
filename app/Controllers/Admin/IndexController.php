<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/14
 * Time: 10:50
 */

namespace App\Controllers\Admin;

use App\Middlewares\RbacMiddleware;
use App\Models\Dao\RolesDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;

/**
 * @Controller(prefix="/admin")
 * Class IndexController
 * @package App\Controllers
 */
class IndexController
{
    /**
     * @Inject()
     * @var RolesDao
     */
    private $rolesDao;

    /**
     * @RequestMapping()
     * @Middleware(class=RbacMiddleware::class)
     */
    public function index()
    {
        return [];
    }

    /**
     * @RequestMapping()
     * @Middleware(class=RbacMiddleware::class)
     */
    public function root()
    {
        return [];
    }
}