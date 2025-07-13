<?php

use think\migration\Seeder;
use think\facade\Db;
class NoteArticleSeeder extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run():void
    {
        // 清空旧数据（可选）
        Db::execute('TRUNCATE TABLE note_articles');

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
        Db::table('note_articles')->insertAll($rows);
    }


}