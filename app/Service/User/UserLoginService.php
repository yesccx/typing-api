<?php

declare (strict_types = 1);

namespace App\Service\User;

use App\Event\User\UserLogined;
use App\Exception\ServiceException;
use App\Request\User\UserService;
use App\Service\BcryptService;
use App\Service\Libs\BaseService;
use Hyperf\Di\Annotation\Inject;

/**
 * 用户登录
 */
class UserLoginService extends BaseService
{
    /**
     * 用户信息查询
     *
     * @Inject()
     * @var UserService
     */
    protected $userSrv;

    /**
     * 密码处理
     *
     * @Inject()
     * @var BcryptService
     */
    protected $bcryptSrv;

    /**
     * 用户会话jwt
     *
     * @Inject()
     * @var UserSessionJwtService
     */
    protected $sessionJwt;

    /**
     * 账号登录
     *
     * @param string $username
     * @param string $password
     * @return array token
     * @throws ServiceException
     */
    public function accountLogin(string $username, string $password): array
    {
        $user = $this->userSrv->getUserByUsername($username);
        if (empty($user)) {
            throw new ServiceException('账号不存在');
        }

        if (!$this->bcryptSrv->check($password, $user->password)) {
            throw new ServiceException('密码错误');
        }

        event(new UserLogined($user));

        // 生成token
        return $this->sessionJwt->make($user);
    }

}
