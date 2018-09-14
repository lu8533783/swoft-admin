<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 11:50
 */

namespace App\Models\Logic;

use App\Models\Data\AdminUserData;
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

    public function login($username, $password)
    {
        $adminUser = $this->adminUserData->getUserByName($username);

        if (empty($adminUser)) {
            return '帐号不存在';
        }
        if ($adminUser->getStatus() != 1) {
            return '帐号已禁用';
        }
        if ($adminUser->getPassword() != md5($password . config('pass_salt'))) {
            return '帐号密码错误';
        }
        return $adminUser;
    }
}