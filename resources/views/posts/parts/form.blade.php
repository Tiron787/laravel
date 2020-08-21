
<div class="form-group">
            <input  name="title" type="text" class="form-control"  required value="{{ old('title') ?? $post->title ?? '' }}"> <!--вводил ли что-то пользователь в сессии | если не существует то мы находимся в форме создания поста-->
        </div>
        <div class="form-group">
            <textarea name="descr" rows="10" class="form-control" required>{{ old('descr') ?? $post->descr ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" name="img">
</div>
