<?php
/**
 * Created by PhpStorm.
 * User: shcw
 * Date: 2018/9/14
 * Time: 13:59
 */

namespace App\Models\Dao;

use App\Models\Entity\AdminUser;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 * Class AdminUserDao
 * @package App\Models\Dao
 */
class AdminUserDao
{

    /**
     * @param $username
     * @return AdminUser
     */
    public function getUserByName($username)
    {
        return AdminUser::findOne(['username' => $username])->getResult();
    }
}