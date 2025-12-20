@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <!--お名前の入力-->
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                </div>
                <div class="form__error">
                    @error('last_name')
                    {{ $message }}
                    @enderror
                    @error('first_name')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--性別の選択-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text form__input--radio">
                    <label>
                        <input type="radio" name="gender" value="1" value="{{ old('gender') }}" />
                        男性
                    </label>
                    <label for="">
                        <input type="radio" name="gender" value="2" value="{{ old('gender') }}" />
                        女性
                    </label>
                    <label for="">
                        <input type="radio" name="gender" value="3" value="{{ old('gender') }}" />
                        その他
                    </label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--メールアドレスの入力-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--電話番号の入力-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}" />
                    -
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                    -
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                </div>
                <div class="form__error">
                    @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    {{ collect(['tel1','tel2','tel3'])
                        ->map(fn($f) => $errors->first($f))
                        ->filter()
                        ->first() }}
                    @endif

                
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--住所の入力-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--建物名の入力(必須ではないやつ)-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--お問い合わせの種類の選択（種類選択のvalueを書かんとあかん）-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->id }} . {{ $category->content }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <!--お問い合わせ内容の入力-->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください"></textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
                    <!--バリデーション機能を実装したら書く-->
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection