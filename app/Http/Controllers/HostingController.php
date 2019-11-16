<?php

namespace App\Http\Controllers;
use App\Hosting;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


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

    public function view($user_id,$hosting_id){
        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $r = $client->request('GET', 'view.php',[
            'query' => ['user_id' => $user_id,'name'=>$hosting_id]
        ]);
        $files = json_decode($r->getHeader('Data')[0],true);
        $sizes = array("size"=>array_pop($files));
        $hosting = Hosting::find($hosting_id);
        $user = User::find($user_id);
        return view('users.hosting.hostingView')->with(['files'=>$files,'sizes'=>$sizes,'hosting'=>$hosting,'user'=>$user]);
    }

    public function create(){
        $packages = Package::all();
        return view('users.hosting.hostingCreate')->with('packages', $packages);
    }

    public function upload(){
        $data = request()->validate([
            'user'=>'required',
            'domain'=>'required',
            'fileToUpload'=>''
        ]);

        $file = request()->file('fileToUpload');
        $name = $file->getClientOriginalName();


        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $response = $client->request('POST', 'upload.php?user_id='.$data['user']."&name=".$data['domain'], [
            'multipart' => [
                [
                    'name'     => 'fileToUpload',
                    'contents' => file_get_contents($file),
                    'filename' => $name
                ]
            ]
        ]);

        return redirect('/hosting/view/'.$data['user']."/".$data['domain']);
    }

    public function store(){
        $data = request()->validate([
            'name'=>'required',
            'domain'=>'required',
            'package'=>'required'
        ]);

        $package = explode(",",$data['package']);
        $data = array_merge($data,['package'=>$package[0]]);

        auth()->user()->hostings()->create([
            'package_id' => $data['package'],
            'name' => $data['name']
        ]);

        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $response = $client->request('POST', 'mkfolder.php', [
            'form_params' => [
                'user_id' => $data['name'],
                'name' => $data['domain']
            ]
        ]);
        $body = $response->getHeader('Data');
        
        return redirect('/hosting');
    }

    public function delete(){
        $data = request()->validate([
            'name'=>'required',
            'domain'=>'required',
            'filename'=>'required'
        ]);

        $client = new Client(['base_uri' => 'http://chibchaweblfs.centralus.cloudapp.azure.com/api/']);

        $response = $client->request('POST', 'delete.php', [
            'form_params' => [
                'user_id' => $data['name'],
                'name' => $data['domain'],
                'filename' => $data['filename']
            ]
        ]);
        return redirect('/hosting/view/'.$data['name']."/".$data['domain']);
    }
}
