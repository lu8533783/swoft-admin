<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 15:57
 */

namespace App\Controllers\Admin;

use App\Models\Logic\AdminUserLogic;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/admin/admin_user")
 */
Class AdminUserController
{
    /**
     * @Inject()
     * @var AdminUserLogic
     */
    private $adminUserLogic;

    /**
     * @RequestMapping(route="index",method={RequestMethod::GET})
     * @return array
     */
    public function index()
    {
        $data = [

        ];
        return $this->adminUserLogic->getUserByWhere($data);
    }

}