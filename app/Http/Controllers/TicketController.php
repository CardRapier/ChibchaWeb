<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app;
use App\Ticket;

class TicketController extends Controller
{
    function index(Request $request ){
        $id=auth()->user()->id;
        $tickets =  Ticket::orderBy('state', 'DESC')
        ->user_id($id)
        ->paginate(5);
        return view('users.tickets.userTicket',compact('tickets'));
    }
    
    function addTicket(Request $request){
        $id=auth()->user()->id;
        $newTicket= new ticket;
        $newTicket->user_id=$id;
        $newTicket->title=$request->title;
        $newTicket->description=$request->description;
        $newTicket->state='O';
        $newTicket->answer_description="";
        $newTicket->save();
        return back()->with('users.tickets.userTicket');
    }
    function showTicket($id){
        $showTicketInfo = Ticket::find($id);
        return view('users.tickets.userTicket',compact('showTicketInfo'));

    }
}
