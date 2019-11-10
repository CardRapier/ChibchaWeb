<?php

namespace App\Http\Controllers;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function show(){
        $packages = Package::all();
        //dd($packages);
        return view('products')->with('packages', $packages);
    }
}
