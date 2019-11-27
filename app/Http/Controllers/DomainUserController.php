<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Distributor;
use GuzzleHttp\Client;

class DomainUserController extends Controller
{
    private $apiclient;
    public function __construct()
    {
        $this->middleware('auth');
        $this->apiclient = new Client(['base_uri' => 'https://chibchawebapi.herokuapp.com/']);
    }

    public function index()
    {
        $distributors = Distributor::all();
        return view('users.domain.domain')->with('distributors', $distributors);
    }
    public function register(Request $request)
    {
        
    }
}
