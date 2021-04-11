<?php

declare (strict_types = 1);

namespace App\Service\User;

use App\Event\User\UserRegistered;
use App\Exception\ServiceException;
use App\Model\User;
use App\Request\User\UserService;
use App\Service\BcryptService;
use App\Service\Libs\BaseService;
use Hyperf\Di\Annotation\Inject;

/**
 * 用户注册相关
 */
class UserRegisterService extends BaseService
{
    /**
     * 用户信息查询
     *
     * @Inject()
     * @var UserService
     */
    protected $userSrv;

    /**
     * 账号注册
     *
     * @param string $username 账号
     * @param string $password 密码
     * @param string $email 邮箱
     * @return User
     * @throws ServiceException
     */
    public function accountRegister(string $username, string $password, string $email = '')
    {
        // 判断用户名是否存在
        if ($this->userSrv->checkUsernameExists($username)) {
            throw new ServiceException('用户名已存在');
        }

        // 判断邮箱是否存在
        if (!empty($email) && $this->userSrv->checkEmailExists($email)) {
            throw new ServiceException('邮箱已存在');
        }

        // 密码加密
        $password = di(BcryptService::class)->make($password);

        $user = User::query()->create([
            'username' => $username,
            'password' => $password,
            'email'    => $email,
        ]);
        if (empty($user)) {
            throw new ServiceException('用户注册失败，请重试');
        }

        event(new UserRegistered($user));

        return $user;
    }
}
