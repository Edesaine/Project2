<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.category_manager.index',compact('categories'));
    }
    public function create()
    {
        return view('admin.category_manager.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
        ]);
        Category::create([
            'name'=>$request->name,
        ]);
        return redirect('category/create')->with('status','Category Added');
    }
    public function edit(int $id)
    {
        $categories = Category::findorFail($id);
        return view('admin.category_manager.edit',compact('categories'));
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'country'=>'required|max:255|string',
        ]);
        Category::findorFail($id)->update([
            'name'=>$request->name,
            'country'=>$request->country
        ]);
        return redirect()->back()->with('status','Category Updated');
    }
    public function delete(int $id)
    {
        $categories = Category::FindOrFail($id);
        $categories->delete();
        return redirect()->back()->with('status','Category Deleted');
    }
}
