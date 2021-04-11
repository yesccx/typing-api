<?php

declare (strict_types = 1);

namespace App\Exception\Handler;

use App\Utils\Common\AppHttpResponse;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 全局异常 Handler
 * PS: 未被拦截的所有异常，将都在这里被拦截
 */
class GlobalExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();

        $this->logger->error(
            sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile())
        );
        $this->logger->error($throwable->getTraceAsString());

        return AppHttpResponse::error(config('app_debug', false) ? $throwable->getMessage() : '内部错误');
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
