<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name')->comment('分类名称');
            $table->string('intro')->nullable()->comment('简介');
            $table->string('seo_keywords', 100)->nullable()->comment('分类SEO关键词');
            $table->string('seo_description')->nullable()->comment('分类SEO描述');
            $table->integer('view')->default(0)->comment('分类浏览量');
            $table->integer('pid')->default(0)->comment('上一级分类id');
            $table->tinyInteger('order')->default(0)->comment('分类排序');
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
        Schema::drop('categories');
    }
}
