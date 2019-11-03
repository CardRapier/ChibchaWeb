@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Account data') }}</div>

                <div class="card-body">
                    <div>
                        Aqui se podra registrar y transferir dominios
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection