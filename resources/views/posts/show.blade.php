@extends('layouts.layout') <!--подключение к шаблону layout-->
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2>{{ $post->title }}</h2></div>
                <div class="card-body">
                    <div class="card-img card-img__max" style="background-image: url({{ $post->img ?? asset('img/default.jpg')
}})"></div>
                    <div class="card-author">Автор: {{ $post->name }}</div>
                    <div class="card-date">Пост создан: {{ $post->created_at->diffForHumans() }}</div>
                    <div class="card-btn">
                        <a href="{{ route('post.index') }}" class="btn btn-outline-primary">На главную</a>
                        <a href="{{ route('post.edit',['id'=>$post->post_id]) }}" class="btn btn-outline-success">Редактированть</a>
                        <form action="{{ route('post.destroy',['id'=>$post->post_id]) }}" class="btn btn-outline-danger"
                              method="post" onsubmit="if (confirm('точно удалить пост ?')){return true} else {return false}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-outline-danger" value="Удалить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



