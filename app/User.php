<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
    protected $fillable = ['name', 'email', 'password'];

    // 用户的文章列表
    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // 关注我的fan模型
    public function fans() {
        return $this->hasMany(Fan::class, 'star_id', 'id');
    }

    // 我关注的start模型
    public function stars() {
        return $this->hasMany(Fan::class, 'fan_id', 'id');
    }

    // 关注
    public function doFan(User $funUser) {
        $fan = new Fan();
        $fan->star_id = $funUser->id;
        return $this->stars()->save($fan);
    }

    // 取消关注
    public function doUnFan($uid) {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    // 当前用户是否被 uid 关注了
    public function hasFan($uid) {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    // 当前用户是否关注了uid
    public function hasStar($uid) {
        return $this->stars()->where('star_id', $uid)->count();
    }

}
