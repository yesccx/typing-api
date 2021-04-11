<?php

declare (strict_types = 1);

namespace App\Event\User;

use App\Model\User;

/**
 * 用户登录后 事件
 */
class UserLogined
{
    /**
     * 用户信息
     *
     * @var User
     */
    public $user;

    /**
     * @param User $user 用户信息
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
