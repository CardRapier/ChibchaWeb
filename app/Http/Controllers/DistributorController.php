<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app;
use App\Distributor;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index(Request $request){
        $nameRequest=$request->get('nameDist');

        $dist = DB::table('distributors')->where('name', 'like', '%' . $nameRequest . '%')->get();
        $distributors = DB::connection('pgsql2')->table('distributors')->where('name', 'like', '%' . $nameRequest . '%')->get();

        return view('users.distributor.distributor')->with(['distributors'=>$distributors,'dist'=>$dist]);
    }
    public function addDistributor(Request $request){
        $dist = DB::table('distributors')->count() + DB::connection('pgsql2')->table('distributors')->count();
        if($dist % 2 == 0){
            DB::table('distributors')->insert([
                'name' => $request->nameDistributor, 
                'domains_quantity' => $request->quantityDistributor,
                'description' => $request->descriptionDistributor
            ]);
        }else{
            DB::connection('pgsql2')->table('distributors')->insert([
                'name' => $request->nameDistributor, 
                'domains_quantity' => $request->quantityDistributor,
                'description' => $request->descriptionDistributor
            ]);
        }
        return back()->with('users.distributor.distributor', 'New distributor added');
    }


}