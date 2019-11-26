<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('users.admin.admin');
    }

    public function showUsers(Request $request){
        $userName = $request->get("nameUser");
        $users = \App\User::orderBy('id', 'ASC')->name($userName)->paginate(20);
        return view('users.admin.users')->with('users',$users);
    }

    public function showTickets(Request $request){
        $ticketName = $request->get("nameTicket");

        $tickets = \App\Ticket::orderBy('id', 'ASC')->name($ticketName)->paginate(20);

        return view('users.admin.tickets')->with('tickets',$tickets);
    }

    public function editTicket($ticketId){
        $ticket = \App\Ticket::find($ticketId);
        return view('users.admin.editTicket')->with('ticket',$ticket);
    }

    public function updateTicket(){
        $data = request()->validate([
            'ticket_id'=>'required',
            'answer'=>'required'
        ]);

        $ticket = \App\Ticket::find($data['ticket_id']);
        $ticket->answer_description = $data['answer'];
        $ticket->state = 'C';
        $ticket->save();
        return redirect("/admin/tickets");
    }

}
