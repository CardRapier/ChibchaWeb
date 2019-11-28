<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function update()
    {

        $user = auth()->user();
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'cellphone_number' => ['string', 'nullable', Rule::unique('users')->ignore($user->id)],
        ]);

        if ($data['name'] <> $user->name or $data['last_name'] <> $user->last_name or $data['cellphone_number'] <> $user->cellphone_number) {
            auth()->user()->update($data);
            return redirect('/profile')->with('message', 'Data has been updated successfully');
        } else {
            return redirect('/profile');
        }
    }

    public function update_password()
    {
        $user = auth()->user();
        $data = request()->validate([
            'old-password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&_-]/', 'confirmed'],
        ]);

        $oldpassword = $data['old-password'];
        $password = auth()->user()->password;

        if (Hash::check($oldpassword, $password)) {
            $user->password = Hash::make($data['password']);
            $user->save();
            return redirect('/profile')->with('message', 'Password has been updated successfully');
        } else {
            return redirect('/profile');
        }
    }
    public function userEdit($id){
        $userForEdit = User::FindOrFail($id);
        return view('users.admin.userEdit', compact('userForEdit'));
    }
    public function editUserAdmin(Request $request,$id){
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'cellphone_number' => ['string', 'nullable'],
        ]);
        $userNewInfo= User::FindOrFail($id);
        $userNewInfo->name=$request->name;
        $userNewInfo->last_name=$request->last_name;
        $userNewInfo->cellphone_number=$request->cellphone_number;
        $userNewInfo->save();
        return redirect('/admin/users')->with('editUserAdmin');

    }
    public function userEditPassword(Request $request , $id){
        $userNewPassword= User::FindOrFail($id);
        $data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&_-]/', 'confirmed'],
        ]);
        
            $userNewPassword->password = Hash::make($data['password']);
            $userNewPassword->save();
            return redirect('/admin/users')->with('userEditPassword', 'Password has been updated successfully');

        
    }
}
