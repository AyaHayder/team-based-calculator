@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        {{--Admin dashboard--}}
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h1 class="display-4">Manage Users</h1>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <h1>Add User:</h1>
                </div>
                <form action="{{Route('add.user')}}" method="post">
                    {{csrf_field()}}
                    <div class="row justify-content-center">
                        @if(Session::has('added'))
                            <div class="alert alert-success">
                                <img src="svg/check.svg" alt="">
                                {{ Session::get('added') }}
                            </div>
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        @if ($errors->any() && Session::has('register error'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row justify-content-around">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="first-name" class="lead">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first-name" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="last-name" class="lead">last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Enter last Name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="lead">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="lead">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="re-password" class="lead">Confirm Password</label>
                                <input type="password" name="repassword" class="form-control" id="re-password" placeholder="Re-Enter Password">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <br><br><br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="addition-user" id="radio1" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio1">Addition User</label>
                            </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="subtraction-user" id="radio2" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio2">Subtraction User</label>
                            </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="multiplication-user" id="radio3" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio3">Multiplication User</label>
                            </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="division-user" id="radio4" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio4">Division User</label>
                            </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="supervisor" id="radio5" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio5">Supervisor</label>
                            </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="admin" id="radio6" name="role" class="custom-control-input">
                                <label class="custom-control-label lead" for="radio6">Admin</label>
                            </div>
                        </div>
                    </div> <!-- end of row div -->
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
                <hr>
                <div class="row justify-content-center">
                    <h1>Existing users:</h1>
                </div>
                <div class="row justify-content-center">
                    @if(Session::has('updated'))
                        <div class="alert alert-success">
                            <img src="svg/check.svg" alt="">
                            {{ Session::get('updated') }}
                        </div>
                    @endif
                    @if ($errors->any() && Session::has('update error'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    @if(Session::has('deleted'))
                        <div class="alert alert-success">
                            <img src="svg/check.svg" alt="">
                            {{ Session::get('deleted') }}
                        </div>
                    @endif
                    @if ($errors->any() && Session::has('delete error'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>You need to confirm deletion process</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @if(!empty($users))
                    @foreach($users as $user)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapse{{$user->id}}">
                                            {{$user->fullName}}
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse{{$user->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="{{Route('update.user', $user->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <div class="row justify-content-around">
                                                <div class="col-md-3">
                                                    <h4 class="lead">Full Name: {{$user->fullName}}</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="update_first_name" value="{{$user->first_name}}" class="form-control" placeholder="First name">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="update_last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last name">
                                                </div>
                                            </div>
                                            <div class="row justify-content-around">
                                                <div class="col-md-3">
                                                    <h4 class="lead">Permission: {{$user->role}}</h4>
                                                </div>
                                                <div class="col-md-7">
                                                    <select name="permission" class="custom-select my-1 w-100">
                                                        <option selected>Choose...</option>
                                                        <option value="addition-user">Addition User</option>
                                                        <option value="subtraction-user">Subtraction User</option>
                                                        <option value="multiplication-user">Multiplication User</option>
                                                        <option value="division-user">Division User</option>
                                                        <option value="supervisor">Supervisor</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row justify-content-around">
                                                <div class="col-md-3">
                                                    <h4 class="lead">Email: {{$user->email}}</h4>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="email" name="update_email" value="{{$user->email}}" class="form-control" placeholder="Email">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row justify-content-around">
                                                <div class="col-md-3 w-100">
                                                    <h4 class="lead">Updated Tickets:</h4>
                                                </div>
                                                <div class="col-md-7 ">
                                                    <button class="btn btn-primary"><img src="svg/check.svg" alt="update user"></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-3 ml-4">
                                                <ul>
                                                    @foreach($user->ticket as $ticket)
                                                        <li>
                                                            <p class="lead">Ticket {{$ticket->id}}</p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-7 w-100"></div>
                                        </div>
                                        <form action="{{Route('delete.user', $user->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <div class="row justify-content-around">
                                                <div class="col-md-3 w-100"></div>
                                                <div class="col-md-7">
                                                    <small id="emailHelp" class="form-text text-muted">Deleting a user is a one way process, which means you cannot take it back or undo deletion</small>
                                                </div>
                                            </div>
                                            <div class="row justify-content-around">
                                                <div class="col-md-3 w-100"></div>
                                                <div class="col-md-7">
                                                    <button class="btn btn-danger mt-2">Delete anyway</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> <!-- end of card-body div -->
                                </div> <!-- end of collapse div -->
                            </div> <!-- end of user's card div -->
                        </div> <!-- end of accordion div -->
                    @endforeach
                @endif

            </div> <!--end of card body div-->
        </div> <!--end of card div-->

        {{--operations--}}
        <div class="card my-4">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h1 class="display-4">Operations</h1>
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
                {{--ADDITION--}}
                <h3 class="text-center">Addition</h3>
                @if(!empty($addition_tickets))
                    @foreach($addition_tickets as $ticket)
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
                                </div> <!-- collapse -->
                            </div> <!--card -->
                        </div>
                    @endforeach
                @endif
                <hr>
                {{--SUBTRACTION--}}
                <h3 class="text-center">Subtraction</h3>
                @if(!empty($subtraction_tickets))
                    @foreach($subtraction_tickets as $ticket)
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
                                        <form action="{{Route('subtract.value')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row justify-content-center">
                                                <p>Ticket's credit: {{$ticket->credit}}</p>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-2">
                                                    <input type="number" name="credit" disabled value="{{$ticket->credit}}">
                                                </div>
                                                <img src="svg/17940.svg" alt="minus" class="ml-2" style="width:10px">
                                                <div class="col-md-2">
                                                    <input type="number" name="subtractFrom" placeholder="subtract from credit">
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
                <hr>
                {{--MULTIPLICATION--}}
                <h3 class="text-center">Multiplication</h3>
                @if(!empty($multiplication_tickets))
                    @foreach($multiplication_tickets as $ticket)
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
                                        <form action="{{Route('multiply.value')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row justify-content-center">
                                                <p>Ticket's credit: {{$ticket->credit}}</p>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-2">
                                                    <input type="number" name="credit" disabled value="{{$ticket->credit}}">
                                                </div>
                                                <img src="svg/x.svg" alt="times" class="ml-2">
                                                <div class="col-md-2">
                                                    <input type="number" name="multiplyBy" placeholder="multiply by credit">
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
                <hr>
                {{--DIVISION--}}
                <h3 class="text-center">Division</h3>
                @if(!empty($division_tickets))
                    @foreach($division_tickets as $ticket)
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
                                        <form action="{{Route('divide.value')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row justify-content-center">
                                                <p>Ticket's credit: {{$ticket->credit}}</p>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-2">
                                                    <input type="number" name="credit" disabled value="{{$ticket->credit}}">
                                                </div>
                                                <img src="svg/division.svg" alt="times" class="ml-2" style="width: 10px">
                                                <div class="col-md-2">
                                                    <input type="number" name="divideBy" placeholder="divide by credit">
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
                <hr>
                {{--SUPERVISION--}}
                <h3 class="text-center">Supervision</h3>
                @if(!empty($supervision_tickets))
                    @foreach($supervision_tickets as $ticket)
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
                                        <hr>
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
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h1 class="display-4">Tickets</h1>
                </div>
            </div>
            <div class="card-body">
                <ticket-progress tickets_no = "{{$tickets_no}}" pending_no = "{{$pending_no}}" archived_no= "{{$archived_no}}"></ticket-progress
                <hr>
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="archived-tab" data-toggle="tab" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archived</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab-tab">
                        @if(!empty($pending_tickets))
                            @foreach($pending_tickets as $pending_ticket)
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="PTicket{{$pending_ticket->id}}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePTicket{{$pending_ticket->id}}" aria-expanded="false" aria-controls="collapsePTicket{{$pending_ticket->id}}">
                                                    Ticket:  {{$pending_ticket->id}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapsePTicket{{$pending_ticket->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ticket-credit credit="{{$pending_ticket->credit}}" id="{{$pending_ticket->id}}"></ticket-credit>
                                                    </div>
                                                </div>

                                                @foreach($pending_ticket->station as $station)
                                                    @if($loop->last)
                                                        <div class="row">
                                                            <div class="col-md-2 lead">
                                                                <p>Ticket processing</p>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <pending-ticket-progress percent="{{$station->value}}" id="{{$pending_ticket->id}}"></pending-ticket-progress>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="row">
                                                    @foreach($pending_ticket->station as $station)
                                                        <div class="col">
                                                            <h4 class="lead">Station: {{$station->name}}</h4>
                                                        </div>
                                                        @if(!$loop->last)
                                                            <div class="col">
                                                                <img src="svg/arrow-right.svg" alt="">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <ticket-station id="{{$pending_ticket->id}}" ></ticket-station>
                                                </div>
                                            </div>
                                        </div> <!-- end of collapse div -->
                                    </div> <!-- end of user's card div -->
                                </div> <!-- end of accordion div -->
                            @endforeach
                        @endif
                        <new-ticket></new-ticket>
                    </div>
                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                        @if(!empty($archived_tickets))
                            @foreach($archived_tickets as $archived_ticket)
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="ticket{{$archived_ticket->id}}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseticket{{$archived_ticket->id}}" aria-controls="collapseticket{{$archived_ticket->id}}">
                                                    View ticket: {{$archived_ticket->id}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseticket{{$archived_ticket->id}}" class="collapse" aria-labelledby="ticket{{$archived_ticket->id}}" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <p class="lead">current credit: {{$archived_ticket->credit}}</p>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <h3 class="display-4">Ticket history</h3>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    @foreach($archived_ticket->history as $history)
                                                        <div class="col">
                                                            <p class="lead">Credit: {{$history->credit}}</p><br>
                                                            @if(isset($history->user))
                                                                @if(($history->user->role != 'supervisor'))
                                                                    <p class="lead">Updated by: {{$history->user->first_name}} {{$history->user->last_name}}</p>
                                                                @else
                                                                    <p class="lead">Archived by: {{$history->user->first_name}} {{$history->user->last_name}}</p>
                                                                @endif
                                                                <br><p class="lead"> role: {{$history->user->role}}</p>
                                                            @else
                                                                <p class="lead">Initial Credit</p>
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
                                        </div><!-- collapse -->
                                    </div> <!-- card -->
                                </div> <!--accordion -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div><!-- card body -->
        </div> <!-- card -->
    </div>
@endsection
