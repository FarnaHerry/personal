<?php

use think\facade\Route;

Route::group('todo', function () {
    Route::resource('task', 'todo/Task');        // 生成 7 条 RESTful
    Route::post('task/sort', 'todo/Task/sort');
    Route::put('task/:id/pomodoro', 'todo/Task/pomodoro');
});