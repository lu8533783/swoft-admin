<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
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

    /**
     * @param int $userId
     * @return mixed
     */
    public function updateLoginInfo(int $userId)
    {
        $time = time();
        $ip = request()->getHeaderLine('X-Real-IP');

        $data = [
            'login_ip'   => ip2long($ip),
            'login_time' => $time
        ];
        return AdminUser::updateOne($data, ['id' => $userId])->getResult();
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function getUserByWhere(array $where)
    {
        /* @var AdminUser $users */
        $users = AdminUser::findAll($where)->getResult();
        foreach ($users as $k => $user) {
            $user = $user->toArray();
            unset($user['password']);
            $users[$k] = $user;
        }
        return $users;
    }
}