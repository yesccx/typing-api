<?php

declare (strict_types = 1);

namespace App\Middleware;

use App\Utils\Common\AppHttpResponse;
use Hyperf\HttpServer\CoreMiddleware as HyperfCoreMiddleware;
use Hyperf\Utils\Contracts\Arrayable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/*
 * core Middleware
 * PS: 用于重写hyperf core中间件
 */
class CoreMiddleware extends HyperfCoreMiddleware
{
    /**
     * Handle the response when cannot found any routes.
     * TODO: 目前仅处理了miss route
     *
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleNotFound(ServerRequestInterface $request)
    {
        return AppHttpResponse::error('not found');
    }

    /**
     * Handle the response when the routes found but doesn't match any available methods.
     * TODO: 目前仅处理了miss route
     *
     * @return array|Arrayable|mixed|ResponseInterface|string
     */
    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request)
    {
        return AppHttpResponse::error('not found(not allowed)');
    }

}
