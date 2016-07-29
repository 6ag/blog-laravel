<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name')->comment('配置项名称');
            $table->string('alias')->unique()->comment('配置项别名');
            $table->text('content')->comment('配置项内容');
            $table->string('field_type')->nullable()->comment('配置项文本类型');
            $table->string('field_value')->nullable()->comment('配置项文本内容');
            $table->tinyInteger('order')->default(0)->comment('配置项排序');
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
        Schema::drop('configs');
    }
}
