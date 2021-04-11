<?php

declare (strict_types = 1);

namespace App\Exception\Handler;

use App\Exception\ServiceException;
use App\Utils\Common\AppHttpResponse;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 服务层异常 Handler
 */
class ServiceExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        return AppHttpResponse::error($throwable->getMessage());
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ServiceException;
    }
}
