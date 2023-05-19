<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    public function welcome(): View
    {
        return view('welcome');
    }
    
    

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if($request->has('user_image')){
            // dd($request->file('user_image')->getClientOriginalName());
            $imageName = time().'.'.$request->file('user_image')->getClientOriginalName();  
            $request->file('user_image')->storeAs('uploads', $imageName, 'public');
        }
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'user_image' => $imageName?? null,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'department_id' => $request->department_id,
            'batch' => $request->batch,
            'semester' => $request->semester,
        ]);
           
        // event(new Registered($user));
        
        return redirect(route('welcome'));
        // Auth::login($user);


        // return redirect(RouteServiceProvider::HOME);
    }
}
