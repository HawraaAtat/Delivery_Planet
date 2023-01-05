@extends('layout.app')
@extends('layout.navbar_authentication')

@section('link')

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- Fonts referenced in mdbootstrap, moved up to reduce page load time -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css" rel="stylesheet"/>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Material Design Bootstrap -->
<link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/mdb.min.css?version=0707050300507050503" type='text/css'/>  
<link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/storefront.css?version=0707050300507050503" type='text/css'/>
<link rel="stylesheet" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/autocomplete.css?version=0707050300507050503"/>
<link rel="stylesheet" type="text/css" href="../css/ps/theme.css?version=0707050300507050503">
    

<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="//cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet"  type="text/css" href="https://gensuiteqa.genalphacatalog.com/gensuite/css/ps/orderhistory.css?version=0707050300507050503" />

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


<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Order Details</h5>
        <br>
        <br>
    </div>
<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Order Id</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Total Amount</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Shipping Type</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Address</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Status</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Order Date</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->total_amount}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->shipping_type}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->address}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->status}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->order_date}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('order.edit', ['order'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary" style="font-size: 12px">View Order</button>
                    </form>
                    </div>

                        
                </th>
              



            @endforeach
        </tbody>
    </table>
</div>

    


@endsection