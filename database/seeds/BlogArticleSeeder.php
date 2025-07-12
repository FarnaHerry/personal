<?php

use think\migration\Seeder;
use think\facade\Db;

class BlogArticleSeeder extends Seeder
{
    public function run():void
    {
        // 清空旧数据（可选）
        Db::execute('TRUNCATE TABLE blog_articles');

        // 批量插入 20 条
        $rows = [];
        for ($i = 1; $i <= 20; $i++) {
            $rows[] = [
                'title'      => '第' . $i . '篇博客',
                'content'    => '这是第' . $i . '段正文，支持 **Markdown**。',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        Db::table('blog_articles')->insertAll($rows);
    }
}