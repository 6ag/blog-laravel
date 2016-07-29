<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => '示例',
                'intro' => '这是一个示例分类',
                'seo_keywords' => '文章,视频',
                'seo_description' => '这是一个示例分类的描述',
            ]
        ]);
    }
}
