<?php

namespace App\Request\Traits;

/**
 * 表单验证器默认鉴权
 */
trait RequestDefaultAuthorizen
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
