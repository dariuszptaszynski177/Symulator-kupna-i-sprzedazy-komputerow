<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Computer;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $admin = auth()->user()->id;
        $users = User::where('id', '!=', $admin)->get();
        return view('admin.users', ['users'=>$users]);
        
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $value = $request->value;

        if($value==0)
        {
            $status=1;
        }
        else
        {
            $status=0;
        }

        $update = User::where('id', '=', $id)->update(['active'=>$status]);

        $admin = auth()->user()->id;

        $users = User::where('id', '!=', $admin)->get();
        $content = view('admin.users_list', compact('users'))->render();
        return response()->json(['users'=>$content]);
    }

    public function computers()
    {
        $computers = Computer::get();

        return view('admin.computers.index', ['computers'=>$computers]);
    }

    public function computer_create()
    {
        return view('admin.computers.create');
    }

    public function computer_save(Request $request)
    {
        $name = $request->name;
        $price = $request->price;

        $computer = new Computer;
        $computer->name = $name;
        $computer->price = $price;

        $save = $computer->save();

        if($save)
        {
            return redirect()->route('computers');
        }
    }

    public function computer_edit($id)
    {
        $computer = Computer::where('id', '=', $id)->first();

        return view('admin.computers.edit', ['computer'=>$computer]);
    }

    public function computer_update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;

        $update = Computer::where('id', '=', $id)->update(['name'=>$name, 'price'=>$price]);

        if($update)
        {
            return redirect()->route('computers');
        }
    }
}
