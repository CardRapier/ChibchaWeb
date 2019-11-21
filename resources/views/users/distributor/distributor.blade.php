@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-7"> 
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

    </div>
    <div class="col-md-5">
            <h3 class="text-center mb-4"> New Distributor</h3>
        <form action="{{route('distributor.addDistributor')}}" method="POST">
                @csrf
            <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Distributor name</label>
                       <div>
                          <input type="text" name="nameDistributor" id="nameDistributor">
                       </div>
            </div>
            <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Quantity of domains</label>
                    <div>
                         <input type="text" name="quantityDistributor" id="quantityDomains">
                      </div>
                
            
            </div>
            <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div>
                         <input type="text" name="descriptionDistributor" id="descriptionDistributor">
                      </div>
                
                      
            </div>
            <div class="text-center">
  
                            <button type="submit" class="btn btn-success"> Register</button>

            </div>
               
        </form>
    </div>
</div>

@endsection