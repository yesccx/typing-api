<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Db;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->comment('自增id');
            $table->string('remote_url', 255)->default('')->comment('远程url地址');
            $table->unsignedBigInteger('user_id')->default(0)->comment('用户id');
            $table->timestamps();
            $table->softDeletes();
        });
        Db::statement("ALTER TABLE `files` comment '文件表'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
}
