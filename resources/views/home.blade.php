@extends('layouts.app')

@section('title')
    home
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <img src="svg/check.svg" alt="">
                        <span class="lead">{{ session('status') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center">
                            <h3>Submit a ticket</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <img src="svg/check.svg" alt="">
                                <span class="lead">{{ session('success') }}</span>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{Route('make.ticket')}}" method="post">
                            {{csrf_field()}}
                            <div class="row justify-content-center">
                                <p class="lead">A ticket can be any number (integer or double)</p>
                            </div>
                            <div class="row justify-content-center">
                                <input type="number" name="ticket">
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary my-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
