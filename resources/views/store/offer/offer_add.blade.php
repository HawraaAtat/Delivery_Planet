@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("store_home")}} " class="nav-item nav-link">Home</a>
        <a href="{{ url("menu_add") }}" class="nav-item nav-link">Menu</a>
        <a href="{{ url("offer_add") }}" class="nav-item nav-link active">Offers</a>
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



@section('link')
<link rel="stylesheet" href="{{asset('assests/css/menu.css')}}">
@endsection


@section('body')

<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Add Offer</h5>
        <br>
        <br>
    </div>
    <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
    
            <div class="small-container " style="justify-content: center; align-items: center;">

              <form action="{{ Route(  "offer_add.update", ['offer_add'=>$menu->id] ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="text" name="new_price" placeholder="New price"/>
                @error('new_price')
                <label style="color: red">{{$message}}</label>
                @enderror
                
                <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
                <button name="submit" type="submit" id="submit" class="btn btn-primary btn-block btn-large">Add Offer</button>
    
                </div>
            </form>
            <br>
            <br>
            </div>
        </div>
    </div>
</div>


@endsection