<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/20
 * Time: 16:00
 */

namespace App\Middlewares;

use App\Models\Dao\RolesDao;
use App\Models\Entity\AdminUser;
use App\Models\Entity\Roles;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Zend\Permissions\Rbac\Rbac;
use Zend\Permissions\Rbac\Role;

/**
 * @Bean()
 * Class RbacMiddleware
 * @package App\Middlewares
 */
class RbacMiddleware implements MiddlewareInterface
{
    /**
     * @var Rbac
     */
    private $rbac;

    public function __construct()
    {
        $this->rbac = new Rbac();
        $this->registerRoles(App::getBean(RolesDao::class)->getRolesByParentID());
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var AdminUser $userInfo */
        $userInfo = session()->get('userInfo');
        $path = $request->getUri()->getPath();

        if (! $userInfo){
            throw new \Exception("not found userInfo");
        }

        if (! $this->rbac->isGranted($userInfo->role->getName(), $path)){
            throw new \Exception("Permission denied");
        }

        return $handler->handle($request);
    }

    /**
     * @param Roles[] $roles
     */
    public function registerRoles(array $roles)
    {
        foreach ($roles as $role) {
            $_role = new Role($role->getName());

            // 添加权限
            if ($role->getPermissions()){
                array_map(function($v) use ($_role){
                    $_role->addPermission($v);
                }, explode(',', $role->getPermissions()));
            }

            // 注册子角色
            if ($role->children){
                $this->registerRoles($role->children);
                foreach ($role->children as $child) {
                    $_role->addChild($this->rbac->getRole($child->getName()));
                }
            }
            // 注册角色
            $this->rbac->addRole($_role);
        }
    }
}