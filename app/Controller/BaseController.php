<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Utils\Common\AppHttpResponse;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Contracts\Arrayable;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * BaseController
 */
abstract class BaseController
{
    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * 响应数据
     *
     * @param mixed $data 数据
     * @return PsrResponseInterface
     */
    public function responseData($data): PsrResponseInterface
    {
        return AppHttpResponse::data($data instanceof Arrayable ? $data->toArray() : $data);
    }

    /**
     * 响应成功
     *
     * @param string $message 说明
     * @return PsrResponseInterface
     */
    public function responseSuccess(string $message = 'ok'): PsrResponseInterface
    {
        return AppHttpResponse::success($message);
    }

    /**
     * 响应失败
     *
     * @param string $message 说明
     * @return PsrResponseInterface
     */
    public function responseError(string $message = 'error'): PsrResponseInterface
    {
        return AppHttpResponse::error($message);
    }

}
