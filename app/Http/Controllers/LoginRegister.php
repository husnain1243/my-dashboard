<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class LoginRegister extends Controller
{

    function Dashboard(){
        $data['users'] = User::get();
        $data['pageTitle'] = 'Dashboard';
        return view('admin.dashboard' , $data);
    }

    function login(){
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    function register(){
        return view('auth.register');
    }

    function update($id)
    {
        $data['users'] = User::where('id' , $id)->first();
        return view('admin.update' , $data);
    }
    function ForgetPassword(){
        return view('auth.forgetpassword');
    }

    public function UserLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // dd('success');
            return redirect()->route('Dashboard');
        }
        if (!Auth::attempt($credentials)){
            return redirect()->route('login')->with('error', 'Oppes! You have entered invalid credentials');
        }
    }

    public function create(Request $request)
    {
        // dd("error");die();
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,tiff,webp,ico|max:2048'
        ]);
        // dd($request);

        $Mediaextension = $request->image->getClientOriginalExtension();
        $Mediafilename = $request->image->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->image->move(public_path('media_uploads') , $Mediafilename);

        $data = new User;
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->image = $Mediafilename;
        $data->password = Hash::make($request->password);
        $data->save();

        if (!$data->id) {
            return redirect(route('register'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Registered successfully");

    }

    public function Userdelete($id)
    {


        // session()->flash('error', 'No users present.');


        $user = User::findOrFail($id);

        if (Media::where('path' ,$user->image )->exists()) {
            $MediaDelete = Media::where('path' ,$user->image )->first();
            $filePath = public_path('media_uploads/' . $MediaDelete->path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $MediaDelete->delete();
        }

        $user->delete();
        return redirect()->route('Dashboard')->with('success', 'User deleted successfully');



    }

    public function updateUserRecord(Request $request , $id)
    {
        // dd($request);die();
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // dd($request);die();

        $Mediaextension = $request->image->getClientOriginalExtension();
        $Mediafilename = $request->image->getClientOriginalName();
        $Mediatitle = pathinfo($Mediafilename, PATHINFO_FILENAME);

        $Media = new Media();
        $Media->title = $Mediatitle;
        $Media->extension = $Mediaextension;
        $Media->path = $Mediafilename;
        $Media->save();

        $request->image->move(public_path('media_uploads') , $Mediafilename);

        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->image = $Mediafilename;
        $data->password = Hash::make($request->password);
        $data->save();

        if ($data->id) {
            return redirect(route('/Dashboard'))->with("success", "Registered successfully");
        }
    }

    function UserForgetPassword(Request $request){
        $data = User::where('email' , $request->email)->first();
        if(!empty($data)){
            // Mail::to($request->email)->send(new ForgetPassMail($data));
            if($request->password == $request->repassword){
                $data->password = Hash::make($request->password);
                $data->save();
                if ($data) {
                    return redirect(route('login'))->with("success", "password successfully changed");
                }
            }
            dd('ReEnter password are different. Enter again');
        }
        dd('email not match');
    }

}
