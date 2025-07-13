<?php
namespace app\todo\model;

use think\Model;
use think\model\concern\SoftDelete;

class Task extends Model
{
    use SoftDelete;
    protected $table = 'todo_task';
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;
    protected $type = [
        'plan_at'     => 'datetime',
        'finished_at' => 'datetime',
    ];
}