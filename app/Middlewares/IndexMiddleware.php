<?php
/**
 * Created by PhpStorm.
 * User: lu xiao (8533783@qq.com)
 * Date: 2018/9/25
 * Time: 15:38
 */

namespace App\Middlewares;

use App\Utils\Message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Http\Message\Server\Response;

/**
 * @Bean()
 */
class IndexMiddleware implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = session()->get('userId');
        if (empty($userId)) {
            $content = Message::error(Message::E_NO_LOGIN);
            return \response()->json($content);
        }

        $request = $request->withAttribute('userId', $userId);
        return $handler->handle($request);
    }
}