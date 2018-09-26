<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/26
 * Time: 11:14
 */

namespace App\Controllers\Admin;

use App\Middlewares\RbacMiddleware;
use App\Models\Dao\RolesDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;

/**
 * @Controller(prefix="/admin/article")
 */
class ArticleController
{

}