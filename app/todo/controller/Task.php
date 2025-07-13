<?php
namespace app\todo\controller;

use app\BaseController;
use app\todo\model\Task as TaskModel;
use think\facade\Request;

class Task
{
    public function index()
    {
        $list = TaskModel::order('sort','asc')->select();
        return view('', ['list' => $list]);
    }

    public function save()
    {
        TaskModel::create(Request::only([
            'title','content','priority','plan_at'
        ]));
        return json(['code'=>0,'msg'=>'ok']);
    }

    public function update($id)
    {
        $task = TaskModel::find($id);
        if ($task->status == 0) {
            $task->status = 1;
            $task->finished_at = date('Y-m-d H:i:s');
            $task->save();
            return json(['code'=>0,'msg'=>'done']);
        } else {
            $task->status = 0;
            $task->finished_at = null;
            $task->save();
            return json(['code'=>0,'msg'=>'reset']);
        }
    }

    public function delete($id)
    {
        TaskModel::destroy($id);
        return json(['code'=>0,'msg'=>'del']);
    }

    /* 拖拽排序 */
    public function sort()
    {
        $ids = Request::post('ids');
        foreach ($ids as $index=>$id) {
            TaskModel::update(['sort'=>$index],['id'=>$id]);
        }
        return json(['code'=>0,'msg'=>'sorted']);
    }

    /* 番茄钟完成+1 */
    public function pomodoro($id)
    {
        TaskModel::where('id',$id)->inc('pomodoro')->update();
        return json(['code'=>0,'msg'=>'+1']);
    }
}
