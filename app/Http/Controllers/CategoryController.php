<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $search='%%';
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $categories = DB::table('categories')
            ->select('categories.*')
            ->where('name','like',$search)
            ->paginate(5);
        return view('admin.category_manager.index',compact('categories','LoginName','LoginEmail'));
    }

    public function create()
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        return view('admin.category_manager.create',compact('LoginName','LoginEmail'));
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
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $categories = Category::findorFail($id);
        return view('admin.category_manager.edit',compact('categories','LoginName','LoginEmail'));
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
