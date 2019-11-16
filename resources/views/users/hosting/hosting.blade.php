@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">My hostings</span>
                    <a class="btn btn-success ml-5 float-right" href="{{ url('/hosting/create') }}">New hosting</a>
                </div>
                <div class="card-body">
                @if(isset($hostings))
                @foreach ($hostings as $host)
                    <h1>{{$host->name}} <a href="{{ url('/hosting/view/'.$host->user->id.'/'.$host->id) }}">Enter</a></h1>
                @endforeach
                @else
                    <h1>You don´t have any host</h1>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection