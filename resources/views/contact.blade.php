@extends('layouts.app')
@section('content')

<div class="container">


    <div class="row">
        <div class="col-md-6">
            <div class="container-fluid">
                <img src="https://vegibit.com/wp-content/uploads/2017/06/How-To-Send-Email-To-New-Users.png" class="img-fluid" alt="Responsive image">
            </div>
        </div>
        <div class="col-md-6">
            <h3>Leave us a comment</h3>
            <form action="{{route('contact.email')}}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="name">Name (optional)</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>            
            </form>
        </div>
    </div>

</div>

@endsection