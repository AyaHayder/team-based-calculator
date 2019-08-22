<?php

namespace App\Http\Controllers;

use App\Events\PendingTicketsEvent;
use App\Events\TicketAlertEvent;
use App\History;
use App\Ticket;
use Illuminate\Http\Request;
use Session;
use App\Events\TicketStatusEvent;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'ticket'=> 'required|integer|min:1'
        ]);
        $ticket = new Ticket;
        $ticket->credit = $request->ticket;
        $ticket->is_pending = true;
        $ticket->station_id = 1;
        $stationId= 1;
        $ticket->save();
        $ticket->station()->attach($stationId);
        /** adding the current ticket and its credit to our histories table */
        $history = new History;
        $history->ticket_id = $ticket->id;
        $history->credit = $ticket->credit;
        $history->station_id = $ticket->station_id;
        $history->save();
        $tickets = Ticket::all();
        event(new TicketStatusEvent($tickets));
        event(new PendingTicketsEvent($ticket));
        Session::flash('success','Ticket is submitted');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
