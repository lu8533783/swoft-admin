<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 14:08
 */

namespace App\Models\Data;

use App\Models\Dao\AdminUserDao;
use App\Models\Dao\RolesDao;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 * Class AdminUserData
 * @package App\Models\Data
 */
class AdminUserData
{
    /**
     * @Inject()
     * @var AdminUserDao
     */
    private $adminUserDao;

    /**
     * @Inject()
     * @var RolesDao
     */
    private $rolesDao;

    public function getUserByName($username)
    {
        $adminUser = $this->adminUserDao->getUserByName($username);
        $adminUser->role = $this->rolesDao->getRoleByID($adminUser->getRoleId());
        return $adminUser;
    }
}