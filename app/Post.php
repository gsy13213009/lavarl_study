<?php

namespace App;

use Laravel\Scout\Searchable;

class Post extends Model {

    use Searchable;

    /**
     * 定义搜索的type
     */
    public function searchableAs() {
        return 'post';
    }

    public function toSearchableArray() {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }


    /**
     * 文章关联用户
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * 评论模型
     */
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function zan($user_id) {
        return $this->hasOne(Zan::class)->where('user_id', $user_id);
    }

    /**
     * 文章的所有赞
     */
    public function zans() {
        return $this->hasMany(Zan::class);
    }
}
