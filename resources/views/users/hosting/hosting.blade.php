@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="float-left">My hostings</span>
                    <button class="btn btn-success ml-5 float-right">New hosting</button>
                </div>
                <div class="card-body">
                @if(isset($hostings))
                @foreach ($hostings as $host)
                    <h1>Aqui van los hostings que posee y un link para poder adquirir uno nuevo</h1>
                @endforeach
                @else
                @endif
                    <h1>You don´t have any host</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection