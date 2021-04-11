<?php

declare (strict_types = 1);

namespace App\Model;

use App\Model\Libs\BaseModel;

/**
 * @property int $id 自增id
 * @property string $remote_url 远程url地址
 * @property int $user_id 用户id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @mixin \App_Model_File
 */
class File extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'remote_url', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer'];
}
