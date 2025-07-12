<?php
declare (strict_types = 1);

namespace app\blog\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Article extends Model
{
    protected $table = 'blog_articles';
}
