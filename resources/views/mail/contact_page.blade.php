@extends('layout.app')
@extends('layout.navbar')


@section('pagelink')
    @if( !session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}" class="nav-item nav-link active">Contact</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url("signup") }}" class="dropdown-item">Sign Up</a>
                        <a href="{{ url("login") }}" class="dropdown-item">Log In</a>
                    </div>
                </div>
            </div>
            <a href="{{ url("login") }}" class="btn btn-primary py-2 px-4 bi bi-cart"></a>
        </div>
        @endif

       @if( session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link ">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}" class="nav-item nav-link active">Contact</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('user')}}</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url("order_history") }}" class="dropdown-item">Order History</a>
                        <a href="{{ url("logout") }}" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
            <a href="{{ url("cart") }}" class="btn btn-primary py-2 px-4 bi bi-cart"></a>
            

            @if (session('item_cart_count'))
                <span class='badge badge-warning' id='lblCartCount'> {{session('item_cart_count')}} </span>
            @else
                <span class='badge badge-warning' id='lblCartCount'> {{$item_cart_count}} </span>
            @endif
            
        </div>
    @endif

@endsection


@section('page_name')
<h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
@endsection

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/contact.css')}}">
@endsection


@section('name')
<li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
@endsection


@section('body')
<div class="container">
@if (session('flash'))
    <div class="alert alert-success mx-auto" style="text-align: center;">
        {{ session('flash') }}
    </div>
@endif

<form class="cf" action="/contact" method="post">

    @csrf

  <div class="half left cf">
    <input type="text" id="input-name" placeholder="Name" name="name">
    @error('name')
        <label style="color: #f40142">{{$message}}</label>
    @enderror

    <input type="email" id="input-email" placeholder="Email address" name="email">
    @error('email')
        <label style="color: #f40142">{{$message}}</label>
    @enderror  

    <input type="text" id="input-subject" placeholder="Subject" name="subject">
    @error('subject')
        <label style="color: #f40142">{{$message}}</label>
    @enderror

  </div>

  <div class="half right cf">
    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
    @error('message')
        <label style="color: #f40142">{{$message}}</label>
    @enderror
  </div>  

  <input type="submit" value="Submit" id="input-submit">

</form>
</div>
<br>
<br>
<br>

@endsection
