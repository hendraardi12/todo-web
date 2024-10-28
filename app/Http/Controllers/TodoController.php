<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    public function create(Request $request){
        Todo::create($request->all());
        return back();
    }

    public function update(Request $request){
        Todo::find($request->id)->update($request->all());
        return back();
    }

    public function update_status($id,$status){
        Todo::find($id)->update(['status' => $status]);
        return back();
    }

    public function delete($id){
        Todo::find($id)->delete();
        return back();
    }
}
