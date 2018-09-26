<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 用户表

 * @Entity()
 * @Table(name="sh_user")
 * @uses      User
 */
class User extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $username 账号
     * @Column(name="username", type="string", length=255, default="")
     */
    private $username;

    /**
     * @var string $password 密码
     * @Column(name="password", type="char", length=32, default="")
     */
    private $password;

    /**
     * @var string $nickname 昵称
     * @Column(name="nickname", type="string", length=255, default="")
     */
    private $nickname;

    /**
     * @var string $avatar 头像地址
     * @Column(name="avatar", type="string", length=255, default="")
     */
    private $avatar;

    /**
     * @var string $mobile 手机号码
     * @Column(name="mobile", type="char", length=11, default="")
     */
    private $mobile;

    /**
     * @var int $status 0：封禁 1: 正常
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * @var int $loginIp 登陆IP
     * @Column(name="login_ip", type="integer", default=0)
     */
    private $loginIp;

    /**
     * @var int $loginTime 登陆时间
     * @Column(name="login_time", type="integer", default=0)
     */
    private $loginTime;

    /**
     * @var int $registerIp 注册IP
     * @Column(name="register_ip", type="integer", default=0)
     */
    private $registerIp;

    /**
     * @var int $createTime 注册时间
     * @Column(name="create_time", type="integer", default=0)
     */
    private $createTime;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 账号
     * @param string $value
     * @return $this
     */
    public function setUsername(string $value): self
    {
        $this->username = $value;

        return $this;
    }

    /**
     * 密码
     * @param string $value
     * @return $this
     */
    public function setPassword(string $value): self
    {
        $this->password = $value;

        return $this;
    }

    /**
     * 昵称
     * @param string $value
     * @return $this
     */
    public function setNickname(string $value): self
    {
        $this->nickname = $value;

        return $this;
    }

    /**
     * 头像地址
     * @param string $value
     * @return $this
     */
    public function setAvatar(string $value): self
    {
        $this->avatar = $value;

        return $this;
    }

    /**
     * 手机号码
     * @param string $value
     * @return $this
     */
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

        return $this;
    }

    /**
     * 0：封禁 1: 正常
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 登陆IP
     * @param int $value
     * @return $this
     */
    public function setLoginIp(int $value): self
    {
        $this->loginIp = $value;

        return $this;
    }

    /**
     * 登陆时间
     * @param int $value
     * @return $this
     */
    public function setLoginTime(int $value): self
    {
        $this->loginTime = $value;

        return $this;
    }

    /**
     * 注册IP
     * @param int $value
     * @return $this
     */
    public function setRegisterIp(int $value): self
    {
        $this->registerIp = $value;

        return $this;
    }

    /**
     * 注册时间
     * @param int $value
     * @return $this
     */
    public function setCreateTime(int $value): self
    {
        $this->createTime = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 账号
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * 密码
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 昵称
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 头像地址
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * 手机号码
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * 0：封禁 1: 正常
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 登陆IP
     * @return int
     */
    public function getLoginIp()
    {
        return $this->loginIp;
    }

    /**
     * 登陆时间
     * @return int
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * 注册IP
     * @return int
     */
    public function getRegisterIp()
    {
        return $this->registerIp;
    }

    /**
     * 注册时间
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

}
