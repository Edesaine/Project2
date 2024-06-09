<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $search='%%';
        $publishers = DB::table('publishers')
            ->select('publishers.*')
            ->where('name','like',$search)
            ->paginate(5);
        return view('admin.publisher_manager.index',compact('publishers','LoginEmail','LoginName'));
    }

    public function create()
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        return view('admin.publisher_manager.create',compact('LoginName','LoginEmail'));
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
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $publishers = Publisher::findorFail($id);
        return view('admin.publisher_manager.edit',compact('publishers','LoginEmail','LoginName'));
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
