<?php

namespace App\Http\Controllers;

use App\Events\PendingTicketsEvent;
use App\History;
use App\Events\TicketStatusEvent;
use App\Station;
use App\Ticket;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case 'addition user':
                $tickets = Ticket::where('station_id', '=', 1)->get();
                return view('dashboards.addition_dashboard', compact('tickets'));
                break;
            case 'subtraction user':
                $tickets = Ticket::where('station_id', '=', 2)->get();
                return view('dashboards.subtraction_dashboard', compact('tickets'));
                break;
            case 'multiplication user':
                $tickets = Ticket::where('station_id', '=', 3)->get();
                return view('dashboards.multiplication_dashboard', compact('tickets'));
                break;
            case 'division user':
                $tickets = Ticket::where('station_id', '=', 4)->get();
                return view('dashboards.division_dashboard', compact('tickets'));
                break;
            case 'supervisor':
                $tickets = Ticket::where('station_id', '=', 5)->get();
                return view('dashboards.supervision_dashboard',compact('tickets'));
                break;
            case 'admin':
                $users = User::all();
                $tickets_no = Ticket::all()->count();
                $pending_no = Ticket::where('is_pending', '=', true)->count();
                $archived_no = Ticket::where('is_pending', '=', false)->count();
                $pending_tickets = Ticket::where('is_pending', '=', true)->get();
                $archived_tickets = Ticket::where('is_pending', '=', false)->get();
                $addition_tickets = Ticket::where('station_id', '=', 1)->get();
                $subtraction_tickets = Ticket::where('station_id', '=', 2)->get();
                $multiplication_tickets = Ticket::where('station_id', '=', 3)->get();
                $division_tickets = Ticket::where('station_id', '=', 4)->get();
                $supervision_tickets = Ticket::where('station_id', '=', 5)->get();
                return view('dashboards.admin_dashboard', compact(
                    'users',
                    'role',
                    'tickets_no',
                    'pending_tickets',
                    'archived_tickets',
                    'pending_no',
                    'archived_no',
                    'addition_tickets',
                    'subtraction_tickets',
                    'multiplication_tickets',
                    'division_tickets',
                    'supervision_tickets'
                ));
                break;
        }
    }

    public function addValue(Request $request)
    {
        $this->validate($request,[
            'addTo' =>'required|integer|min:1'
        ]);
        $id = $request->id;
        $ticket = Ticket::find($id);
        $credit=(int)$ticket->credit;
        $total =(abs($credit) + abs($request->addTo));
        $ticket->station_id = 2;
        $ticket->credit =$total;
        $ticket->save();
        /** to know which user updated the credit we need to attach the ticket to the user in our ticket_user table
         * we also need to store this information in histories table
         */
        $ticket->user()->attach(Auth::user()->id);
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->user_id = Auth::user()->id;
        $history->station_id = $ticket->station_id;
        $history->save();
        $ticket->station()->attach($ticket->station_id);
        event(new PendingTicketsEvent($ticket));
        Session::flash('success',"Value added, Credit is now $total");
        return back();
    }

    public function subtractValue(Request $request)
    {
        $this->validate($request,[
            'subtractFrom' =>'required|integer|max:credit|min:1'
        ]);
        $id = $request->id;
        $ticket = Ticket::find($id);
        $credit=(int)$ticket->credit;
        $total =(abs($credit) - abs($request->subtractFrom));
        $ticket->station_id = 3;
        $ticket->credit =$total;
        $ticket->save();
        /** to know which user updated the credit we need to attach the ticket to the user in our ticket_user table
         * we also need to store this information in histories table
         */
        $ticket->user()->attach(Auth::user()->id);
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->user_id = Auth::user()->id;
        $history->station_id = $ticket->station_id;
        $history->save();
        $ticket->station()->attach($ticket->station_id);
        event(new PendingTicketsEvent($ticket));
        Session::flash('success',"Value subtracted, Credit is now $total");
        return back();

    }

    public function multiplyValue(Request $request){
        $this->validate($request,[
            'multiplyBy' =>'required|integer|min:1'
        ]);
        $id = $request->id;
        $ticket = Ticket::find($id);
        $credit=(int)$ticket->credit;
        $total =(abs($credit) * abs($request->multiplyBy));
        $ticket->station_id = 4;
        $ticket->credit =$total;
        $ticket->save();
        /** to know which user updated the credit we need to attach the ticket to the user in our ticket_user table
         * we also need to store this information in histories table
         */
        $ticket->user()->attach(Auth::user()->id);
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->user_id = Auth::user()->id;
        $history->station_id = $ticket->station_id;
        $history->save();
        $ticket->station()->attach($ticket->station_id);
        event(new PendingTicketsEvent($ticket));
        Session::flash('success',"Value multiplied, Credit is now $total");
        return back();
    }

    public function divideValue(Request $request)
    {
        $this->validate($request,[
            'divideBy' =>'required|integer|min:1'
        ]);
        $id = $request->id;
        $ticket = Ticket::find($id);
        $credit=(int)$ticket->credit;
        $total =(abs($credit) / abs($request->divideBy));
        $ticket->station_id = 5;
        $ticket->credit =$total;
        $ticket->save();
        /** to know which user updated the credit we need to attach the ticket to the user in our ticket_user table
         * we also need to store this information in histories table
         */
        $ticket->user()->attach(Auth::user()->id);
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->user_id = Auth::user()->id;
        $history->station_id = $ticket->station_id;
        $history->save();
        $ticket->station()->attach($ticket->station_id);
        event(new PendingTicketsEvent($ticket));
        Session::flash('success',"Value divided, Credit is now $total");
        return back();
    }

    public function approveValue(Request $request)
    {
        $id = $request->id;
        $ticket = Ticket::find($id);
        $ticket->station_id = null;
        $ticket->is_pending = false;
        $ticket->save();
        /** to know which user updated the credit we need to attach the ticket to the user in our ticket_user table
         * we also need to store this information in histories table
         */
        $ticket->user()->attach(Auth::user()->id);
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->user_id = Auth::user()->id;
        $history->station_id = $ticket->station_id;
        $history->save();
        $ticket->station()->attach($ticket->station_id);
        Session::flash('success',"Ticket approved");
        return back();
    }

}
