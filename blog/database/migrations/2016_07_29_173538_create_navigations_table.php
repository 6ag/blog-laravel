<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name')->comment('导航栏名称');
            $table->string('alias')->comment('导航栏别名');
            $table->string('url')->comment('导航栏连接');
            $table->tinyInteger('order')->default(0)->comment('导航栏排序');
            $table->integer('pid')->default(0)->comment('父导航栏id');
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
        Schema::drop('navigations');
    }
}
