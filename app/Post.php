<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
//    protected $guarded = []; // 模型中定义，不可以使用数据注入的字段，这里定义为[]，代表所有字段均可以注入
    protected $fillable = ['title', 'content']; // 模型中定义可以使用数组注入的字段， 对应Post::create(['title' => 'fdjlaj', 'content' => 'fdalsjfslafjls']);
}
