@extends('layouts.layout') <!--подключение к шаблону layout-->
@section('content')

    <form action="{{ route('post.update',['id'=>$post->post_id]) }}" method="post" enctype="multipart/form-data">
    @csrf  <!--защита. ставится токен для записи -->
        @method('PATCH')
        <h3>Редактировать пост</h3>

        @include('posts.parts.form')
        <input type="submit" value="Редактировать пост" class="btn btn-online-success">
    </form>

@endsection


