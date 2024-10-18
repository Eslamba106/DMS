<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function loginPage(){
        
        return view('auth.login');
    }
    public function registerPage(){
        
        return view('auth.register');
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = User::where('email', $request['email'])->first();
            auth()->login($user);
            return redirect()->route('dashboard');

            // if($user->role_name != "admin"){
            //     return redirect()->route('home');
            // }elseif ($user->role_name == "admin") {
            //     return redirect()->route('admin.dashboard');
            // }
        } 
            // elseif(Auth::attempt(['user_name' => $request['email'], 'password' => $request['password']])){
            //     $user = User::where('user_name', $request['email'])->first();
            //     auth()->login($user);
            //     return redirect()->route('dashboard');

            // }
        else {
            return back()->withErrors([
                'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
            ]);
        }

        

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login-page');
    }
    public function register(RegisterRequest $request){

        // if($request->image){
            
        //     $file = uploadImage($request , "users" , "image");
        // }        
        // $user_name = Str::slug($request->name.rand(100 , 635635) , '-');
        $user = User::create([
            'name' => $request->name,
            // 'phone' => $request->phone,
            // 'user_name' => $user_name,
            'role_name' => 'user',
            'role_id' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'image' => $file ?? null,

        ]);
        auth()->login($user);
        return redirect()->route('dashboard');
    }

}
