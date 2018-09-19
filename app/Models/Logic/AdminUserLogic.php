<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/14
 * Time: 11:50
 */

namespace App\Models\Logic;

use App\Models\Dao\AdminUserDao;
use App\Utils\Message;
use App\Validate\AdminUserValidate;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 * Class AdminUserLogic
 * @package App\Models\Logic
 */
class AdminUserLogic
{
    /**
     * @Inject()
     * @var AdminUserDao
     */
    private $adminUserDao;

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data)
    {
        $res = AdminUserValidate::check($data);
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $adminUser = $this->adminUserDao->getUserByName($data['username']);
        if (empty($adminUser))
            return Message::error(Message::E_USER_NOT_EXIST);
        if ($adminUser->getStatus() != 1)
            return Message::error(Message::E_USER_DENY);
        if ($adminUser->getPassword() != md5($data['password'] . config('pass_salt')))
            return Message::error(Message::E_PWD);

        //更新登陆信息
        $this->adminUserDao->updateLoginInfo($adminUser->getId());

        session()->put('userInfo', $adminUser);
        return Message::success(Message::SUCCESS, session()->getId());
    }
}