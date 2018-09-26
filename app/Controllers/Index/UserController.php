<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/17
 * Time: 15:57
 */

namespace App\Controllers\Index;

use App\Models\Logic\UserLogic;
use App\Utils\UploadFile;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\IndexMiddleware;

/**
 * @Controller(prefix="/user")
 * @Middleware(class=IndexMiddleware::class)
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
        $userId = $request->getAttribute('userId');
        return $this->userLogic->getUserById($userId);
    }

    /**
     * @RequestMapping(route="avatar",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws \OSS\Core\OssException
     */
    public function updateAvatar(Request $request)
    {
        $userId = $request->getAttribute('userId');
        $file = request()->file('avatar');
        $url = UploadFile::upload($file);
        return $this->userLogic->updateUser($userId, ['avatar' => $url]);
    }

    /**
     * @RequestMapping(route="nickname",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function updateNickName(Request $request)
    {
        $userId = $request->getAttribute('userId');
        $nickName = request()->input('nickname');
        return $this->userLogic->updateUser($userId, ['nickname' => $nickName], 'nickname');
    }

    /**
     * @RequestMapping(route="mobile",method={RequestMethod::POST})
     * @param Request $request
     * @return array
     */
    public function updateMobile(Request $request)
    {
        $userId = $request->getAttribute('userId');
        $data = [
            'mobile' => $request->input('mobile'),
            'code'   => $request->input('code'),
        ];
        return $this->userLogic->updateMobile($userId, $data);
    }

}