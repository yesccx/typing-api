<?php

declare (strict_types = 1);

namespace App\Request\User;

use App\Request\Traits\RequestDefaultAuthorizen;
use Hyperf\Validation\Request\FormRequest;

/**
 * 用户注册 验证器
 */
class UserRegisterRequest extends FormRequest
{

    use RequestDefaultAuthorizen;

    /**
     * 验证规则
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => ['bail', 'required', 'regex:/^[a-zA-z0-9@.-_!#]*$/', 'min:4', 'max:32'],
            'password' => ['bail', 'required', 'regex:/^[a-zA-z0-9@.-_!#]+$/', 'min:6', 'max:64'],
            'email'    => ['bail', 'nullable', 'email'],
        ];
    }

    /**
     * 验证错误的自定义属性
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email'    => '邮箱',
        ];
    }

    /**
     * 验证错误的自定义错误消息
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'username.regex' => ':attribute 不能包含特殊字符',
            'password.regex' => ':attribute 不能包含特殊字符',
        ];
    }
}
