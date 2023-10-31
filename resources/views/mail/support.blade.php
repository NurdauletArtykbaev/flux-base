<p>Пользователь - {{ $user->name ?? null }}</p>
<p>Письмо - {{ $support->description }}</p>
@if(!is_null($support->file))
    <p>Файл - {{ env('AWS_URL').'support.blade.php/'.$support->file }}</p>
@endif
