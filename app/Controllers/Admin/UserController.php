<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 15:57
 */

namespace App\Controllers\Admin;

use App\Models\Logic\UserLogic;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/admin/user")
 */
Class UserController
{
    /**
     * @Inject()
     * @var UserLogic
     */
    private $userLogic;

    /**
     * @RequestMapping(route="index",method={RequestMethod::GET})
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1) - 1;
        $limit = $request->input('limit', 10);
        $offset = $page * $limit;
        $id = $request->input('id');
        $mobile = $request->input('mobile');

        $data = [];
        if ($id)
            $data['id'] = $id;
        if ($mobile)
            $data[] = ['username', 'like', $mobile . '%'];

        return $this->userLogic->getUserByWhere($data, $limit, $offset);
    }

}