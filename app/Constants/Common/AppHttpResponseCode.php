<?php

declare (strict_types = 1);

namespace App\Constants\Common;

use App\Constants\Libs\BaseCode;
use Hyperf\Constants\Annotation\Constants;

/**
 * 应用Http响应状态码
 *
 * @Constants
 */
class AppHttpResponseCode extends BaseCode
{

    /**
     * @Message("success")
     */
    const SUCCESS = 1000;

    /**
     * @Message("error")
     */
    const ERROR = 1100;

    /**
     * @Message("session invalid")
     */
    const SESSION_INVALID = 1200;

}
