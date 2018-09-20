<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/20
 * Time: 14:45
 */

namespace App\Models\Dao;

use App\Models\Entity\Roles;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 * Class RolesDao
 * @package App\Models\Dao
 */
class RolesDao
{
    /**
     * @var Roles[]
     */
    private $roles = [];

    /**
     * @param int $parent_id
     * @return Roles[]
     */
    public function getRolesByParentID(int $parent_id = 0)
    {
        $roles = $this->getRoles();
        $result = [];
        foreach ($roles as $role) {
            if ($role->getParentId() == $parent_id){
                $role->children = $this->getRolesByParentID($role->getId());
                $result[] = $role;
            }
        }
        return $result;
    }

    /**
     * @return Roles[]
     */
    public function getRoles()
    {
        if (! $this->roles){
            $this->roles = Roles::findAll()->getResult();
        }

        return $this->roles;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRoleByID(int $id)
    {
        return Roles::findById($id)->getResult();
    }
}