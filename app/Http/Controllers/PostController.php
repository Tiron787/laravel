<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::join('users', 'author_id', '=', 'users.id') //если такой реквест есть то также объеденяем таблицы
            ->where('title', 'like', '%' . $request->search . '%')//ищим набор символов в заголовках title
            ->orWhere('deskr', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            return view('posts.index', compact('posts'));
        }
        $posts = Post::join('users', 'author_id', '=', 'users.id')//1.таблица с которой хотим связаться.2.покаким полям устанавливаем связь.3.
        ->orderBy('posts.created_at', 'desc')// (таблица-поле)сортировка, посты выводяться от самого свежего.
        ->paginate(4);                      //Будем выводить по 4 поста на страницу
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new post();
        $post->title = $request->title; //то что ввёл пользователь
        // хелпер str
        $post->short_title = Str::length($request->title) > 30 ? Str::substr($request->title, 0, 30) . '...' :
            $request->title;
        $post->descr = $request->descr;
        $post->author_id = rand(1,4);
        if ($request->file('img')) {  //сли в request  усть файл то
            $path = \Storage::putFile('public', $request->file('img'));
            $url = \Storage::url($path);     //создадим ссылку на нашу картинку которую сохранили в папке public
            $post->img = $url;
        }
        $post->save();
        return redirect()->route('post.index')->with('success', 'пост успешно создан'); //Ключ\ то что будет написано в флешке
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::join('users', 'author_id', '=', 'users.id')
        ->find($id);
        return view('posts.show',compact('post'));//postS!
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = post::find($id);
        $post->title = $request->title; //то что ввёл пользователь
        // хелпер str
        $post->short_title = Str::length($request->title) > 30 ? Str::substr($request->title, 0, 30) . '...' :
            $request->title;
        $post->descr = $request->descr;
        if ($request->file('img')) {  //сли в request  усть файл то
            $path = \Storage::putFile('public', $request->file('img'));
            $url = \Storage::url($path);     //создадим ссылку на нашу картинку которую сохранили в папке public
            $post->img = $url;
        }
        $post->update();
        $id = $post->post_id;
        return redirect()->route('post.show', compact('id'))->with('success', 'пост успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with('success', 'пост успешно удалён');
    }
}
