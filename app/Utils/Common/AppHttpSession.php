<?php

declare (strict_types = 1);

namespace App\Utils\Common;

use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;

/**
 * 用户Http会话
 */
class AppHttpSession
{
    /**
     * 获取用户id
     *
     * @return int 用户id
     */
    public static function getUserId(): int
    {
        return Context::get(ServerRequestInterface::class)->getAttribute('user_id', 0);
    }
}
