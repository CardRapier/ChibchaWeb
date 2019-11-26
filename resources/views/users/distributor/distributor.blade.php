@extends('layouts.adminLayout')
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-7"> 
        <div class="row text-center">
            <form class="" action="{{route('admin.distributor')}}" method="GET">
                <div class="form-group row">
                    <label class="col-md mt-2" for="nameDist">Search: </label>
                    <input class="form-control col-md" type="text" name="nameDist" id="nameDist">
                    <button class="btn btn-success ml-3 col-md" type="submit" class="">Search</button>
                </div>
            </form>
        </div>
        <div class="row">
        <table class="table">
            <tr>
                <th>Distributor Name </th>
                <th>Distributor Quantity </th>
                <th>Description</th>
            </tr>
            @foreach ($distributors as $item)
            @csrf
                <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->domains_quantity}}</td>
                <td>{{$item->description}}</td>
                </tr>
                
            @endforeach
        </table>
        {{$distributors->links()}}
        </div>
    </div>
    <div class="col-md-5">
        <h3 class="text-center mb-4">Add new distributor</h3>
        <form action="{{route('admin.addDistributor')}}" method="POST">
        @csrf
        <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Distributor name</label>
            <div>
                <input class="form-control" type="text" name="nameDistributor" id="nameDistributor">
            </div>
        </div>
        <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Quantity of domains</label>
            <div>
                <input class="form-control" type="text" name="quantityDistributor" id="quantityDomains">
            </div>
        </div>
        <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
            <div>
                <input class="form-control" type="text" name="descriptionDistributor" id="descriptionDistributor">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success"> Register</button>
        </div>
               
        </form>
    </div>
</div>
</div>
@endsection