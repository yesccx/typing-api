<?php

declare (strict_types = 1);

namespace App\Utils\Common;

use App\Constants\Common\AppHttpResponseCode;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * 应用响应处理
 */
class AppHttpResponse
{

    /**
     * 响应数据
     *
     * @param array $data 数据
     * @return PsrResponseInterface
     */
    public static function data(array $data): PsrResponseInterface
    {
        return self::handleResponse(AppHttpResponseCode::SUCCESS, 'ok', $data);
    }

    /**
     * 响应成功
     *
     * @param string $message 说明
     * @return PsrResponseInterface
     */
    public static function success(string $message = 'ok'): PsrResponseInterface
    {
        return self::handleResponse(AppHttpResponseCode::SUCCESS, $message);
    }

    /**
     * 响应失败
     *
     * @param string $message 说明
     * @return PsrResponseInterface
     */
    public static function error(string $message = 'error'): PsrResponseInterface
    {
        return self::handleResponse(AppHttpResponseCode::ERROR, $message);
    }

    /**
     * 响应会话失效
     *
     * @param string $message 说明
     * @return PsrResponseInterface
     */
    public static function sessionInvalid(string $message = 'session invalid'): PsrResponseInterface
    {
        return self::handleResponse(AppHttpResponseCode::SESSION_INVALID, $message);
    }

    /**
     * 处理响应
     *
     * @param int $code 状态码
     * @param string $message 说明
     * @param array $data 数据
     * @return PsrResponseInterface
     */
    protected static function handleResponse(int $code, string $message = '', array $data = []): PsrResponseInterface
    {
        return di(ResponseInterface::class)->json(['code' => $code, 'message' => $message, 'data' => $data]);
    }
}
