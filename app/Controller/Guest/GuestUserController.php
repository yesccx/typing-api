<?php

declare (strict_types = 1);

namespace App\Controller\Guest;

use App\Controller\BaseController;
use App\Request\User\UserLoginRequest;
use App\Request\User\UserRegisterRequest;
use App\Service\User\UserLoginService;
use App\Service\User\UserRegisterService;
use Hyperf\DbConnection\Db;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * 游客用户相关 控制器
 */
class GuestUserController extends BaseController
{
    /**
     * 注册
     *
     * @param UserRegisterRequest $request
     * @param UserRegisterService $registerSrv
     * @return PsrResponseInterface
     */
    public function register(UserRegisterRequest $request, UserRegisterService $registerSrv): PsrResponseInterface
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        $email = $request->input('email', '');

        $user = Db::transaction(function () use ($registerSrv, $username, $password, $email) {
            return $registerSrv->accountRegister($username, $password, $email);
        });

        return $this->responseSuccess('注册成功');
    }

    /**
     * 登录
     *
     * @param UserLoginRequest $request
     * @return PsrResponseInterface
     */
    public function login(UserLoginRequest $request, UserLoginService $loginSrv): PsrResponseInterface
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');

        $token = Db::transaction(function () use ($loginSrv, $username, $password) {
            return $loginSrv->accountLogin($username, $password);
        });

        return $this->responseData($token);
    }

}
