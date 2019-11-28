@extends('layouts.adminLayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Account data') }}</div>
<div class="card-body">
<div>
    <form method="POST" action="{{route('admin.editUserAdmin' , $userForEdit->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{$userForEdit->name }}" required autocomplete="name" autofocus>

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
                    value="{{$userForEdit->last_name }}" autocomplete="last_name"
                    autofocus>

                @error('last_name')
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
                    value="{{ old('cellphone_number') ?? $userForEdit->cellphone_number }}"
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
                <hr>
            <!--       FORM CHANGE PASSWORD         -->
                <div class="pt-2 pb-2">
                    <form method="POST" action="{{route('admin.userEditPassword', $userForEdit->id)}}">
                    @csrf
                    @method('PUT')

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
                        <div class="col-md-2">
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="The password must contain at least 8 characters, one uppercase, one lowercase, one number and one symbol [@$!%*##?&_-].">
                                <button class="btn btn-success rounded-circle" style="pointer-events: none;" type="button" disabled>?</button>
                            </span>
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
</div>
</div>

@endsection