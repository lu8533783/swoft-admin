<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/14
 * Time: 11:50
 */

namespace App\Models\Logic;

use App\Models\Dao\UserDao;
use App\Models\Entity\User;
use App\Utils\Message;
use App\Validate\UserValidate;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 * Class AdminUserLogic
 * @package App\Models\Logic
 */
class UserLogic
{
    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    public function register(array $data)
    {
        if ($this->userDao->hasMobile($data['mobile'])) {
            return Message::error(Message::E_USER_EXIST);
        }

        $res = UserValidate::quick($data, 'register')->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        if ($this->userDao->addUser($data))
            return Message::success(Message::SUCCESS);
        else
            return Message::error(Message::E_INSERT_DATA);
    }

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data)
    {
        $res = UserValidate::quick($data, 'login')->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $user = $this->userDao->getUserByName($data['mobile']);
        if (empty($user))
            return Message::error(Message::E_USER_NOT_EXIST);
        if ($user->getStatus() != 1)
            return Message::error(Message::E_USER_DENY);
        if ($user->getPassword() != md5($data['password'] . config('pass_salt')))
            return Message::error(Message::E_PWD);

        //更新登陆信息
        $this->userDao->updateLoginInfo($user->getId());

        session()->put('userId', $user->getId());
        return Message::success(Message::SUCCESS, session()->getId());
    }

    public function forget(array $data)
    {
        if (!$this->userDao->hasMobile($data['mobile'])) {
            return Message::error(Message::E_USER_NOT_EXIST);
        }

        $res = UserValidate::quick($data, 'forget')->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        if ($data['step'] == 1)
            return Message::success(Message::SUCCESS);

        if ($this->userDao->updatePassword($data['mobile'], $data['password']) !== false)
            return Message::success(Message::SUCCESS);
        else
            return Message::error(Message::E_UPDATE_DATA);
    }

    /**
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param string $order
     * @return array
     */
    public function getUserByWhere(array $where, $limit = 0, $offset = 10, $order = 'id')
    {
        $result = $this->userDao->getUserByWhere($where, $limit, $offset, $order);
        $count = User::count('id', $where)->getResult();

        return Message::success(Message::SUCCESS, $result, $count);
    }

    /**
     * @param $id
     * @return array
     */
    public function getUserById($id)
    {
        $result = $this->userDao->getUserById($id);

        return Message::success(Message::SUCCESS, $result);
    }

    public function updateUser($id, $data, $scene = '')
    {
        if (!empty($scene)) {
            $res = UserValidate::quick($data, $scene)->validate();
            if ($res->fail())
                return Message::error(Message::E_PARAM, $res->firstError());
        }
        $this->userDao->updateUser($id, $data);

        return Message::success(Message::SUCCESS);
    }

    public function updateMobile($id, $data)
    {
        if ($this->userDao->hasMobile($data['mobile'])) {
            return Message::error(Message::E_USER_EXIST);
        }

        $res = UserValidate::quick($data, 'updateMobile')->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $this->userDao->updateUser($id, ['mobile' => $data['mobile'], 'username' => $data['mobile']]);
        return Message::success(Message::SUCCESS);
    }

}