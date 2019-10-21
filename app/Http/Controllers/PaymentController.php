<?php

namespace App\Http\Controllers;

use App\Country;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_payment()
    {
        $countries = Country::all();

        return view('payments.edit', compact('countries'));
    }

    public function change_payment()
    {
        $data =  request()->validate([
            'card_number' => ['required', new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear(request()->get('expiration_month'))],
            'expiration_month' => ['required', new CardExpirationMonth(request()->get('expiration_year'))],
            'cvc' => ['required', new CardCvc(request()->get('card_number'))],
            'first_name'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'last_name'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'address'=>['required','max:255', 'string'],
            'city'=>['required', 'string', 'max:255','regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/'],
            'state'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/'],
            'country_id'=>'required',
            'postal_code'=>['required', 'regex:/^[0-9]+$/'],
        ]);

        auth()->user()->payment()->update($data);
        
        return redirect('/profile');
    }

    public function remove_payment()
    { 
        $user = auth()->user();
        $id_payment = $user->payment->id;
        DB::table('payments')->where('id', '=', $id_payment)->delete();


        return redirect('/profile');
    }

    public function create_payment()
    {
        $countries = Country::all();

        return view('payments.create', compact('countries'));
    }

    public function store_payment()
    {
        $data =  request()->validate([
            'card_number' => ['required', new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear(request()->get('expiration_month'))],
            'expiration_month' => ['required', new CardExpirationMonth(request()->get('expiration_year'))],
            'cvc' => ['required', new CardCvc(request()->get('card_number'))],
            'first_name'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'last_name'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/'],
            'address'=>['required','max:255', 'string'],
            'city'=>['required', 'string', 'max:255','regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/'],
            'state'=>['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/'],
            'country_id'=>'required',
            'postal_code'=>['required', 'regex:/^[0-9]+$/'],
        ]);

        auth()->user()->payment()->create($data);
        
        return redirect('/profile');
    }
}
