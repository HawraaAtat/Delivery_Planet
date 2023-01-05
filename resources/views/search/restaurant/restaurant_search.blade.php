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
<h1 class="display-3 text-white mb-3 animated slideInDown">Restaurant</h1>
@endsection

@section('name')
<li class="breadcrumb-item text-white active" aria-current="page">Restaurant</li>
@endsection

@section('body')
{{-- <a href = "{{ Route(  "restaurants.show" , ['restaurant'=>$menu->restaurant_id] )}} " class = "product-link">Visit Store</a> --}}

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Restaurants</h5>
            <h1 class="mb-5">Search Using Specific Features</h1>
        </div>

        {{-- start search --}}
        <form action="{{ url("search_restaurant")}} " >
            @csrf
                <div class="container small my-5">
                    <div class="row d-flex justify-content-between mx-auto mt-4 mb-3">
                        <div class="row justify-content-end">
                            <div class="input-group col-lg-10 col-md-12">

                                <input class="form-control" style="text-align: center" id="search-box" type="text" name="search_name" placeholder="Enter the name here... " value="{{ $request->search_name }}"/>

                            </div>

                        </div>
                    </div>
                </div>

            <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
            </div>
        </form>
        {{-- end of search --}}


         <!-- Restaurant Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Search Result</h5>
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

    </div>
</div>
@endsection
