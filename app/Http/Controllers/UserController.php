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
        $card_number = $user->payment === null ? '' : $user->payment->card_number;
        $card_type = '';

        if ($card_number <> null and $card_number[0] === '4') {
            $card_type = "Visa";
        } else {
            $card_type = "Master Card";
        }
        
        $card_number = substr($card_number, -4);
        return view('users.profile', compact('user', 'card_number', 'card_type'));
    }

    public function update()
    {

        $user = auth()->user();
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'cellphone_number' => ['string', 'nullable', Rule::unique('users')->ignore($user->id)],
        ]);

        if ($data['name'] <> $user->name or $data['last_name'] <> $user->last_name or $data['email'] <> $user->email or $data['cellphone_number'] <> $user->cellphone_number) {
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
            $user->password = $data['password'];
            $user->save();
            return redirect('/profile')->with('message', 'Password has been updated successfully');
        } else {
            return redirect('/profile');
        }
    }
}
