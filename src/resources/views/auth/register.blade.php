@extends('layouts.app', [
    'authButton' => 'login',
    'pageClass' => 'auth-page'
    ])

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>

    <form action="/register" class="form" method="post">
        @csrf
        <div class="form__group">
            <label class="form__label">お名前</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="例：山田　太郎"/>
                <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
                </div>
            
            <label class="form__label">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com" />
                <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
                </div>
            
            <label class="form__label">パスワード</label>
            <input type="password" name="password" placeholder="例：coachtech1106">
                <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
                </div>

            <div class="form__button">
                <button class="form__button-submit">登録</button>
            </div>
            
        </div>
    </form>
</div>


@endsection