<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatGroupMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_group_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menuid',50);
            $table->string('group_id',50)->nullable();
            $table->string('sex',10)->nullable();
            $table->string('client_platform_type',10)->nullable();
            $table->string('country',20)->nullable();
            $table->string('province',20)->nullable();
            $table->string('city',20)->nullable();
            $table->string('language',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wechat_group_menus');
    }
}
