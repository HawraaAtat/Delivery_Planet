@extends('layout.app')
@extends('layout.navbar_authentication')

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/cart.css')}}">
<link rel="stylesheet" href="{{asset('assests/js/cart.js')}}">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

@endsection


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
<form action="{{ Route( "order.store" ) }} " method="post">
        @csrf
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted">{{$count}} items</h6>
                    </div>
                    <hr class="my-4">
  
                    @foreach ($cart as $rec)
                        
                    
                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                        src="{{url('/assests/img/'. $rec->image)}}"
                          class="img-fluid rounded-3" alt="Cotton T-shirt">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-muted">{{$rec->menu_name}}</h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fas fa-minus"></i>
                        </button>
  
                        <input id="form1" min="0" name="quantity" value="1" type="number"
                          class="form-control form-control-sm" />
  
                        <button class="btn btn-link px-2"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h6 class="mb-0">$ {{$rec->price}}</h6>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href=" {{ route('cart.show', ['cart'=>$rec->id] ) }} " class="text-muted"><i class="fas fa-times"></i></a>
                      </div>
                    </div>
  
                    @endforeach
                    
  
                    <hr class="my-4">
  
                    <div class="pt-5">
                      <h6 class="mb-0"><a href="{{ url("/")}}" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Back to home</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">
  
                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">items: {{$count}}</h5>
                    </div>
                    
  
                    <h5 class="text-uppercase mb-3">Shipping</h5>
  

                    
                    <div class="input-group-append">
                        <select class="form-control input-group-prepend btn btn-secondary py-2 px-4" id="search-filter" name="shipping_type">
                            <option value="">Select shipping type</option>
                            <option value="Standard">Standard shipping</option>
                            <option value="Local">Local pickup</option>
                        </select>
                        @error('shipping_type')
                            <label style="color: #f40142">{{$message}}</label>
                        @enderror
                    </div>

                    
                    
  
                    <h5 class="text-uppercase mb-3">Address</h5>
  
                        <input type="text" name="address" id="form3Examplea2" class="form-control form-control-lg" />
                        @error('address')
                            <label style="color: #f40142">{{$message}}</label>
                        @enderror

             

                    
                    <h5 class="text-uppercase mb-3">Date</h5>

                    <div class="input-group-append">
                      <div class="form-outline">
                        <div class="ui calendar" id="example1">
                          <div class="ui input left icon" style="width: 100%">
                            <i class="calendar icon"></i>
                            <input type="text" name="date_time" placeholder="Date/Time">
                          </div>
                        </div>
                        </div>
                        @error('date_time')
                            <label style="color: #f40142">{{$message}}</label>
                        @enderror


                    
  
                    <hr class="my-4">
  
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5>$ {{$total}}</h5>
                    </div>
  
                    {{-- ////////////////////////////////////////////////////////////////////// --}}

                    <input type="hidden" value="{{$total}}" name="total_price" id="total_price">

                    {{-- ////////////////////////////////////////////////////////////////////// --}}



                    <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center; width:100%">
                            <button type="submit" class="btn btn-primary btn-block btn-lg" >Check Out</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>


              <script>
                $('#example1').calendar();
              </script>
@endsection

