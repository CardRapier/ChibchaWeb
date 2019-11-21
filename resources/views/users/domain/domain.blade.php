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
                <div class="card-header">{{ __('Register Domain') }}</div>

                <div class="card-body">
                    <form action="" method="">
                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email Owner</label>
                                <div>
                                        <input type="text" name="email" id="email" class="form-control" required>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="distributor1" class="col-md-4 col-form-label text-md-right">Distributor</label>
                                <div>   
                                        <select name="distributor" id="distributor">
                                            @if(isset($distributors))
                                                @foreach ($distributors as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                                @endforeach
                                            @else
                                                <option value="na">No distributor </option>
                                            @endif
                                            </select>
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Domain</label>
                                <div>
                                        <input type="text" name="domain" id="domain" class="form-control" required>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block"> Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection