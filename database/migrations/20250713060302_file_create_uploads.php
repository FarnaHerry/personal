<?php

use think\migration\Migrator;
use think\migration\db\Column;

class FileCreateUploads extends Migrator
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
        $this->table('file_uploads')
            ->addColumn('name',       'string',  ['limit' => 255])
            ->addColumn('path',       'string',  ['limit' => 500])
            ->addColumn('size',       'integer', ['default' => 0])
            ->addColumn('mime',       'string',  ['limit' => 100])
            ->addColumn('created_at', 'datetime')
            ->create();
    }
}
