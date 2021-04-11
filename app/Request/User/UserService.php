<?php

declare (strict_types = 1);

namespace App\Request\User;

use App\Model\User;
use App\Service\Libs\BaseService;

/**
 * 用户相关
 */
class UserService extends BaseService
{
    /**
     * 判断用户账号是否已存在
     *
     * @param string $username 用户名
     * @return boolean
     */
    public function checkUsernameExists(string $username): bool
    {
        return User::query()->where(['username' => $username])->exists();
    }

    /**
     * 判断用户邮箱是否存在
     *
     * @param string $email 邮箱
     * @return boolean
     */
    public function checkEmailExists(string $email): bool
    {
        return User::query()->where(['email' => $email])->exists();
    }

    /**
     * 根据用户名获取用户信息
     *
     * @param string $username 用户名
     * @return User|null
     */
    public function getUserByUsername(string $username)
    {
        return User::query()->where(['username' => $username])->first();
    }
}
