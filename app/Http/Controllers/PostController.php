<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function index() {
        $posts = Post::orderBy('created_at', 'dest')->withCount(['comments', 'zans'])->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post) {
        $post->load('comments');
        return view('post/show', compact('post'));
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

        $this->authorize('update', $post);

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

    public function comment(Post $post) {
        $this->validate(\request(), [
            'content' => 'required|min:3'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = \request('content');

        $post->comments()->save($comment);

        return back();
    }

    public function zan(Post $post) {
        $params = [
            'user_id' => Auth::id(),
            'post_id' => $post->id];

        // 如果有，就查找，没有就创建
        Zan::firstOrCreate($params);
        return back();
    }

    public function unzan(Post $post) {
        $post->zan(Auth::id())->delete();
        return back();
    }

    // 搜索结果页
    public function search() {
        $this->validate(request(),[
            'query' => 'required'
        ]);

        $query = request('query');
        $posts = Post::search($query)->get();
        dd($posts);
        return view('post/search', compact('posts', 'query'));
    }


}
