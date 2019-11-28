<?php

namespace App\Http\Controllers;

use App\Charts\TodayLoginUsers;
use App\User;
use App\Ticket;
use App\Distributor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        $today_users = User::whereDate('last_login', today())->count();
        $yesterday_users = User::whereDate('last_login', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('last_login', today()->subDays(2))->count();
        $loginUser = new TodayLoginUsers;
        $loginUser->labels(['2 days ago', 'Yesterday', 'Today']);
        $loginUser->dataset('Users', 'bar', [$users_2_days_ago, $yesterday_users, $today_users])->backgroundColor(["#".substr(md5(rand()), 0, 6),"#".substr(md5(rand()), 0, 6),"#".substr(md5(rand()), 0, 6)])->color(["#".substr(md5(rand()), 0, 6)]);

        $tickets_openeds = Ticket::where('state','O')->count();
        $tickets_close = Ticket::where('state','C')->count();
        $ticketsChart  = new TodayLoginUsers;
        $ticketsChart->labels(['Opened', 'Closed']);
        $ticketsChart->dataset('Tickets','bar',[$tickets_openeds,$tickets_close])->backgroundColor(['#A8FFBD','#B32532'])->color(['#FF737F','#8FFFA9']);

        $distributors = Distributor::all();
        $distData = array();
        $distLabels = array();
        $distColors = array();
        foreach($distributors as $distributor){
            array_push($distLabels,$distributor->name);
            array_push($distData,$distributor->domains_quantity);
            array_push($distColors,"#".substr(md5(rand()), 0, 6));
        }
        $distributorsChart  = new TodayLoginUsers;
        $distributorsChart->labels($distLabels);
        $distributorsChart->dataset('Distributors','pie',$distData)->backgroundColor($distColors);
        
        \Stripe\Stripe::setApiKey("sk_test_G2zdehH3j0HrGmz96joh0wUB00uqHYIXGc");
        $balance = \Stripe\Balance::retrieve();
        $available =  "Available $".reset($balance->available)->amount/100;
        $pending =  "Pending $".reset($balance->pending)->amount/100;

        return view('users.admin.admin')->with(['loginUsers'=>$loginUser,'ticketsChart'=>$ticketsChart,'distributorsChart'=>$distributorsChart,'pending'=>$pending,'available'=>$available]);
    }

    public function showUsers(Request $request){
        $userName = $request->get("nameUser");
        $users = \App\User::orderBy('id', 'ASC')->name($userName)->paginate(20);
        return view('users.admin.users')->with('users',$users);
    }

    public function showTickets(Request $request){
        $ticketName = $request->get("nameTicket");
        $type_id = auth()->user()->user_type_id;
        $tickets = \App\Ticket::orderBy('id', 'ASC')->name($ticketName)->paginate(20);
        
        return view('users.admin.tickets')->with(['tickets'=>$tickets,'type_id'=>$type_id]);
    }

    public function showTicketsSupport(Request $request){
        $ticketName = $request->get("nameTicket");
        $type_id = auth()->user()->user_type_id;
        $tickets = \App\Ticket::orderBy('id', 'ASC')->name($ticketName)->paginate(20);
        
        return view('users.admin.support')->with(['tickets'=>$tickets,'type_id'=>$type_id]);
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
