@extends("layout.main")
@section("content")
    <div class="col-sm-8 blog-main">
        <form action="/posts" method="POST">
            {{--这两句话一样的效果，都是为了加上token，token是为了标识这是自己渲染的网页，而不是别人的网页注入的提交--}}
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content" style="height:400px;max-height:500px;" name="content"
                          class="form-control" placeholder="这里是内容"></textarea>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
        @if(count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif

    </div><!-- /.blog-main -->
@endsection
