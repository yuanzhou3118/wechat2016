<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatGroupMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_group_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->string('type',30)->nullable();
            $table->string('url',300)->nullable();
            $table->string('key',40)->nullable();
            $table->integer('sort_num');//二级菜单排序
            $table->boolean('is_button');//是否为父级菜单
            $table->integer('button_id');//二级菜单与一级菜单的绑定
            $table->string('media_id',100)->nullable();
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
        Schema::drop('wechat_group_menu_items');
    }
}
