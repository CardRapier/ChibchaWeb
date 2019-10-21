@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit payment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('payment.change') }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text"
                                    class="form-control @error('card_number') is-invalid @enderror" name="card_number"
                                    value="{{ old('card_number') }}" required autocomplete="card_number" autofocus
                                    pattern="[0-9]+$" maxlength="16" minlength="16">

                                @error('card_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration_year"
                                class="col-md-4 col-form-label text-md-right">{{ __('Expiration year') }}</label>

                            <div class="col-md-6">
                                <input id="expiration_year" type="text"
                                    class="form-control @error('expiration_year') is-invalid @enderror"
                                    name="expiration_year" value="{{ old('expiration_year') }}"
                                    autocomplete="expiration_year" required autofocus maxlength="4" minlength="4">

                                @error('expiration_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration_month"
                                class="col-md-4 col-form-label text-md-right">{{ __('Expiration Month') }}</label>

                            <div class="col-md-6">
                                <input id="expiration_month" type="text"
                                    class="form-control @error('expiration_month') is-invalid @enderror"
                                    name="expiration_month" value="{{ old('expiration_month') }}" required
                                    autocomplete="expiration_month" maxlength="2" minlength="1">

                                @error('expiration_month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cvc" class="col-md-4 col-form-label text-md-right">{{ __('CVC') }}</label>

                            <div class="col-md-6">
                                <input id="cvc" type="text" class="form-control @error('cvc') is-invalid @enderror"
                                    name="cvc" value="{{ old('cvc') }}" required autocomplete="cvc" maxlength="4"
                                    minlength="3">

                                @error('cvc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name">

                                @error('first_name')
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
                                <input id="last_name" type="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="city" class="form-control @error('city') is-invalid @enderror"
                                    name="city" value="{{ old('city') }}" required autocomplete="city">

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state"
                                class="col-md-4 col-form-label text-md-right">{{ __('State/Province') }}</label>

                            <div class="col-md-6">
                                <input id="state" type="state" class="form-control @error('state') is-invalid @enderror"
                                    name="state" value="{{ old('state') }}" required autocomplete="state">

                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select name="country_id" id="country_id"
                                    class="form-control @error('country_id') is-invalid @enderror"
                                    value="{{ old('country_id') }}" required>
                                    @foreach ($countries as $country)
                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal_code"
                                class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>

                            <div class="col-md-6">
                                <input id="postal_code" type="postal_code"
                                    class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
                                    value="{{ old('postal_code') }}" required autocomplete="postal_code">

                                @error('postal_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit card') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                
            </div>
        </div>
</div>
@endsection