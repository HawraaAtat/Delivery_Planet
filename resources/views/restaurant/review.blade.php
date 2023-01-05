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

<section id="testimonials">
    <!--heading--->
    <div class="testimonial-heading">

        {{-- 
            'user_id',
            'restaurant_id',
            'title',
            'body',
            'rating', 
        --}}

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">{{ $restaurant->restaurant_name }} Reviews</h5>
            <br>
            <br>
        </div>
        




        

            @if( !session()->has('user') )
            <a  href="{{ url("login") }}"><div type="submit" class="btn btn-primary" data-wow-delay="0.1s">Add Review</div></a>
        @endif

        @if( session()->has('user') )
            <form action="{{ route('review.show', ['review'=>$restaurant->id] ) }}" class="login-form" method="post">
                @method('GET')
                @csrf
                <button type="submit" class="btn btn-primary" data-wow-delay="0.1s">Add Review</button>
            <form>
        @endif





    </div>
    <!--testimonials-box-container------>
    <div class="testimonial-box-container">
        <!--BOX-1-------------->
        {{-- <div>{{ $review }}</div> --}}
        @foreach ($review as $rec)
            
       
        <div class="testimonial-box">
            <!--top------------------------->
            <div class="box-top">
                <!--profile----->
                <div class="profile">
                    <!--name-and-username-->
                    <div class="name-user">
                        <strong>{{$rec->title}}</strong>
                        <span>{{$rec->user->name}}</span>
                    </div>
                </div>
                <!--reviews------>
                
                <div class="reviews">
                    <div>{{$rec->rating}} <i class="fas fa-star"></i></div>
                    <!--Empty star-->
                </div>

                
            </div>
            <!--Comments---------------------------------------->
            <div class="client-comment">
                <p>{{$rec->body}}</p>
            </div>
        </div>

        @endforeach

    </div>
</section>
    
      
@endsection