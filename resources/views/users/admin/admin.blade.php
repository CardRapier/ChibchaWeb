@extends('layouts.adminLayout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md"><h2>Tickets</h2></div>
        <div class="col-md"><h2>Users</h2></div>
        <div class="col-md"><h2>Distributors</h2></div>
    </div>
    <div class="row">
        <div class="col-md">
        {!! $ticketsChart->container() !!}
        </div>
        <div class="col-md">
        {!! $loginUsers->container() !!}
        </div>
        <div class="col-md">
        {!! $distributorsChart->container() !!}
        </div>
    </div>
</div>
{!! $ticketsChart->script() !!}
{!! $loginUsers->script() !!}
{!! $distributorsChart->script() !!}

@endsection