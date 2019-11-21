<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $distributors = Distributor::orderBy('name', 'DESC')
        ->name($nameRequest)
        ->paginate(5);
        return view('users.distributor.distributor', compact('distributors'));
    }
    public function addDistributor(Request $request){

        $newDistributor = new Distributor;
        $newDistributor->name=$request->nameDistributor;
        $newDistributor->domains_quantity=$request->quantityDistributor;
        $newDistributor->description=$request->descriptionDistributor;
        $newDistributor->save();
        return back()->with('users.distributor.distributor', 'New distributor added');


    }


}