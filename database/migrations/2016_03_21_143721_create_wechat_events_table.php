<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50)->unique();
            $table->boolean('is_menu');
            $table->string('type', 50);
            $table->string('text', 500)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('url', 500)->nullable();
            $table->string('image', 500)->nullable();
            $table->string('media_id', 200)->nullable();
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
        Schema::drop('wechat_events');
    }
}
