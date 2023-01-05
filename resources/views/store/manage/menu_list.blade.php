@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("store_home")}} " class="nav-item nav-link">Home</a>
        <a href="{{ url("menu_add") }}" class="nav-item nav-link active">Menu</a>
        <a href="{{ url("offer_add") }}" class="nav-item nav-link">Offers</a>
        <a href="{{ url("orders_manage") }}" class="nav-item nav-link ">Orders</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('store')}}</a>
            <div class="dropdown-menu m-0">
                <a href="{{ url("logout") }}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</div>
@endsection






@section('link')

@endsection


@section('body')


<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">menu</h5>
        <br>
        <br>
    </div>


    @if (session('flash'))
    <div class="alert alert-success mx-auto" style="text-align: center;">
        {{ session('flash') }}
    </div>
    @endif


<div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
    <form action="{{ route('menu_add.create' ) }}" class="login-form" method="post">
        @method('GET')
        @csrf
        <button type="submit" class="btn btn-primary" style="font-size: 12px">Add Plate</button>
    </form>
</div>
<br>

<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Id</th>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Name</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Price</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Calorie Count</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Diet</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Cuisine</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Description</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Edit</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->menu_name}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->price}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->calorie_count}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->diet}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->cuisine}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->description}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('menu_add.update', ['menu_add'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary" style="font-size: 12px">Edit</button>
                    </form>

                        
                </th>
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('menu_add.destroy', ['menu_add'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" style="font-size: 12px">Delete</button>
                    </form>

                        
                </th>

            @endforeach
        </tbody>
    </table>
    
</div>


    
</div>

@endsection