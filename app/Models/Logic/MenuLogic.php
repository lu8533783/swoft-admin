<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/14
 * Time: 15:58
 */

namespace App\Models\Logic;

use App\Models\Entity\Menu;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 * Class MenuLogic
 * @package App\Models\Logic
 */
class MenuLogic
{
    private $encodeLabels = true;
    private $hideEmptyItems = true;
    private $activateItems = true;
    private $activateParents = true;

    private $itemOptions = [];
    public $labelTemplate = '<span>{label}</span>';
    public $linkTemplate = '<a href="{url}">{icon} {label}</a>';
    public $defaultIconHtml = '<i class="fa fa-circle-o"></i> ';
    public static $iconClassPrefix = 'fa fa-';
    public $activeCssClass = 'active';
    public $firstItemCssClass;
    public $lastItemCssClass;
    public $submenuTemplate = "\n<ul class='treeview-menu' {show}>\n{items}\n</ul>\n";

    /**
     * @return string
     */
    public function getMenu()
    {
        $menus = $this->getMenuToArray();
        $assigned = array_keys($menus);
        $menus = $this->normalizeMenu($assigned, $menus, null, null);

        return "<ul class='sidebar-menu tree' data-widget='tree'>{$this->renderItems($menus)}</ul>";
    }

    /**
     * @return array
     */
    public function getMenuToArray()
    {
        $result = [];
        /* @var Menu $menu */
        foreach (Menu::findAll()->getResult() as $menu){
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
                        'label' => $menu['name'],
                        'url' => $menu['route'],
                    ];
                    if ($menu['children'] != []) {
                        $item['items'] = $menu['children'];
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

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, $item['options'] ?? []);
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }
            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $menu .= strtr($this->submenuTemplate, [
                    '{show}' => $item['active'] ? "style='display: block'" : '',
                    '{items}' => $this->renderItems($item['items']),
                ]);
                if (isset($options['class'])) {
                    $options['class'] .= ' treeview';
                } else {
                    $options['class'] = 'treeview';
                }
            }
            $lines[] = "<li class='{$options['class']}'>$menu</li>";
        }
        return implode("\n", $lines);
    }

    protected function renderItem($item)
    {
        if (isset($item['items'])) {
            $labelTemplate = '<a href="{url}">{icon} {label} <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
            $linkTemplate = '<a href="{url}">{icon} {label} <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }

        $replacements = [
            '{label}' => strtr($this->labelTemplate, ['{label}' => $item['label'],]),
            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml
                : '<i class="' . self::$iconClassPrefix . $item['icon'] . '"></i> ',
            '{url}' => isset($item['url']) ? $item['url'] : 'javascript:void(0);',
        ];

        $template = $item['template'] ?? isset($item['url']) ? $linkTemplate : $labelTemplate;

        return strtr($template, $replacements);
    }

    protected function normalizeItems($items, & $active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? htmlspecialchars($item['label']) : $item['label'];
            $items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems /*&& $this->isItemActive($item)*/) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }
        return array_values($items);
    }
}