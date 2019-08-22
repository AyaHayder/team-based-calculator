@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        {{--supervision dashboard--}}
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h1 class="display-4">Tickets</h1>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <img src="svg/check.svg" alt="">
                            <span class="lead">{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!empty($tickets))
                    @foreach($tickets as $ticket)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="ticket{{$ticket->id}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseticket{{$ticket->id}}" aria-controls="collapseticket{{$ticket->id}}">
                                            View ticket: {{$ticket->id}}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseticket{{$ticket->id}}" class="collapse" aria-labelledby="ticket{{$ticket->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                            <div class="row justify-content-center">
                                                <p class="lead">current credit: {{$ticket->credit}}</p>
                                            </div>
                                            <div class="row justify-content-center">
                                                <h3 class="display-4">Ticket history</h3>
                                            </div>
                                                <div class="row justify-content-center">
                                                    <div class="row">
                                                        @foreach($ticket->history as $history)
                                                            <div class="col">
                                                                <p class="lead">Credit: {{$history->credit}}</p><br>
                                                                @if(isset($history->user))
                                                                    <p class="lead">Updated by: <br>{{$history->user->first_name}} {{$history->user->last_name}}</p><br>
                                                                    <p class="lead"> role: {{$history->user->role}}</p>
                                                                @else
                                                                    <p class="lead">Initial Value</p>
                                                                @endif
                                                            </div>
                                                            @if(!$loop->last)
                                                                <div class="col">
                                                                    <img src="svg/arrow-right.svg" alt="">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <form action="{{Route('approve.value')}}" method="post">
                                                    {{csrf_field()}}
                                                    <div class="row justify-content-center">
                                                        <input type="hidden" name="id" value="{{$ticket->id}}">
                                                        <button type="submit" name="approve" class="btn btn-primary my-2">Approve</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                </div> <!--accordion -->
                        @endforeach
                    @endif
                </div><!-- card body -->
            </div>
        </div>
@endsection