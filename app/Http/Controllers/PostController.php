<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller {

    public function index() {
        $posts = [
            [
                'title' => "this is title 1"
            ],
            [
                'title' => 'this is title 2'
            ],
            [
                'title' => 'this is title 3'
            ],
            [
                'title' => 'this is title 3'
            ],
            [
                'title' => 'this is title 3'
            ],
            [
                'title' => 'this is title 3'
            ],
            [
                'title' => 'this is title 3'
            ],
            [
                'title' => 'this is title 3'
            ]
        ];
        return view('post/index', compact('posts'));
    }

    public function show() {
        return view('post/show', ['title'=>'你好哦你好', 'isShow' => true]);
    }

    public function create() {
        return view('post/create');
    }

    public function edit() {
        return view('post/edit');
    }

}
