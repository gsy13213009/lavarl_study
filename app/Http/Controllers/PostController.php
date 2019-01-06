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

    public function store() {

//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();

//        $params = ['title' => request('title'), 'content' => request('content')];

//        $params = request(['title', 'content']);
//        Post::create($params);

        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);


        $post = Post::create(request(['title', 'content']));

        dd($post);
    }

    public function edit() {
        return view('post/edit');
    }

}
