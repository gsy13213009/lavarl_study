<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller {

    public function index() {
        $posts = Post::orderBy('created_at', 'dest')->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post) {
        $isShow = true;
        return view('post/show', compact('post', 'isShow'));
    }

    public function create() {
        return view('post/create');
    }

    public function edit() {
        return view('post/edit');
    }

}
