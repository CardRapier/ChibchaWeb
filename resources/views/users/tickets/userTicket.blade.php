@extends('layouts.app')
@section('content')
<div class="container">

<div class="row">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Ticket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('ticket.addTicket')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Ticket</button>
        </form>
      </div>

    </div>
  </div>
</div>
<div class="col-md"></div>
  <div class="col-md">
  <div class="text-center">
    <h3>Tickets</h3>
      <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add new ticket</button>
      </div>    
  </div>
  </div>
  <div class="col-md"></div>
</div>

<div class="row mt-5">
  <table class="table">
    <tr>
      <th>Title</th>
      <th>State</th>
      <th>View</th>
    </tr>
    @foreach ($tickets as $item)
    @csrf
    <tr>
      <th>{{($item->title)}}</th>
        @if ($item->state=='O')
          <th>Open</th>
        @else
          <th>Closed</th>
        @endif
      <th>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#showTicket{{$item->id}}">
            Show
        </button>
      </th>
    <!-- Modal -->
    <div class="modal fade" id="showTicket{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{$item->title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            @csrf
              <div class="form-group">
                <label for="description2" class="col-form-label">Description:</label>
                <textarea class="form-control" id="description2" name="description2" style="resize:none" disabled>{{$item->description}}</textarea>
              </div>
              <div class="form-group">
                <label for="ans" class="col-form-label">Answer:</label>
                <input type="text" class="form-control" id="ans" name="ans" disabled
                value='@if ($item->answer_description=="") Not answered yet @else {{$item->answer_description}} @endif'
                >
              </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    </tr>
      @endforeach
    </table>


  </div>
</div>

@endsection
