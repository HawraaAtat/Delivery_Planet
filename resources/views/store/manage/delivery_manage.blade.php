@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("store_home")}} " class="nav-item nav-link">Home</a>
        <a href="{{ url("menu_add") }}" class="nav-item nav-link">Menu</a>
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
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Pending Restaurants</h5>
        <br>
        <br>
    </div>
<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Id</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Name</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Email</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Confirmed</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($not_approved as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->name}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->email}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->confirmed}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('restaurant_approve.edit', ['restaurant_approve'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary" style="font-size: 12px">Approve</button>
                    </form>
                    </div>

                        
                </th>

            @endforeach
        </tbody>
    </table>
    
</div>



<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Approved Restaurant</h5>
        <br>
        <br>
    </div>
<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Id</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Name</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Email</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Confirmed</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approved as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->name}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->email}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->confirmed}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('restaurant_approve.show', ['restaurant_approve'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-danger" style="font-size: 12px">Delete</button>
                    </form>
                    </div>

                        
                </th>

            @endforeach
        </tbody>
    </table>
    
</div>
    
</div>

@endsection