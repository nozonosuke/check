<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{    
    public function index(Request $request)
    {
        $query = Contact::with('category');

        /*1. 名前・メール検索*/
        if ($request ->filled('name')){
            $keyword = $request->name;

            $query->where(function ($q) use ($keyword){
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        /*2. 性別検索*/
        if ($request->filled('gender')){
            $query->where('gender', $request->gender);
        }

        /*3. お問い合わせ種類*/
        if ($request->filled('category_id')){
            $query->where('category_id', $request->category);
        }

        /*4. 日付検索*/
        if ($request->filled('date')){
            $query->whereDate('created_at', $request->date);
        }

        /*並び順・ページネーション*/
        $contacts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->appends($request->query()); // <-検索条件をページ遷移で保持

        $categories = Category::all();
        
        return view('admin', compact('contacts', 'categories'));
    }

    /*検索画面（/search）*/
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /*リセット画面（/reset）*/
    public function reset()
    {
        return redirect('/admin');
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    /*削除機能*/
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if($contact){
            $contact->delete();
            return redirect('/admin')->with('success', 'お問い合わせを削除しました');
        }

        return redirect ('/admin')->with('error', 'お問い合わせが見つかりませんでした');
    }
}
