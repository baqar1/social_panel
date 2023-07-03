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
            $image = $request->file('user_image');

            $imageName = time().'.'.$request->file('user_image')->extension();
            $image->move(public_path('uploads'), $imageName);
        }

        $user = User::create([
            'name' => $request->name,
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
    }

    public function accountEdit($id)
{
    $users = User::find($id);
    if (!$users) {
        abort(404); // User not found, handle the error accordingly
    }

    return view('admin.account_setting')->with('users', $users);
}







    /**
     * Update the specified resource in storage.
     */
    public function accountUpdate(Request $request, string $id)
    {
        $user = User::find($id);

        if ($request->has('user_image')) {
            $image = $request->file('user_image');
            $imageName = time().'.'.$request->file('user_image')->extension();
            $image->move(public_path('uploads'), $imageName);
        }
        else{
            $imageName = $user->user_image;
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        // $user->email = $request->email;
        //$user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->user_image =$imageName ?? null;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->department_id = $request->department_id;
        $user->batch = $request->batch;
        $user->semester = $request->semester;

        $user->save();

        return redirect(route('account_edit',[$id]))->with('success','Updated Successfully');
    }


}
