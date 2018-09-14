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
 * 管理员表

 * @Entity()
 * @Table(name="sh_admin_user")
 * @uses      AdminUser
 */
class AdminUser extends Model
{
    /**
     * @var int $id ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $username 用户名
     * @Column(name="username", type="string", length=20, default="")
     */
    private $username;

    /**
     * @var string $password 密码
     * @Column(name="password", type="string", length=32, default="")
     */
    private $password;

    /**
     * @var int $roleId 角色id
     * @Column(name="role_id", type="integer", default=1)
     */
    private $roleId;

    /**
     * @var string $avatar 头像
     * @Column(name="avatar", type="string", length=100, default="")
     */
    private $avatar;

    /**
     * @var string $mobile 手机号码
     * @Column(name="mobile", type="string", length=255, default="")
     */
    private $mobile;

    /**
     * @var string $email 邮箱
     * @Column(name="email", type="string", length=255, default="")
     */
    private $email;

    /**
     * @var int $loginIp ip地址
     * @Column(name="login_ip", type="integer", default=0)
     */
    private $loginIp;

    /**
     * @var int $loginTime 登录时间
     * @Column(name="login_time", type="integer", default=0)
     */
    private $loginTime;

    /**
     * @var int $createTime 创建时间
     * @Column(name="create_time", type="integer", default=0)
     */
    private $createTime;

    /**
     * @var int $updateTime 更新时间
     * @Column(name="update_time", type="integer", default=0)
     */
    private $updateTime;

    /**
     * @var int $status 0：封禁 1: 正常
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * ID
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 用户名
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
     * 角色id
     * @param int $value
     * @return $this
     */
    public function setRoleId(int $value): self
    {
        $this->roleId = $value;

        return $this;
    }

    /**
     * 头像
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
     * 邮箱
     * @param string $value
     * @return $this
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;

        return $this;
    }

    /**
     * ip地址
     * @param int $value
     * @return $this
     */
    public function setLoginIp(int $value): self
    {
        $this->loginIp = $value;

        return $this;
    }

    /**
     * 登录时间
     * @param int $value
     * @return $this
     */
    public function setLoginTime(int $value): self
    {
        $this->loginTime = $value;

        return $this;
    }

    /**
     * 创建时间
     * @param int $value
     * @return $this
     */
    public function setCreateTime(int $value): self
    {
        $this->createTime = $value;

        return $this;
    }

    /**
     * 更新时间
     * @param int $value
     * @return $this
     */
    public function setUpdateTime(int $value): self
    {
        $this->updateTime = $value;

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
     * ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 用户名
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
     * 角色id
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * 头像
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
     * 邮箱
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * ip地址
     * @return int
     */
    public function getLoginIp()
    {
        return $this->loginIp;
    }

    /**
     * 登录时间
     * @return int
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * 创建时间
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * 更新时间
     * @return int
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * 0：封禁 1: 正常
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

}
