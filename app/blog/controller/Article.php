<?php

namespace app\blog\controller;

use app\BaseController;
use app\blog\model\Article as ArticleModel;
use think\facade\Cache;
class Article extends BaseController
{
    public function index()  {
        $page = (int)input('page', 1);
        $key  = "blog_list_$page";
        $html = Cache::store('redis')->get($key);

        if (!$html) {
            $list = \app\blog\model\Article::order('id', 'desc')->paginate(5);
            $html = view('index', ['list' => $list])->getContent();
            Cache::store('redis')->set($key, $html, 300); // 5 分钟
        }

        return $html;
    }
    public function read($id){
        $art = ArticleModel::findOrFail($id);
        return view('read', ['art' => $art]);
    }

}