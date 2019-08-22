@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        {{--addition user dashboard--}}
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
                                            Ticket: {{$ticket->id}}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseticket{{$ticket->id}}" class="collapse" aria-labelledby="ticket{{$ticket->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="{{Route('add.value')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row justify-content-center">
                                                <p>Ticket's credit: {{$ticket->credit}}</p>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-2">
                                                    <input type="number" name="credit" disabled value="{{$ticket->credit}}">
                                                </div>
                                                <img src="svg/plus.svg" alt="plus" class="ml-2">
                                                <div class="col-md-2">
                                                    <input type="number" name="addTo" placeholder="add to credit">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <input type="hidden" name="id" value="{{$ticket->id}}">
                                                <button type="submit" class="btn btn-primary my-2">Submit</button>
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