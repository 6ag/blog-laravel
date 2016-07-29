<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'name' => '网站名称',
                'alias' => 'website_title',
                'content' => 'iOS技术博客',
                'field_type' => 'input',
                'field_value' => null,
                'order' => 1,
            ] , [
                'name' => '网站子标题',
                'alias' => 'website_subtitle',
                'content' => '一个不错的博客！',
                'field_type' => 'input',
                'field_value' => null,
                'order' => 2,
            ], [
                'name' => '网站域名',
                'alias' => 'website_url',
                'content' => 'http://www.blog.6ag',
                'field_type' => 'input',
                'field_value' => null,
                'order' => 3,
            ], [
                'name' => '网站SEO关键词',
                'alias' => 'website_keywords',
                'content' => '博客,六阿哥,iOS',
                'field_type' => 'input',
                'field_value' => null,
                'order' => 4,
            ], [
                'name' => '网站SEO描述',
                'alias' => 'website_description',
                'content' => '这是一个博客系统啊',
                'field_type' => 'input',
                'field_value' => null,
                'order' => 5,
            ], [
                'name' => '版权信息',
                'alias' => 'copyright',
                'content' => '<p>Design by 六阿哥博客 <a href="http://www.blog.com/" target="_blank">http://www.blog.com/</a></p>',
                'field_type' => 'textarea',
                'field_value' => null,
                'order' => 6,
            ], [
                'name' => '网站状态',
                'alias' => 'website_state',
                'content' => '1',
                'field_type' => 'radio',
                'field_value' => '1|开启,0|关闭',
                'order' => 7,
            ]
        ]);

    }
}
