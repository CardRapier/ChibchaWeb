@extends('layouts.app')

@section('content')
<?php 
$responses = session()->get('responses'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Check Available Domains') }}</div>
                <div class="card-body">
                        @if(!empty($successMsg))
                        <div class="alert alert-success"> {{ $successMsg }}</div>
                      @endif
                    <form method="POST" action="{{ route('domain.available') }}">
                        <div class="form-group row">
                            <label for="domain"
                                class="col-md-4 col-form-label text-md-right">{{ __('Domain name') }}</label>

                            <div class="col-md-6">
                                <input id="domain" type="text"
                                    class="form-control @error('domain') is-invalid @enderror" name="domain"
                                    value="{{ old('domain') }}" placeholder="Example: Chibchaweb" autocomplete="domain"
                                    autofocus>

                                @error('domain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Check Availability') }}
                                </button>

                                @if (isset($responses))
                                <button class="btn btn-primary" onclick="event.preventDefault();
                                document.getElementById('email-form').submit();" type="submit">
                                    {{ __('Send Email') }}
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>

                    @if (isset($responses))
                    @foreach ($responses as $response)
                    <hr>
                    <div>
                        @if (isset($response['available']) and $response['available'])
                        <h4>{{$response['domain']}} : {{$response['message']}}</h4> Price: <span
                            class="h4">${{$response['price']}}</span> for the first year
                        @elseif (isset($response['code']))
                        <h4>{{$response['message']}}</h4>
                        @else
                        <h4>{{$response['domain']}}</h4>
                        <h4>{{$response['message']}}</h4>
                        @endif
                    </div>
                    @endforeach
                    @endif

                    <form id="email-form" action="{{ route('domain.email') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection