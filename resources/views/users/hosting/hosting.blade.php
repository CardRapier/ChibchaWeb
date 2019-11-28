@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left"><h2>My hostings</h2></span>
                    <a class="btn btn-success ml-5 float-right" href="{{ url('/hosting/create') }}">New hosting</a>
                </div>
                <div class="card-body">
                @if(isset($hostings) and count($hostings)!=0)
                @foreach ($hostings as $host)
                <div class="row">
                    <div class="col-md-4">
                        <h2>{{$host->name}}</h2>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6 text-right">
                        @if (auth()->user()->id == $host->user->id) 
                        <a class="btn btn-success" href="{{ url('/hosting/share/'.$host->id) }}">Share</a>
                        @endif
                        <a class="btn btn-success" href="{{ url('/hosting/show/'.$host->user->id.'/'.$host->id) }}">Edit files</a>
                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="You must have a 'index.php' or 'index.html' file in your hosting files" target="_blank" href="{{ url('http://chibchaweblfs.centralus.cloudapp.azure.com/api/hostings/'.$host->user->id.'/'.$host->id.'/') }}">Open app</a>
                    </div>
                </div>
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