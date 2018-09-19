<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/14
 * Time: 15:58
 */

namespace App\Models\Logic;

use App\Models\Entity\Menu;
use App\Utils\Message;
use App\Validate\MenuValidate;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 * Class MenuLogic
 * @package App\Models\Logic
 */
class MenuLogic
{
    /**
     * @return array
     */
    public function getMenu()
    {
        $menus = $this->getMenuToArray();
        $assigned = array_keys($menus);
        return $this->normalizeMenu($assigned, $menus, null, null);
    }

    /**
     * @param $data
     * @return array
     */
    public function addMenu($data)
    {
        $res = MenuValidate::quick($data)->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $menu = new Menu();
        $menu->setName($data['name']);
        $menu->setParent($data['parent']);
        $menu->setRoute($data['route']);
        $menu->setOrder($data['order']);

        if ($menu->save()->getResult())
            return Message::success(Message::SUCCESS);
        else
            return Message::error(Message::E_INSERT_DATA);
    }

    /**
     * @param $id
     * @param $data
     * @return array
     */
    public function updateMenu($id, $data)
    {
        $res = MenuValidate::quick($data)->validate();
        if ($res->fail())
            return Message::error(Message::E_PARAM, $res->firstError());

        $result = Menu::updateOne($data, ['id' => $id])->getResult();

        if ($result !== false)
            return Message::success(Message::SUCCESS);
        else
            return Message::error(Message::E_INSERT_DATA);
    }

    /**
     * @param $id
     * @return array
     */
    public function delMenu($id)
    {
        $result = Menu::deleteById($id)->getResult();;

        if ($result !== false)
            return Message::success(Message::SUCCESS);
        else
            return Message::error(Message::E_INSERT_DATA);
    }

    /**
     * @return array
     */
    public function getMenuToArray()
    {
        $result = [];
        /* @var Menu $menu */
        foreach (Menu::findAll()->getResult() as $menu) {
            $result[$menu->getId()] = $menu->toArray();
        }
        return $result;
    }

    /**
     * @param $assigned
     * @param $menus
     * @param $callback
     * @param null $parent
     * @return array
     */
    private function normalizeMenu(& $assigned, & $menus, $callback, $parent = null)
    {
        $result = [];
        $order = [];
        foreach ($assigned as $id) {
            $menu = $menus[$id];
            if ($menu['parent'] == $parent) {
                $menu['children'] = $this->normalizeMenu($assigned, $menus, $callback, $id);
                if ($callback !== null) {
                    $item = call_user_func($callback, $menu);
                } else {
                    $item = [
                        'title' => $menu['name'],
                        'jump'  => $menu['route'],
                        'name'  => $menu['route'],
                    ];
                    if ($menu['children'] != []) {
                        $item['list'] = $menu['children'];
                    }
                }
                $result[] = $item;
                $order[] = $menu['order'];
            }
        }
        if ($result != []) {
            array_multisort($order, $result);
        }

        return $result;
    }
}