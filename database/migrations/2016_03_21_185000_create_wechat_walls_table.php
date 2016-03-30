<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatWallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_walls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('theme', 50)->unique();
            $table->string('keyword',50)->unique();
            $table->string('title', 150)->nullable();
            $table->string('logo', 300)->nullable();
            $table->string('tdcode', 300)->nullable();
            $table->string('bg_img', 500)->nullable();
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
        Schema::drop('wechat_walls');
    }
}
