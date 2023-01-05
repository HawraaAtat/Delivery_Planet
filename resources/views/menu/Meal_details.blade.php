@extends('layout.app')
@extends('layout.navbar')

@section('pagelink')
     @if( !session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link active">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}"Meal_details_message class="nav-item nav-link">Contact</a>
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
                <a href="{{ url("menu") }}" class="nav-item nav-link active">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}"Meal_details_message class="nav-item nav-link">Contact</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('user')}}</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url("order_history") }}" class="dropdown-item">Order History</a>
                        <a href="{{ url("logout") }}" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
            <a href="{{ url("cart") }}" class="btn btn-primary py-2 px-4 bi bi-cart"></a>
            <span class='badge badge-warning' id='lblCartCount'> {{$item_cart_count}} </span>
        </div>
    @endif

@endsection

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/card.css')}}">
@endsection

@section('page_name')
<h1 class="display-3 text-white mb-3 animated slideInDown">Meals</h1>
@endsection

@section('name')
<li class="breadcrumb-item"><a href="{{ url("/menu")}}">Menu</a></li>
<li class="breadcrumb-item text-white active" aria-current="page">Meals</li>
@endsection

@section('body')

<div class="container">
        <div class = "card">
        <!-- card left -->
            <div class = "product-imgs">
                <div class = "img-display">
                    <div class = "img-showcase">
                        <img  src="{{url('/assests/img/'. $menu->image)}}" alt = {{$menu->menu_name}}>
                    </div>

                </div>
            </div>
        <!-- card right -->
            <div class = "product-content">
                <div class="align-items-center" style="position: relative; top: 50%; transform: translateY(-50%);">

                    <h2 class = "product-title">{{$menu->menu_name}}</h2>

                    <a href = "{{ Route(  "restaurants.show" , ['restaurant'=>$menu->restaurant_id] )}} " class = "product-link">Visit Store</a>

                    <div class = "product-price">
                        <p class = "new-price">Price: <span>{{'$'. $menu->price}}</span></p>
                    </div>

                    <br>

                    <div class = "product-detail">
                        <h2>About this item: </h2>
                        <p>{{$menu->description}}</p>
                        <ul>
                            <li><i class="bi bi-check"></i> Calorie Count: <span>{{$menu->calorie_count}}</span></li>
                            <li><i class="bi bi-check"></i> Diet: <span>{{$menu->diet}}</span></li>
                            <li><i class="bi bi-check"></i> Cuisine: <span>{{$menu->cuisine}}</span></li>
                        </ul>
                    </div>

                    <br>
                    <div class = "purchase-info">
                        
                        @if( !session()->has('user') )
                            <input name="item_number" type = "number" min = "0" value = "1">
                            <a  href="{{ url("login") }}"><div type="submit" class = "btn btn-primary"><i class = "fas fa-shopping-cart"></i>
                                Add to Cart
                            </div></a>
                        @endif

                        @if( session()->has('user') )
                        <div class = "purchase-info">
                            <form action="{{ Route(  "cart.update" , ['cart'=>$menu->id] )}} " method="post">
                                @csrf
                                @method('PUT')
                                <input name="item_number" type = "number" min = "0" value = "1">
                                <button type="submit" class = "btn btn-primary"><i class = "fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

        </div>
  </div>
</div>
@endsection
