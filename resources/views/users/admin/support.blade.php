@extends('layouts.supportLayout')
@section('content')
<div class="container">
<div class="row"><h2>Tickets</h2></div>

<div class="row">

<table class="table">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Answer</th>
        <th>State</th>
        <th>Published by:</th>
        <th>Edit</th>
    </tr>
    @foreach ($tickets as $item)
    <tr>
        <th>{{($item->title)}}</th>
        <th>{{($item->description)}}</th>
        <th>@if ($item->answer_description=="") Not answered yet @else {{$item->answer_description}} @endif</th>
        @if ($item->state=='O')
            <th>Open</th>
            <th>{{$item->user_id}}</th>
            <th>
                <a href="{{url('/support/editTicket/'.$item->id)}}" class="btn btn-danger">
                    Edit
                </a>
            </th>
        @else
            <th>Closed</th>
            <th>{{$item->user_id}}</th>
            <th>
            <a href="{{url('/support/editTicket/'.$item->id)}}" class="btn btn-success">
                    Edit
            </a>
            </th>
        @endif
    </tr>
    @endforeach
</table>

</div>

</div>
@endsection