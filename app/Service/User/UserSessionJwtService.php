<?php

declare (strict_types = 1);

namespace App\Service\User;

use App\Exception\ServiceException;
use App\Model\User;
use App\Service\Libs\BaseService;
use Exception;
use Hyperf\Di\Annotation\Inject;
use Phper666\JWTAuth\JWT;

/**
 * 用户会话jwt token
 */
class UserSessionJwtService extends BaseService
{
    /**
     * jwt-auth
     *
     * @Inject()
     * @var JWT
     */
    protected $jwt;

    /**
     * 构造jwt token
     *
     * @param User $user 用户
     * @return array
     * @throws ServiceException
     */
    public function make(User $user): array
    {
        try {
            $token = $this->jwt->getToken([
                'user_id' => $user->id,
            ]);
        } catch (Exception $e) {
            throw new ServiceException('token生成异常');
        }

        return [
            'token' => $token,
            'exp'   => $this->jwt->getTTL(),
        ];
    }
}
