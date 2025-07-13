<?php
declare (strict_types = 1);

namespace app\file\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Upload extends Model
{
    protected $table = 'file_uploads';
}
