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
    }

    public function index()
    {
        $distributors = Distributor::all();
        return view('users.domain.domain')->with('distributors', $distributors);
    }
    public function register(Request $request)
    {
        $data =  request()->validate([
            'id'=>'',
            'email' => ['required', 'string','email'],
            'distributor'=>['required','string'],
            'domain'=>['required','string']
        ]);
        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com:3000/']);
        /* Ejemplo de get con GUZZLE
        $r = $client->request('GET', '',[]);
        $body = $r->getBody();
        $stringBody = (string) $body;
        dd($stringBody); 
        */
        $r = $client->request('POST','save',[
            'json'=>$data
        ]);
        $body = $r->getBody();
        $stringBody = (string) $body;
        $res = json_decode($stringBody);
        $message = "Domain registered succesfully";
        $insertId=$res->insertId;
        if($insertId==0){
            $message = "An error occurred while registering the domain";
        }
        $distributors = Distributor::all();
        return view('users.domain.domain')->with(['distributors'=> $distributors,'message'=>$message,'insertId'=>$insertId]);
    }

    public function transfer(Request $request)
    {
        $data =  request()->validate([
            'id'=>'',
            'distributor'=>['required','string'],
            'domain'=>['required','string']
        ]);
        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com:3000/']);
        $r = $client->request('POST','transfer',[
            'json'=>$data
        ]);
        $body = $r->getBody();
        $stringBody = (string) $body;
        $res = json_decode($stringBody);
        $message2 = "Domain transfered succesfully";
        $insertId=$res->insertId;
        if($insertId==0){
            $message2 = "An error occurred while tranfering the domain or the domain already exist, Try again!";
        }
        $distributors = Distributor::all();
        return view('users.domain.domain')->with(['distributors'=> $distributors,'message2'=>$message2,'insertId'=>$insertId]);
    }
}
