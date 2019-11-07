@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <!-- This is a test from Fabian :) -->
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h1>Aqui van los hostings que posee y un link para poder adquirir uno nuevo</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection