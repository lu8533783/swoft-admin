<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 11:50
 */

namespace App\Models\Logic;

use App\Models\Data\AdminUserData;
use App\Utils\Message;
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
     * @var AdminUserData
     */
    private $adminUserData;

    /**
     * @param $username
     * @param $password
     * @return string|array
     */
    public function login($username, $password)
    {
        $adminUser = $this->adminUserData->getUserByName($username);

        if (empty($adminUser) || $adminUser->getPassword() != md5($password . config('pass_salt'))) {
            return Message::error([500, '帐号密码错误']);
        }
        if ($adminUser->getStatus() != 1) {
            return Message::error([500, '帐号已禁用']);
        }
        session()->put('userInfo', $adminUser);
        return session()->getId();
    }
}