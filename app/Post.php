<?php

namespace App;

class Post extends Model {
    /**
     * 文章关联用户
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
