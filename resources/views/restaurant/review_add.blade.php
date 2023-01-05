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

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/review.css')}}">
<link rel="stylesheet" href="{{asset('assests/css/review_add.css')}}">

<link rel="stylesheet" href="css/style.css"/>
<!--Fav-icon------------------------------>
<link rel="shortcut icon" href="images/fav-icon.png"/>
<!--poppins-font-family------------------->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!--using-Font-Awesome-------------------->
<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>

@endsection()


@section('page_name')
<h1 class="display-3 text-white mb-3 animated slideInDown">Reviews</h1>
@endsection

@section('name')
<li class="breadcrumb-item text-white active" aria-current="page">Restaurant</li>
<li class="breadcrumb-item text-white active" aria-current="page">Reviews</li>
@endsection




@section('body')

<div class="container">

    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Add Your Review</h5>
    </div>

    <div class="login-page">
        <div class="form">
          <form id="form" class="login-form" action="{{ Route(  "review.update" , ['review'=>$restaurant->id] )}} " method="Post">

            @csrf
            @method("PUT")

            <div>
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="title"/>
            @error('title')
                <label style="color: #f40142">{{$message}}</label>
            @enderror
            </div>


            <div class="container"></div>
            <label for="title">Rating</label>
            <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
               
            </div>


            @error('rate')

            <br>
            <label style="color: #f40142">{{$message}}</label>
            @enderror
            <div>
            

            <div>
            <label for="title">Content</label>
            <input type="text" name="content" placeholder="content"/>
            <br>
            @error('content')
                <label style="color: #f40142">{{$message}}</label>
            @enderror
            </div>

            <button type="submit">Post Your Review</button>

          </form>
        </div>
      </div>

</div>



@endsection