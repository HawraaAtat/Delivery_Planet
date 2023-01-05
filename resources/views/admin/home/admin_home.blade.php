@extends('layout.app')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("admin_home")}} " class="nav-item nav-link active">Home</a>
        <a href="{{ url("user_promote")}} " class="nav-item nav-link">User</a>
        <a href="{{ url("restaurant_approve") }}" class="nav-item nav-link">Restaurant</a>
        <a href="{{ url("admmin_orders_manage") }}" class="nav-item nav-link">Manage Orders</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('admin')}}</a>
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
                <h2 class="display-3 text-white animated slideInLeft">Welcome, {{session('admin')}}</h2>
                <p class="text-white animated slideInLeft mb-4 pb-2">  You  Can  Approve  Restaurants / Menus ,  Manage operations , Provide Support </p>
                <a href="{{ url("/user_promote")}}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Users</a>
                <a href="{{ url("/restaurant_approve")}}" class="btn btn-secondary py-sm-3 px-sm-5 me-3 animated slideInLeft">Restaurants</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="{{url('/assests/img/admin1.png')}}" alt="pizza">
            </div>
        </div>
    </div>
</div>

@endsection

@section('body')
<div> </div>
<br>
<br>
@endsection
