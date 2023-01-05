@extends('layout.app')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("store_home")}} " class="nav-item nav-link active">Home</a>
        <a href="{{ url("menu_add") }}" class="nav-item nav-link">Menu</a>
        <a href="{{ url("offer_add") }}" class="nav-item nav-link">Offers</a>
        <a href="{{ url("orders_manage") }}" class="nav-item nav-link ">Orders</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('store')}}</a>
            <div class="dropdown-menu m-0">
                <a href="{{ url("logout") }}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('navbar')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h2 class="display-3 text-white animated slideInLeft">Welcome, {{session('store')}}</h2>
                <p class="text-white animated slideInLeft mb-4 pb-2"> Add your restaurant info
                    </p>
                <a href="{{ url("/add_restaurant")}}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Restaurant</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="{{url('/assests/img/store1.png')}}" alt="pizza">
            </div>
        </div>
    </div>
</div>

@if (session('flash'))
<div class="alert alert-success mx-auto" style="text-align: center;">
    {{ session('flash') }}
</div>
@endif

@endsection



@section('body')
<div> </div>
<br>
<br>
<br>
@endsection
