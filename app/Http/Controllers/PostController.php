<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // 验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $user_id = Auth::id();
        $params = array_merge(\request(['title', 'content']), compact('user_id'));
        // 逻辑
        $post = Post::create($params);

        // 渲染
        return redirect('/posts');
    }

    // 编辑页面
    public function edit(Post $post) {
        return view('post/edit', compact('post'));
    }

    // 编辑逻辑
    public function update(Post $post) {
        $this->validate(\request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $post->title = \request('title');
        $post->content = \request('content');

        $post->save();

        return redirect('/posts/' . $post->id);
    }

    public function delete(Post $post) {
        // TODO 用户验证

        $post->delete();

        return redirect('/posts');
    }

    // 上传图片
    public function imageUpload(Request $request) {
        $file = $request->file('wangEditorH5File');

//        $path = $file->storePublicly($file->getFilename());
        $path = $file->storePublicly(md5(time()));
//        dd(request()->all());
        return asset('storage/' . $path);
    }

}
