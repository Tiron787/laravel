@extends('layouts.layout', ['title'=>"Создать новый пост"]) <!--подключение к шаблону layout-->
@section('content')

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf  <!--защита. ставится токен для записи -->
        <h3>Создать пост</h3>
       @include('posts.parts.form')

<input type="submit" value="Создать пост" class="btn btn-online-success">
    </form>

@endsection


