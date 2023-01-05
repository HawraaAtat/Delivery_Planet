@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("admin_home")}} " class="nav-item nav-link ">Home</a>
        <a href="{{ url("user_promote")}} " class="nav-item nav-link">User</a>
        <a href="{{ url("restaurant_approve") }}" class="nav-item nav-link">Restaurant</a>
        <a href="{{ url("admmin_orders_manage") }}" class="nav-item nav-link active">Manage Orders</a>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{session('admin')}}</a>
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
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Deliveries</h5>
        <br>
        <br>
    </div>
<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Id</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Total</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Shipping Type</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Address</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Status</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Date</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $rec)
                
           
            <tr>                
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->total_amount}}$</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->shipping_type}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->address}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->status}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->order_date}}</th>
                
                

            @endforeach
        </tbody>
    </table>
</div>
</div>

<br>


<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Orders</h5>
        <br>
        <br>
    </div>
<div class="table-responsive pb-5">
    <table id="tbOrderHistory" class="table border ps-table w-100 mb-3">
        <thead>
            <tr>
                <th class="font-weight-bold py-2 border-0" style="color: #fea116;">Id</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Total</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Shipping Type</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Address</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Status</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $rec)
                
           
            <tr>                
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->total_amount}}$</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->shipping_type}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->address}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->status}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->order_date}}</th>
                
                

            @endforeach
        </tbody>
    </table>
    
</div>


</div>

@endsection