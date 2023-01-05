@extends('layout.app')
@extends('layout.navbar_authentication')


@section('pagelink')

     @if( !session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link ">Restaurants</a>
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
            {{-- <i class="fa" style="font-size:24px">&#xf07a;</i> --}}
        </div>
        @endif

        @if( session()->has('user') )
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
                <a href="{{ url("menu") }}" class="nav-item nav-link ">Menu</a>
                <a href="{{ url("restaurant") }}" class="nav-item nav-link ">Restaurants</a>
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


@section('body')



    @method('GET')
        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Purchase Reciept</h5>
                    <br>
                    <br>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">

                                <div class="container">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-lg-8 col-xl-6">
                                        <div class="card-body p-5">
                            
                            
                                        <div class="row">
                                            <div class="col mb-3">
                                            <p class="small text-muted mb-1">Date</p>
                                            <p>{{ $orderr->order_date}}</p>
                                            </div>
                                            <div class="col mb-3">
                                            <p class="small text-muted mb-1">Order No.</p>
                                            <p>{{ $orderr->id}}</p>
                                            </div>
                                            <div class="col mb-3">
                                            <p class="small text-muted mb-1" style="color: #fea116;">Total Price</p>
                                            <p style="color: #fea116;">$ {{$orderr->total_amount}}</p>
                                            </div>
                                        </div>
                            
                            
                                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Tracking Order</h5>
                                            <br>
                                            <br>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <div class="horizontal-timeline">
                                                    <div class="row justify-content-end">
                                                        <li class="list-inline-item items-list">
                                                            <p class="py-1 px-2 rounded text-white" style="background-color: #fea116;">{{$orderr->status}}</p
                                                            class="py-1 px-2 rounded text-white" style="background-color: #fea116;">
                                                        </li>


                                                        <li class="list-inline-item items-list">
                                                            
                                                        </li>
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <br>

                                        
                                    <form action="{{ route('order.show', ['order'=>$orderr->id] ) }}" class="login-form" method="post">
                                        @method('GET')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">order details</button>
                                        
                                    <form>
                                            
                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </section>


                        </div>
                    </div>
                </div>
            </div>
        <!-- Menu End -->


@endsection