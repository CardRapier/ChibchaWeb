<?php

namespace App\Http\Controllers;

use App\Mail\DomainMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show()
    {
        return view('domain');
    }

    public function available()
    {
        $add = ['.com', '.net', '.es', '.org'];

        $data =  request()->validate([
            'domain' => ['required', 'string'],
        ]);

        $curl = curl_init();
        $urlArray = explode(".", $data['domain']);

        $url = $urlArray[0];
        if (sizeof($urlArray) == 2) {
            $url = $urlArray[0];
        } else if (sizeof($urlArray) == 3) {
            $url = $urlArray[1];
        }
        for ($i = 0; $i < sizeof($add); $i++) {
            $domain = $url . $add[$i];

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ote-godaddy.com/v1/domains/available?domain={$domain}&checkType=FAST&forTransfer=false",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "application/json",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    'Content-Type: application/json',
                    'Authorization: sso-key 3mM44UaCaqRSmW_MUo6n4r5tiKsMBeQTLPQYL:AaFRJWKDxMgoXLBRu2VonY'
                ),
            ));
            
            $validation = json_decode(curl_exec($curl), true);
            if(!isset($validation['code'])) {
                $response[$i] = $validation;

                if (!isset($response[$i]['code']) and $response[$i]['available'] == true) {
                    $response[$i]['price'] = $response[$i]['price'] / 1000000;
                    $response[$i]['message'] = 'Available domain';
                } else {
                    $response[$i]['message'] = 'Not available domain or taken';
                }
            }
        }
        if(sizeof($response) == 0) {
            $response[0]['code'] = 'Not_found';
            $response[0]['message'] = 'Not domain available or similar';
        }

        $err = curl_error($curl);
        
        curl_close($curl);
        session()->put('response',$response);
        return redirect('domain')->with('responses', $response);
    }

    public function email()
    {
        return view('domainEmail');
    }

    public function sendEmail() {
        $domains = session()->get('response');

        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        Mail::to($data['email'])->send(new DomainMail($domains));

        return view('domainEmail')->with('responses', $domains)->with('successMsg','Email was sent.');; 
    }
}
