<?php

declare (strict_types = 1);

/*
 * 跨域 Middleware
 *
 * @Created: 2020-09-27 20:16:47
 * @Author: yesc (yes.ccx@gmail.com)
 */

namespace App\Proxy\Kernel;

use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var ResponseInterface */
        $response = Context::override(ResponseInterface::class, function (ResponseInterface $response) use ($request): ResponseInterface {
            return $response->withHeader('Access-Control-Allow-Origin', $request->getHeader('Origin', ''))
                ->withHeader('Access-Control-Max-Age', 86400)
                ->withHeader('Access-Control-Allow-Credentials', 'true')
                ->withHeader('Access-Control-Allow-Headers', 'Keep-Alive,User-Agent,Cache-Control,Content-Type,Authorization,token');
        });

        // 204
        if ($request->getMethod() == 'OPTIONS') {
            return $response;
        }

        return $handler->handle($request);
    }
}
