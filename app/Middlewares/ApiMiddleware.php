<?php
/**
 * Created by PhpStorm.
 * User: zcm
 * Date: 2018/9/19
 * Time: 10:39
 */

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Server\AttributeEnum;

/**
 * @Bean()
 * Class ApiMiddleware
 * @package App\Middlewares
 */
class ApiMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var Response $response*/
        $response = $handler->handle($request);
        $result = $response->getAttribute(AttributeEnum::RESPONSE_ATTRIBUTE);
        if (!isset($result['code'])){
            $result = [
                'code' => 0,
                'msg' => '',
                'data' => $result
            ];
        }
        return $response->withAttribute(AttributeEnum::RESPONSE_ATTRIBUTE, $result);
    }
}