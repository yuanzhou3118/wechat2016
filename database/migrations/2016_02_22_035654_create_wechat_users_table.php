<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid',100)->unique();
            $table->string('nickname',100);
            $table->integer('sex')->nullable();
            $table->string('city',10)->nullable();
            $table->string('province',10)->nullable();
            $table->string('headimgurl',1000)->nullable();
            $table->string('subscribe_time',50);
            $table->string('status_time',50)->nullable();
            $table->integer('subscribe');
            $table->timestamps();
            $table->integer('groupid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wechat_users');
    }
}
