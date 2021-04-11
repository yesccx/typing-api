<?php

declare (strict_types = 1);

namespace App\Event\User;

use App\Model\User;

/**
 * 用户注册后 事件
 */
class UserRegistered
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
