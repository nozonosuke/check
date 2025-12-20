<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body class="{{ $pageClass ?? '' }}">
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>

            {{-- 右上ボタン --}}
            <div class="header__nav">
                @switch($authButton ?? null)

                    @case('login')
                        <a href="{{ route('login') }}" class="header__button">
                            login
                        </a>
                        @break

                    @case('register')
                        <a href="{{ route('register') }}" class="header__button">
                            register
                        </a>
                        @break

                    @case('logout')
                        @if (Auth::check())
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="header__button">
                                    logout
                                </button>
                            </form>
                        @endif
                        @break

                    @default
                        {{-- ボタンを表示しない --}}
                @endswitch
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>