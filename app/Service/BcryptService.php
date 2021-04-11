<?php

declare (strict_types = 1);

namespace App\Service;

use App\Exception\ServiceException;
use App\Service\Libs\BaseService;

/**
 * 密码加密解密
 */
class BcryptService extends BaseService
{

    /**
     * 生成hash密码
     *
     * @param string $value 原始值要
     * @return string
     * @throws ServiceException
     */
    public function make(string $value): string
    {
        $hash = password_hash($value, PASSWORD_BCRYPT);

        if ($hash === false) {
            throw new ServiceException('不支持的加密方式');
        }

        return $hash;
    }

    /**
     * 验证密码是否正确
     *
     * @param string $value 原始值
     * @param string $hashedValue 加密的hash
     * @return boolean
     * @throws ServiceException
     */
    public function check(string $value, string $hashedValue): bool
    {
        if (strlen($hashedValue) === 0) {
            return false;
        } else if ($this->info($hashedValue)['algoName'] !== 'bcrypt') {
            throw new ServiceException('不支持的加密方式');
        }

        return password_verify($value, $hashedValue);
    }

    /**
     * 获取加密的hash信息
     *
     * @param string $hashedValue 加密的hash
     * @return array 信息集
     */
    public function info(string $hashedValue): array
    {
        return password_get_info($hashedValue);
    }

}
