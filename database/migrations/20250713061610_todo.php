<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Todo extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('todo_task');
        $table->addColumn('title',       'string',  ['limit' => 120])
            ->addColumn('content',     'text',    ['null' => true])
            ->addColumn('priority',    'integer', ['default' => 0])        // 0普通 1重要 2紧急
            ->addColumn('status',      'boolean', ['default' => 0])        // 0待办 1完成
            ->addColumn('sort',        'integer', ['default' => 0])        // 拖拽排序
            ->addColumn('pomodoro',    'integer', ['default' => 0])        // 已用番茄数
            ->addColumn('plan_at',     'datetime',['null' => true])        // 计划完成时间
            ->addColumn('finished_at', 'datetime',['null' => true])
            ->addTimestamps()
            ->create();
    }
}
