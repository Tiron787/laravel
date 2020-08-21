    @extends('layouts.layout', ['title'=>'главная страница']) <!--подключение к шаблону layout-->
    @section('content')

@if(isset($_GET['search'])) <!--если есть с ключом search-->
    @if(count($posts)>0)
        <h2>результаты поиска по запросу <?=$_GET['search']?></h2>
        <p class="lead">Всего найдено {{ count($posts) }} Постов</p>
    @else
        <h2>По запросу <?=$_GET['search']?> ничего не найдено</h2>
        <a href="{{ route('post.index') }}" class="btn btn outline-primary" >отоброзить все посты</a>
    @endif
    @endif
    <div class="row">
        @foreach($posts as $post)
            <div class="col-6">
                <div class="card">
                    <div class="card-header"><h2>{{ $post->short_title }}</h2></div>
                    <div class="card-body">
                        <div class="card-img"
                             style="background-image: url({{ $post->img ?? asset('img/default.jpg') }})"></div>
                        <div class="card-author">Автор: {{$post->name}}</div>
                        <a href="{{ route('post.show', ['id'=>$post->post_id]) }}" class="btn btn-outline-primary">Посмотреть пост</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(!isset($_GET['search']))<!--если поиск был то пагинация не нужна-->
        {{ $posts->links ()}} <!--метод links отвечает за ПАГИНАЦИЮ (по 4 поста)-->
    @endif
    @endsection

