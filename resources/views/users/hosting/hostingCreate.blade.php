@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new hosting</div>

                <div class="card-body">
                    <script>
                        function calculate(){
                        var x = document.getElementById("package").value;
                        x = x.split(",");
                        var y = document.getElementById("plan").value;
                        if(x[0]!=-1 && y!=-1){
                            document.getElementById("price").value = x[1] * y;
                        }else{
                            document.getElementById("price").value = 0;
                        }
                    }
                    </script>
                    <form method="POST" action="{{ route('hosting.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name of the hosting</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package" class="col-md-4 col-form-label text-md-right">Select a package</label>

                            <div class="col-md-6">
                                <select name="package" id="package" onclick="calculate()">
                                    <option value="-1,-1" selected>Select one of our packages</option>
                                    @if(isset($packages))
                                    @foreach ($packages as $package)
                                    <option value="{{ $package->id }},{{$package->price}}">{{ $package->name }}</option>
                                    @endforeach
                                    @else
                                    <option value="-1,-1">You don´t have any package purchased</option>
                                    @endif
                                </select>
                                @error('package')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="plan" class="col-md-4 col-form-label text-md-right">Select a plan</label>

                            <div class="col-md-6">
                                <select name="plan" id="plan" onclick="calculate()">
                                    <option value="-1" selected>Select a payment plan</option>
                                    @if(isset($plans))
                                    @for ($i = 0; $i < sizeof($plans); $i++) <option value="{{ $plans[$i]['value'] }}">
                                        {{ $plans[$i]['name'] }}</option>
                                        @endfor
                                        @else
                                        <option value="-1">You don´t have any payment plans</option>
                                        @endif
                                </select>
                                @error('plan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Total price: </label>
                            <div class="col-md-6">
                                $<input type="text" disabled value="0" id="price" name="price">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Purchase
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