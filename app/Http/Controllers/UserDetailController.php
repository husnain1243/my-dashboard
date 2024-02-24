<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserDetailController extends Controller
{
    function UserDetail($id){
        $data['users'] = User::where('id' , $id)->first();
        return view('admin.userdetail' , $data);
    }
}
