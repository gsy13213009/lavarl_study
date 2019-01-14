<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function setting() {
        return view('user/setting');
    }

    public function settingStore() {

    }

    public function show(User $user) {
        // 这个人的信息，包含关注，粉丝，文章
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);
        // 这个人的额文章列表，取前10条
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        // 这个人的关注用户，包换关注用户的  关注，粉丝，文章数
        $stars = $user->stars();
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();
        // 找个人的粉丝用户，包括粉丝用户的  关注，粉丝，文章数
        $fans = $user->fans();
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();

        return view('user/show', compact('user', 'posts', 'susers', 'fusers'));
    }

    public function fan(User $user) {
        $me = Auth::user();
        $me->doFan($user);

        return [
            'error' => 0,
            'msg' => '',
            'uid' => $user->id,
            'meuid' => $me->id
        ];
    }

    public function unfan(User $user) {
        $me = Auth::user();
        $me->doUnFan($user->id);

        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
