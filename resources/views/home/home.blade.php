@extends('layout.app')


@section('pagelink')
     @if( !session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link active">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link">Restaurants</a>
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
                <a href="{{ url("/")}} " class="nav-item nav-link active">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link">Restaurants</a>
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



@section('navbar')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <a href="{{ url("/menu")}}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">View The Menu</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="{{url('/assests/img/hero.png')}}" alt="">
            </div>
        </div>
    </div>
</div>

@endsection



@section('body')

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x bi bi-search text-primary mb-4"></i>
                            <h5>Explore Restaurants</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                            <h5>Food Delivery</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                            <h5>Online Order</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                            <h5>24/7 Service</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Most Popular Plates</h5>
                <br>
                <br>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">



                            {{-- for --}}
                            @foreach ($menu as $rec)


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
    <!-- Menu End -->


    <!-- Restaurant Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Last Added Restaurants</h5>
                <br>
                <br>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">

                        <div class="container">
                            @foreach ($restaurants as $rec)
                                <div class="a-box">
                                        <div class="img-container">
                                            <div class="img-inner">
                                                <div class="inner-skew">
                                                <img  src="{{url('/assests/img/'. $rec->image)}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-container">
                                            <form action="{{ route('restaurants.show', ['restaurant'=>$rec->id] ) }}" class="login-form" method="post">
                                                @csrf
                                                @method('GET')
                                                <h3>{{$rec->restaurant_name}}</h3>
                                                <div>{{$rec->description}}</div>
                                                <br>
                                                <button type="submit" class="btn btn-primary">view</button>
                                                <br>
                                            </form>
                                        </div>
                                </div>
                            @endforeach

                        </div>



                            {{-- restaurant_menu relationship --}}
                            {{-- @foreach ($restaurants as $rec)
                            <div class="col-lg-6">
                                {{$rec->menus;}}
                            </div>
                            @endforeach --}}


                            {{-- menu_restaurant relationship --}}
                            {{-- @foreach ($menu as $rec)
                            <div class="col-lg-6">
                                {{$rec->restaurant;}}
                            </div>
                            @endforeach --}}





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Restaurant End -->




@endsection
