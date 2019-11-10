<?php

namespace App\Http\Controllers;
use App\Hosting;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAll()
    {
        $hostings = Hosting::all();
        return view('users.hosting.hosting')->with('hostings', $hostings);
    }
}
