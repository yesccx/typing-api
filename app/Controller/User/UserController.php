<?php

declare (strict_types = 1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\AppException;
use App\Model\User;
use App\Utils\Common\AppHttpSession;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * 用户相关 控制器
 */
class UserController extends BaseController
{
    /**
     * 用户信息
     *
     * @return PsrResponseInterface
     */
    public function info(): PsrResponseInterface
    {
        $userId = AppHttpSession::getUserId();

        $user = User::query()->find($userId);
        if (empty($user)) {
            throw new AppException('用户信息不存在');
        }

        $user->load(['headimg']);

        return $this->responseData($user);
    }
}
