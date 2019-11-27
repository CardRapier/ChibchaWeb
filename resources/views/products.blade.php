@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
    <div class="mx-auto" style="width: 170px;">
        <h1>Products</h1>
    </div>
    </div>

    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/godaddy.jpg" class="d-block w-100 h-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark font-weight-bold">
                <h5>Visit our distributors</h5>
                <p>GoDaddy: <a href="https://co.godaddy.com/">godaddy.com</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/hostinger.jpg" class="d-block w-100 h-85" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark font-weight-bold">
                <h5>Visit our distributors</h5>
                <p>Hostinger: <a href="https://www.hostinger.com/">hostinger.com</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/hostgator.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark font-weight-bold">
                <h5>Visit our distributors</h5>
                <p>Hostgator: <a href="https://www.hostgator.com/">hostgator.com</a></p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="mt-5 border border-dark bg-gradient-secondary">
    <h2 class="ml-5 mt-3">Packages</h2>
    <div class="row pb-5">
    @if(isset($packages))
    @foreach ($packages as $package)
    <div class="col-md ml-5">
            <div class="card " style="width: 18rem;">
            <img src="{{$package['image']}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$package['name']}}</h5>
                <p class="card-text">{{$package['description']}}</p>
                <div class="d-flex">
                    <span class="mr-5 align-bottom">{{$package['price']}}$</span>
                    <a href="/hosting/create" class="ml-5 btn btn-primary">Buy now!</a>
                </div>
            </div>
            </div>
    </div>
    @endforeach
    @endif

    </div>
    </div>

    <!-- 
    <h3>Solicitar dominio</h3>
    <div class="row">
    <div class="col-md d-inline-block">
    <form>
    <div class="form-group">
        <label for="name" class="col-md col-form-label">Name: </label>
        <div class="col-md">
            <input type="text" class="form-control" id="name" placeholder="ChibchaWeb.com">
        </div>
        <button class="btn btn-success col-md">Solicitar</button>
    </div>

    </form>
    </div>
    </div>
    -->

</div>
@endsection