@extends('layouts.app', [
    'authButton' => 'logout',
    'pageClass' => 'admin-page'
    ])

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection



@section('content')
<div class="admin__content">
    <div class="admin__heading">
        Admin
    </div>


    <!--成功・エラーメッセージ表示-->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif    

    <!--検索行-->
    <form action="/search" class="form" method="get">
        
        <!--部分検索機能(後で機能を書く)-->
        <div class="form__search">
            <input type="text" name="name" value="{{ request('name') }}" placeholder="名前やメールアドレスを入力してください" />
        </div>
        
        <!--性別選択機能(後で機能を書く)-->
        <select name="gender" class="gender">
            <option value="">性別</option>
            <option value="">全て</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <!--問い合わせ種類選択機能(後で機能実装する)-->
        <select name="category_id" class="category">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category -> content }}
                </option>
            @endforeach
        </select>

        <!--日付検索-->
        <input type="date" name="date" value="{{ request('date') }}">

        <div class="form__button">
            <button class="form__button-search">検索</button>
            <button type="reset" class="form__button-reset" onclick="location.href='/reset'">リセット</button>
        </div>
    </form>

    <!--エクスポート%ページネーション-->
        <div class="admin__control">
            <div class="admin__export">
                <button class="admin__export-button">エクスポート</button>
            </div>

            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </div>
    

    <!--一覧テーブル-->
    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__row">
                <th class="admin-table__header">
                    お名前
                </th>
                <th class="admin-table__header">
                    性別
                </th>
                <th class="admin-table__header">
                    メールアドレス
                </th>
                <th class="admin-table__header">
                    お問い合わせの種類
                </th>
                <th class="admin-table__header">
                    <!--詳細列-->
                </th>
            </tr>

            @foreach($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__text">
                    {{ $contact->last_name }} {{ $contact->first_name }}
                </td>
                <td class="admin-table__text">
                    {{ ['','男性','女性','その他'][$contact->gender] ?? '' }}
                </td>
                <td class="admin-table__text">
                    {{ $contact->email }}
                </td>
                <td class="admin-table__text">
                    {{ $contact->category_id }}
                </td>
                <td class="admin-table__text">
                    <button type="button" class="admin-table__text-detail" onclick="openModal({{ $contact->id }})">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>

        
    </div>
</div>

<!-- モーダル -->
@foreach($contacts as $contact)
<div id="modal-{{ $contact->id }}" class="modal">
    <div class="modal__content">
        <span class="modal__close" onclick="closeModal({{ $contact->id }})">&times;</span>
        
        <div class="modal__detail">
            <div class="modal__detail-row">
                <span class="modal__detail-label">お名前</span>
                <span class="modal__detail-text">{{ $contact->last_name }} {{ $contact->first_name }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">性別</span>
                <span class="modal__detail-text">{{ ['','男性','女性','その他'][$contact->gender] ?? '' }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">メールアドレス</span>
                <span class="modal__detail-text">{{ $contact->email }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">電話番号</span>
                <span class="modal__detail-text">{{ $contact->tel }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">住所</span>
                <span class="modal__detail-text">{{ $contact->address }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">建物名</span>
                <span class="modal__detail-text">{{ $contact->building }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">お問い合わせの種類</span>
                <span class="modal__detail-text">{{ $contact->category->content ?? '' }}</span>
            </div>
            
            <div class="modal__detail-row">
                <span class="modal__detail-label">お問い合わせ内容</span>
                <span class="modal__detail-text">{{ $contact->detail }}</span>
            </div>
        </div>
        
        <form action="/admin/delete/{{ $contact->id }}" method="post">
            @csrf
            @method('DELETE')
            <button class="modal__delete-button" type="submit">削除</button>
        </form>
    </div>
</div>
@endforeach

<script src="{{ asset('js/admin.js') }}"></script>
@endsection