<?php

declare (strict_types = 1);

namespace App\Constants\Common;

use App\Constants\Libs\BaseCode;
use Hyperf\Constants\Annotation\Constants;

/**
 * 应用公用Code
 *
 * @Constants
 */
class AppCommonCode extends BaseCode
{
    /**
     * @Message("会话场景 PC")
     */
    const SESSION_SCREEN__PC = 'PC';
}
