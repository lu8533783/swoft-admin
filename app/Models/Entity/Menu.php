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
 * @Entity()
 * @Table(name="menu")
 * @uses      Menu
 */
class Menu extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $name 
     * @Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var int $parent 
     * @Column(name="parent", type="integer")
     */
    private $parent;

    /**
     * @var string $route 
     * @Column(name="route", type="string", length=256)
     */
    private $route;

    /**
     * @var int $order 
     * @Column(name="order", type="integer")
     */
    private $order;

    /**
     * @var string $data 
     * @Column(name="data", type="binary", length=65535)
     */
    private $data;

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
     * @param string $value
     * @return $this
     */
    public function setName(string $value): self
    {
        $this->name = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setParent(int $value): self
    {
        $this->parent = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRoute(string $value): self
    {
        $this->route = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setOrder(int $value): self
    {
        $this->order = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setData(string $value): self
    {
        $this->data = $value;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

}
