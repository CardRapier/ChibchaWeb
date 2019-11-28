@extends('layouts.supportLayout')
@section('content')
<div class="container">
<div class="row"><div class="col-md text-center"><h2>Answering {{$ticket->title}}</h2></div></div>
<div class="row">
<div class="col-md"></div>
<div class="col-md">
<form action="{{route('support.updateTicketSupport')}}" method="POST">
@csrf
<div class="form-group">
    <input style="display:none" type="text" class="form-control" id="ticket_id" name="ticket_id" value="{{$ticket->id}}"> 
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" disabled>{{$ticket->description}} </textarea>
</div>

<div class="form-group">
    <label for="answer">Answer</label>
    <input type="text" class="form-control" id="answer" name="answer" required> 
</div>
<button type="submit" class="btn btn-primary">Answer this question</button>
</form>
</div>
<div class="col-md"></div>
</div>
</div>
@endsection

