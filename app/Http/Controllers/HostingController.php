<?php

namespace App\Http\Controllers;

use App\Hosting;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Validation\Rule;
use App\Rules\DomainAvailable;

class HostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll()
    {
        $id = auth()->user()->id;
        $hostings = Hosting::all()->where('user_id', $id);
        return view('users.hosting.hosting')->with('hostings', $hostings);
    }

    public function show($user_id, $hosting_id)
    {
        $sizes = array();

        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $r = $client->request('GET', 'view.php', [
            'query' => ['user_id' => $user_id, 'name' => $hosting_id]
        ]);
        $files = json_decode($r->getHeader('Data')[0], true);
        if (!isset($files)) {
            $files = array();
        }
        if (isset($files)) {
            $sizes = array("size" => array_pop($files));
        }
        $hosting = Hosting::find($hosting_id);
        $user = User::find($user_id);
        return view('users.hosting.hostingShow')->with(['files' => $files, 'sizes' => $sizes, 'hosting' => $hosting, 'user' => $user]);
    }

    public function create()
    {
        $plans = [
            ['name' => 'Monthly', 'value' => '1'],
            ['name' => 'Quartely', 'value' => '3'],
            ['name' => 'Biannual', 'value' => '6'],
            ['name' => 'Annual', 'value' => '12'],
        ];

        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'packages' => Package::all(),
            'plans' => $plans,
        ];

        return view('users.hosting.hostingCreate')->with($data);
    }

    public function upload()
    {
        $data = request()->validate([
            'user' => 'required',
            'domain' => 'required',
            'fileToUpload' => ''
        ]);

        $file = request()->file('fileToUpload');
        $name = $file->getClientOriginalName();


        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $response = $client->request('POST', 'upload.php?user_id=' . $data['user'] . "&name=" . $data['domain'], [
            'multipart' => [
                [
                    'name'     => 'fileToUpload',
                    'contents' => file_get_contents($file),
                    'filename' => $name
                ]
            ]
        ]);

        return redirect('/hosting/show/' . $data['user'] . "/" . $data['domain']);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', Rule::unique('hostings')],
            'package' => ['required', 'not_in: -1'],
            'plan' => ['required', 'not_in: -1']
        ]);

        session(['hosting-data' => $data]);
        
        $intent = [
            'intent' => auth()->user()->createSetupIntent(),
        ];

        return view('users.hosting.payment')->with($intent);
    }

    public function process(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;

        $hostingData = session('hosting-data');
        $packageId = $hostingData['package'];
        $planId = $hostingData['plan'];
    
        if($packageId == '1,15') { 
            $packageId = 'prod_GDo1zMap1HZid6';
            if($planId == '1') {
                $planId = 'silver_monthly';
            } else if ($planId == '3') {
                $planId = 'silver_quarterly';
            } else if ($planId == '6') {
                $planId = 'silver_biannual';
            } else {
                $planId = 'silver_annual';
            }
        } else if ($packageId == '2,30') {
            $packageId = 'prod_GFnSHrey8s2XM6';
            if($planId == '1') {
                $planId = 'gold_monthly';
            } else if ($planId == '3') {
                $planId = 'gold_quarterly';
            } else if ($planId == '6') {
                $planId = 'gold_biannual';
            } else {
                $planId = 'gold_annual';
            }
        } else {
            $packageId = 'prod_GFncalajIfd5m0';
            if($planId == '1') {
                $planId = 'platinum_monthly';
            } else if ($planId == '3') {
                $planId = 'platinum_quarterly';
            } else if ($planId == '6') {
                $planId = 'platinum_biannual';
            } else {
                $planId = 'platinum_annual';
            }
        }

        try {
            $user->newSubscription($packageId, $planId)->create($paymentMethod);
            return response([
                'success_url'=> redirect()->intended('/hosting/done')->getTargetUrl(),
                'message'=>'success'
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        } 
    }

    public function done() {
        $hostingData = session('hosting-data');
        $name = $hostingData['name'];
        $package = explode(",",$hostingData['package']);
        $packageId = $package[0];

        auth()->user()->hostings()->create([
            'package_id' => $packageId,
            'name' => $name,
        ]);

        $h = Hosting::where('name', $name)->where('user_id',auth()->user()->id)->first();
        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);
        $response = $client->request('POST', 'mkfolder.php', [
            'form_params' => [
                'user_id' => auth()->user()->id,
                'name' => $h->id
            ]
        ]);
        $body = $response->getHeader('Data');

        return view('users.hosting.done');
    }

    public function delete()
    {
        $data = request()->validate([
            'name' => 'required',
            'domain' => 'required',
            'filename' => 'required'
        ]);

        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $response = $client->request('POST', 'delete.php', [
            'form_params' => [
                'user_id' => $data['name'],
                'name' => $data['domain'],
                'filename' => $data['filename']
            ]
        ]);
        return redirect('/hosting/show/' . $data['name'] . "/" . $data['domain']);
    }
}
