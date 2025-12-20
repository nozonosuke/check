<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        //categoriesテーブルから全件取得
        $categories = Category::all();

        //index.blade.phpに渡す
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        // 電話番号をまとめるなど加工が必要ならここで
        $contact = $request->all();
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        Contact::create($request->all());

        return view('thanks');
    }
}
