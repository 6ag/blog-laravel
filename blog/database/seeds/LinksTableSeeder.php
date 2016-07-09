<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => '六阿哥博客',
                'link_title' => '一个iOS技术博客',
                'link_url' => 'https://blog.6ag.cn/',
                'link_order' => 1,
            ],
            [
                'link_name' => '六阿哥网',
                'link_title' => '一个资讯网站',
                'link_url' => 'http://www.6ag.cn/',
                'link_order' => 2,
            ],
        ];

        \Illuminate\Support\Facades\DB::table('links')->insert($data);
    }
}
