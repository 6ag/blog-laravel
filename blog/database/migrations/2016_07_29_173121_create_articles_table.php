<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('title', 100)->comment('文章标题');
            $table->string('tags', 100)->nullable()->comment('文章tags');
            $table->string('writer', 50)->nullable()->comment('文章作者');
            $table->string('seo_keywords', 100)->nullable()->comment('文章SEO关键词');
            $table->string('seo_description')->nullable()->comment('文章SEO描述');
            $table->string('thumb', 100)->nullable()->comment('文章缩略图');
            $table->string('intro')->nullable()->comment('文章简介');
            $table->text('content')->comment('文章内容');
            $table->integer('view')->default(0)->comment('文章浏览量');
            $table->integer('category_id')->comment('文章分类id');
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
        Schema::drop('articles');
    }
}
