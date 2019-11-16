@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
@if(isset($message))
True {{$message}}
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        <div class="card ">
            <div class="card-header">
                <span class="float-left">{{$hosting->name}}</span>
                <form action="{{ route('hosting.upload')}}" method="POST" enctype="multipart/form-data" class="float-right">
                @csrf
                    <input type="file" id="fileToUpload" name="fileToUpload" style="display: none;" required/>
                    <input type="text" name="user" value="{{$user->id}}" style="display: none;">
                    <input type="text" name="domain" value="{{$hosting->id}}" style="display: none;">
                    <button class="btn btn-success" onclick="document.getElementById('fileToUpload').click();">+</button>
                    <button type="submit" class="btn btn-success">Add new file</button>
                </form>
            </div>
            <div class="card-body">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">File name</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($files as $key=>$value)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$value}}</td>
                    <td>
                        <form action="{{ route('hosting.delete')}}" method="POST">
                        @csrf
                            <input type="text" name="name" value="{{$user->id}}" style="display: none;">
                            <input type="text" name="domain" value="{{$hosting->id}}" style="display: none;">
                            <input type="text" name="filename" value="{{$value}}" style="display: none;">
                            <button type="submit" class="btn btn-success">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            </div>
            <div class="card-footer text-muted">
            @foreach ($sizes as $size)
                {{$size}}
            @endforeach
            </div>
        </div>

        </div>
    </div>
</div>


@endsection