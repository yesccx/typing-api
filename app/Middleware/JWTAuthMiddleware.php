<?php

declare (strict_types = 1);

namespace App\Middleware;

use App\Utils\Common\AppHttpResponse;
use Exception;
use Hyperf\Utils\Context;
use Phper666\JWTAuth\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JwtToken验证 中间件
 */
class JWTAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var JWT
     */
    protected $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Throwable
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('Authorization') ?? '';
        if (strlen($token) <= 0) {
            return AppHttpResponse::error('token不存在');
        }

        try {
            if (!$this->jwt->checkToken($token)) {
                return AppHttpResponse::error('token已无效');
            }

            $userId = $this->jwt->getParserData($token)['user_id'];
        } catch (Exception $e) {
            return AppHttpResponse::error('无效的token');
        }

        // 保存用户id到请求上下文
        $request = Context::override(
            ServerRequestInterface::class,
            function (ServerRequestInterface $request) use ($userId) {
                return $request->withAttribute('user_id', $userId);
            }
        );

        return $handler->handle($request);
    }
}
