<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::get();
        return view('admin.author_manager.index',compact('authors'));
    }
    public function create()
    {
        return view('author.create');
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
        $author = Author::findorFail($id);
        return view('author.edit',compact('author'));
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
