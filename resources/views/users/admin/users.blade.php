@extends('layouts.adminLayout')
@section('content')
<div class="container">

<div class="row">
<div class="col-md"><h2>Users</h2></div>
<div class="col-md"></div>
<div class="col-md text-center">
    <form class="align-middle" action="{{route('admin.showUsers')}}" method="GET">
        <div class="form-group row">
            <label class="col-md" for="nameUser">Search: </label>
            <input class="form-control col-md" type="text" name="nameUser" id="nameUser">
            <button class="btn btn-success col-md ml-3" type="submit" class="">Search</button>
        </div>
    </form>
</div>
</div>

<div class="row">
<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User type</th>
      <th scope="col">Name</th>
      <th scope="col">Last name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Cellphone</th>
      <th scope="col">Last Login</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->user_type_id ?? 'Null' }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->last_name }}</td>
      <td>{{ $user->email}}</td>
      <td>{{ $user->cellphone_number ?? 'None'}}</td>
      <td>{{ $user->last_login}}</td>
      <td>{{ $user->created_at}}</td>
    <td><a href="{{route('admin.userEdit',$user->id )}}" class="btn btn-warning">EDIT</a></td>
    </tr>
    @endforeach
    {{$users->links()}}
  </tbody>
</table>

</div>

</div>



@endsection