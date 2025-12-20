@extends('layouts.app', [
    'authButton' => 'register',
    'pageClass' => 'auth-page'
    ])

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <h2>Login</h2>
    </div>

    <form action="/login" class="form" method="post">
        @csrf
        <div class="form__group">
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
                <button class="form__button-submit">ログイン</button>
            </div>
        </div>
    </form>
</div>

@endsection