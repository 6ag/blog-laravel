<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            [
                'name' => '六阿哥博客',
                'title' => '一个iOS技术博客',
                'url' => 'https://blog.6ag.cn/',
                'order' => 1,
            ], [
                'name' => '六阿哥网',
                'title' => '一个资讯网站',
                'url' => 'http://www.6ag.cn/',
                'order' => 2,
            ]
        ]);

    }
}
