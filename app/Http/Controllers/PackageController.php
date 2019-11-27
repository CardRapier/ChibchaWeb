<?php

namespace App\Http\Controllers;
use App\Package;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    public function show(){
        $packages = Package::all();
        
        return view('products')->with('packages', $packages);
    }

    public function contact(){
        return view('contact');
    }
    public function contactEmail(){
        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'message'=> ['required','string']
        ]);
        Mail::to($data['email'])->send(new ContactMail($data['message']));
        return view('contact');
    }
}
