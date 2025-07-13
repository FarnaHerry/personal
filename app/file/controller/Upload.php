<?php

namespace app\file\controller;
use app\BaseController;
use app\file\model\Upload as UploadModel;
use think\facade\Request;
use think\facade\View;



class Upload extends BaseController
{
    // 上传表单
    public function index()
    {
        return View::fetch('index');
    }

    // 接收上传
    public function upload()
    {
        $file = Request::file('file');
        if (!$file) return json(['msg' => '请选择文件']);

        $info = $file->move(public_path() . 'uploads');
        if (!$info) return json(['msg' => $file->getError()]);

        UploadModel::create([
            'name' => $info->getSaveName(),
            'path' => '/uploads/' . str_replace('\\', '/', $info->getSaveName()),
            'size' => $info->getSize(),
            'mime' => $info->getMime(),
        ]);

        return json(['msg' => '上传成功']);
    }

    // 文件列表
    public function list()
    {
        $files = UploadModel::order('id', 'desc')->paginate(10);
        return View::fetch('list', ['files' => $files]);
    }
}