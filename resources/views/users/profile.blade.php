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
                        <form method="POST" action="{{route('profile.update')}}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') ?? $user->last_name }}" autocomplete="last_name"
                                        autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cellphone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cellphone') }}</label>

                                <div class="col-md-6">
                                    <input id="cellphone_number" type="cellphone"
                                        class="form-control @error('cellphone_number') is-invalid @enderror"
                                        name="cellphone_number"
                                        value="{{ old('cellphone_number') ?? $user->cellphone_number }}"
                                        autocomplete="cellphone_number" pattern="[0-9]+$">

                                    @error('cellphone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save data') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="form-group row mb-0 pt-2">
                        <label for="credit_card"
                            class="col-md-4 col-form-label text-md-right">{{ __('Credit card') }}</label>
                        @if ($card_number)
                        <div class="col-md-6">
                            <span><strong>{{$card_type}}</strong> card ending in {{$card_number}}</span>
                        </div>
                    </div>
                    <div class="form-group row d-flex pl-3">
                        <div class="offset-md-4">
                            <button onclick="event.preventDefault();
                            document.getElementById('change-form').submit();" type="submit" class="btn btn-primary">
                                {{ __('Change Card') }}
                            </button>
                        </div>

                        <div class="pl-3">
                            <button onclick="event.preventDefault();
                            document.getElementById('remove-form').submit();" type="submit" class="btn btn-primary">
                                {{ __('Remove Card') }}
                            </button>
                        </div>
                    </div>

                    <form id="change-form" action="{{ route('payment.show') }}" method="GET" style="display: none;">
                        @csrf
                    </form>

                    <form id="remove-form" action="{{ route('payment.remove') }}" method="POST" style="display: none;">
                        @csrf
                        @method('PATCH')
                    </form>
                    @else
                    <div class="">
                        <span>There no credit cards register</span>
                        <a href="/payment/create">
                            <span>Click here to add a new one</span>
                        </a>
                    </div>
                    @endif
                </div>
                    <hr>
                    <div class="pt-2 pb-2">
                        <form method="POST" action="{{route('password.change')}}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="old-password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="old-password" type="password" class="form-control" name="old-password"
                                        required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection