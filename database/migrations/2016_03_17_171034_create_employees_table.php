<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_card', 50)->unique();
            $table->string('cn_name', 50)->nullable();
            $table->string('en_name', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->string('txt_1', 100)->nullable();
            $table->string('txt_2', 100)->nullable();
            $table->string('txt_3', 100)->nullable();
            $table->string('txt_4', 100)->nullable();
            $table->string('txt_5', 100)->nullable();
            $table->string('txt_6', 100)->nullable();
            $table->string('txt_7', 100)->nullable();
            $table->string('txt_8', 100)->nullable();
            $table->string('txt_9', 100)->nullable();
            $table->boolean('campaign_status');//是否可以参加活动。
            $table->integer('type');
            $table->boolean('status');
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
        Schema::drop('employees');
    }
}
