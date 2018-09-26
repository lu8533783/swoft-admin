<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/14
 * Time: 13:59
 */

namespace App\Models\Dao;

use App\Models\Entity\User;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 * Class UserDao
 * @package App\Models\Dao
 */
class UserDao
{

    /**
     * @param $username
     * @return User
     */
    public function getUserByName($username)
    {
        return User::findOne(['username' => $username])->getResult();
    }

    /**
     * @param $userId
     * @return User
     */
    public function getUserById($userId)
    {
        $user = User::findById($userId)->getResult();
        $user = $this->getFieldAttr($user);
        return $user;
    }

    /**
     * @param $mobile
     * @return mixed
     */
    public function hasMobile($mobile)
    {
        return User::findOne(['username' => $mobile], ['field' => ['id']])->getResult();
    }

    /**
     * @param array $data
     * @return User
     */
    public function addUser(array $data)
    {
        $time = time();
        $ip = request()->getHeaderLine('X-Real-IP');

        $user = new User();
        $user->setUsername($data['mobile']);
        $user->setMobile($data['mobile']);
        $user->setPassword(md5($data['password'] . config('pass_salt')));
        $user->setRegisterIp(ip2long($ip));
        $user->setCreateTime($time);

        return $user->save()->getResult();
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
        return User::updateOne($data, ['id' => $userId])->getResult();
    }

    /**
     * @param string $mobile
     * @param string $password
     * @return mixed
     */
    public function updatePassword(string $mobile, string $password)
    {
        $data = [
            'password' => md5($password . config('pass_salt')),
        ];
        return User::updateOne($data, ['mobile' => $mobile])->getResult();
    }

    /**
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @return mixed
     */
    public function getUserByWhere(array $where, $limit = 0, $offset = 10, $orderBy = 'id')
    {
        /* @var User $users */
        $users = User::query()->condition($where)->orderBy($orderBy, 'desc')->limit($limit, $offset)->get()->getResult();
        foreach ($users as $k => $user) {
            $user = $this->getFieldAttr($user);
            $users[$k] = $user;
        }
        return $users;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateUser($id, $data)
    {
        return User::updateOne($data, ['id' => $id])->getResult();
    }

    /**
     * @param User $user
     * @return User|array
     */
    private function getFieldAttr(User $user)
    {
        $user = $user->toArray();
        unset($user['password']);
        $user['loginIp'] = long2ip($user['loginIp']);
        $user['registerIp'] = long2ip($user['registerIp']);
        $user['loginTime'] = date('Y-m-d H:i:s', $user['loginTime']);
        $user['createTime'] = date('Y-m-d H:i:s', $user['createTime']);

        return $user;
    }
}