<?php

declare (strict_types = 1);

namespace App\Model;

use App\Model\Libs\BaseModel;

/**
 * @property int $id 自增id
 * @property int $headimg_id 头像文件id(0为默认头像)
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $nickname 昵称
 * @property string $phone 手机号
 * @property string $email 邮箱
 * @property int $gender 性别;0-未知,1-男,2-女
 * @property int $status 状态;0-禁用,1-启用
 * @property string $last_login_at 最后登录时间
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @mixin \App_Model_User
 */
class User extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'headimg_id', 'username', 'password', 'nickname', 'phone', 'email', 'gender', 'status', 'last_login_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'headimg_id' => 'integer', 'gender' => 'integer', 'status' => 'integer'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'deleted_at'];

    // 关联: 用户头像文件
    public function headimg()
    {
        return $this->belongsTo(File::class, 'headimg_id')->withDefault([
            'remote_url' => '',
        ]);
    }
}
