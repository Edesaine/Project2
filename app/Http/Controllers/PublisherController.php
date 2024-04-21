<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;
class PublisherController extends Controller
{
    public function index()
    {
        $publishers = publisher::get();
        return view('admin.publisher_manager.index',compact('publishers'));
    }
    public function create()
    {
        return view('admin.publisher_manager.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
        ]);
        Publisher::create([
            'name'=>$request->name,
        ]);
        return redirect('publisher/create')->with('status','Publisher Added');
    }
    public function edit(int $id)
    {
        $publishers = Publisher::findorFail($id);
        return view('admin.publisher_manager.edit',compact('publishers'));
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name'=>'required|max:255|string',
        ]);
        Publisher::findorFail($id)->update([
            'name'=>$request->name,

        ]);
        return redirect()->back()->with('status','Publisher Updated');
    }
    public function delete(int $id)
    {
        $publishers = Publisher::FindOrFail($id);
        $publishers->delete();
        return redirect()->back()->with('status','Publisher Deleted');
    }
}
