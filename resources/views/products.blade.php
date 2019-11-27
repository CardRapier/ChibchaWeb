@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
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
                <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(31).jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(25).jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="http://megabrainsinfotech.com/img/carousel/slide2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
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