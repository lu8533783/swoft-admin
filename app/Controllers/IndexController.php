<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/14
 * Time: 10:50
 */

namespace App\Controllers;

use App\Models\Logic\MenuLogic;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\View\Bean\Annotation\View;

/**
 * @Controller(prefix="/index")
 * Class IndexController
 * @package App\Controllers
 */
class IndexController
{
    /**
     * @Inject()
     * @var MenuLogic
     */
    private $menuLogic;

    /**
     * @RequestMapping()
     * @View(template="index/index", layout="layouts/default.php")
     */
    public function index()
    {
        return [
            'menu' => $this->menuLogic->getMenu()
        ];
    }
}