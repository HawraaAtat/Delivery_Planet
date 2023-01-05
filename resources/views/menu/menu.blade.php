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
                <a href="{{ url("menu") }}" class="nav-item nav-link active">Menu</a>
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


@section('page_name')
<h1 class="display-3 text-white mb-3 animated slideInDown">Menu</h1>
@endsection

@section('name')
<li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
@endsection


@section('body')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Search Using Specific Features</h1>
        </div>

        {{-- start search --}}
        <form action="{{ url("search_menu")}} " >
        @csrf
            <div class="container small my-5">
                <div class="row d-flex justify-content-between mx-auto mt-4 mb-3">
                    <div class="row justify-content-end">
                        <div class="input-group col-lg-10 col-md-12">

                            <input class="form-control" style="text-align: center" id="search-box" type="text" name="search_name" placeholder="Enter the name here... " />

                        </div>

                    </div>
                </div>
            </div>

            <div class="container small my-5">
                <div class="row d-flex justify-content-between mx-auto mt-4 mb-3">
                    <div class="row justify-content-end">
                        <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">

                                <div class="input-group-append">
                                    <select class="form-control input-group-prepend btn btn-secondary py-2 px-4" id="search-filter" name="price_filter">
                                        <option value="Price">Price</option>
                                        <option value="Lower">Lower <</option>
                                        <option value="Higher">Higher ></option>
                                        <option value="Equal">Equal =</option>
                                    </select>
                                </div>

                                <input class="form-control" style="text-align: center" id="search-box" type="text" name="search_price" placeholder="Enter price here... " />

                                <div class="input-group-append">
                                <select class="form-control input-group-prepend btn btn-secondary py-2 px-4" id="search-filter" name="cuisine_filter">
                                    <option value="Cuisine">Cuisine</option>
                                    <option value="Ethiopian">Ethiopian</option>
                                    <option value="French">French</option>
                                    <option value="Hawaiian">Hawaiian</option>
                                    <option value="Indian">Indian</option>
                                    <option value="Italian">Italian</option>
                                    <option value="Japanese">Japanese</option>
                                </select>
                                </div>
                                <div class="input-group-append">
                                    <select class="form-control input-group-prepend btn btn-secondary py-2 px-4" id="search-filter" name="diet_filter">
                                        <option value="Diet">Diet</option>
                                        <option value="Ketogenic">Ketogenic</option>
                                        <option value="Paleolithic">Paleolithic</option>
                                        <option value="Vegan">Vegan</option>
                                        <option value="Mediterranean">Mediterranean</option>
                                    </select>
                                </div>
                                <div class="input-group-append">
                                    <select class="form-control input-group-prepend btn btn-secondary py-2 px-4" id="search-filter" name="offers_filter">
                                        <option value="Offers">Offers</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container small my-5">
                    <div class="row d-flex justify-content-between mx-auto mt-4 mb-3">
                        <div class="row justify-content-end">
                            <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
        {{-- end of search --}}


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

    </div>
</div>
@endsection

