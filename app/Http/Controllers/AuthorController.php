<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $search='%%';
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $authors = DB::table('authors')
            ->select('authors.*')
            ->where('name','like',$search)
            ->paginate(4);
        return view('admin.author_manager.index',compact('authors','LoginName','LoginEmail'));
    }

    public function create()
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        return view('admin.author_manager.create',compact('LoginName','LoginEmail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'country'=>'required|max:255|string',
        ]);
        Author::create([
            'name'=>$request->name,
            'country'=>$request->country
        ]);
        return redirect('author/create')->with('status','Author Added');
    }

    public function edit(int $id)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');

        $author = Author::findorFail($id);
        return view('admin.author_manager.edit',compact('author','LoginName','LoginEmail'));
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'country'=>'required|max:255|string',
        ]);
        Author::findorFail($id)->update([
            'name'=>$request->name,
            'country'=>$request->country
        ]);
        return redirect()->back()->with('status','Author Updated');
    }
    public function delete(int $id)
    {
        $author = Author::FindOrFail($id);
        $author->delete();
        return redirect()->back()->with('status','Author Deleted');
    }
}
