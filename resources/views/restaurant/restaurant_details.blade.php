@extends('layout.app')
@extends('layout.navbar')


@section('pagelink')
    @if( !session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link active">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}" class="nav-item nav-link">Contact</a>
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
                <a href="{{ url("restaurant") }}" class="nav-item nav-link active">Restaurants</a>
                <a href="{{ url("about") }}" class="nav-item nav-link ">About</a>
                <a href="{{ url("contact") }}" class="nav-item nav-link">Contact</a>
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


@section('page_name')
<h1 class="display-3 text-white mb-3 animated slideInDown">Restaurant Details</h1>
@endsection

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/card.css')}}">
@endsection


@section('name')
<li class="breadcrumb-item"><a href="{{ url("/restaurant")}}">Restaurant</a></li>
<li class="breadcrumb-item text-white active" aria-current="page">Restaurant Details</li>
@endsection

@section('body')
{{-- <div>{{$restaurant}}</div> --}}


{{-- restaurant details --}}
    <div class="container">
        <div class = "card">
            <!-- card left -->
                <div class = "product-imgs">
                    <div class = "img-display">
                        <div class = "img-showcase">
                            <img  src="{{url('/assests/img/'. $restaurant->image)}}" alt = {{$restaurant->restaurant_name}}>
                        </div>

                    </div>
                </div>
            <!-- card right -->
                <div class = "product-content">
                    <div class="align-items-center" style="position: relative; top: 50%; transform: translateY(-50%);">
                        <h2 class = "product-title">{{$restaurant->restaurant_name}}</h2>
                        <div class = "product-rating">
                            <i class = "fas fa-star"></i>
                            <span>{{$review}}</span>
                        </div>

                        <span>Number Of Meals: {{$menu}} Meals</span>



                        <div class = "product-detail">
                            <br>
                            <h2>About this restaurant: </h2>
                            <p>{{$restaurant->description}}</p>


                            <ul>
                                <li><i class="bi bi-check"></i> cuisine: <span>{{$restaurant->cuisine}}</span></li>
                                <li><i class="bi bi-check"></i> country: <span>{{$restaurant->location->country}}</span></li>
                                <li><i class="bi bi-check"></i> city: <span>{{$restaurant->location->city}}</span></li>
                                <li><i class="bi bi-check"></i> state: <span>{{$restaurant->location->state}}</span></li>
                                <li><i class="bi bi-check"></i> building: <span>{{$restaurant->location->building}}</span></li>
                            </ul>
                        </div>

                        <div class = "purchase-info">

                            <form action="{{ route('review.edit', ['review'=>$restaurant->id] ) }}" class="login-form" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class = "btn btn-primary">
                                    Reviews
                                </button>    
                            </form>
                            </div>

                        
                        </div>

                    </div>

                </div>
        </div>
    </div>
{{-- end of restaurant details --}}


{{-- menu of the restaurant --}}

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">{{$restaurant->restaurant_name}}'s Menu</h5>
            <br>
            <br>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">



                        {{-- for --}}
                        @foreach ($restaurant->menus as $rec)


                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="{{url('/assests/img/'. $rec->image)}}" alt="" style="width: 140px;">
                                            <div class="w-100 d-flex flex-column text-start ps-4">
                                                <form action="{{ route('meals.show', ['meal'=>$rec->id] ) }}" class="login-form" method="post">
                                                    @csrf
                                                    @method('GET')
                                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                        <span>{{$rec->menu_name}}</span>
                                                        <span class="text-primary">{{'$'.$rec->price}}</span>
                                                    </h5>
                                                    <small class="fst-italic">{{$rec->description; }}</small>
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">view</button>
                                                </form>
                                            </div>
                                    </div>
                                </div>



                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end of menu of the restaurant --}}



@endsection
