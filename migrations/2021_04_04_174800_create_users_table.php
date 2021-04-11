<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Db;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自增id');
            $table->unsignedInteger('headimg_id')->default(0)->comment('头像文件id(0为默认头像)');
            $table->string('username', 64)->default('')->comment('用户名');
            $table->string('password', 255)->default('')->comment('密码');
            $table->string('nickname', 32)->default('')->comment('昵称');
            $table->string('phone', 11)->default('')->comment('手机号');
            $table->string('email', 64)->default('')->comment('邮箱');
            $table->unsignedTinyInteger('gender')->default(0)->comment('性别;0-未知,1-男,2-女');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态;0-禁用,1-启用');
            $table->timestamp('last_login_at')->nullable()->comment('最后登录时间');
            $table->timestamps();
            $table->softDeletes();
        });
        Db::statement("ALTER TABLE `users` comment '用户表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
