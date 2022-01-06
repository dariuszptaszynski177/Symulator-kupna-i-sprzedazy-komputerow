<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

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
}
