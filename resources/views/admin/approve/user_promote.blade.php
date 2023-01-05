@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("admin_home")}} " class="nav-item nav-link ">Home</a>
        <a href="{{ url("user_promote")}} " class="nav-item nav-link active">User</a>
        <a href="{{ url("restaurant_approve") }}" class="nav-item nav-link">Restaurant</a>
        <a href="{{ url("admmin_orders_manage") }}" class="nav-item nav-link">Manage Orders</a>

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


@section('body')


<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Users</h5>
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
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Role</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->name}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->email}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->role}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('user_promote.edit', ['user_promote'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary" style="font-size: 12px">Promote</button>
                    </form>
                    </div>

                        
                </th>

            @endforeach
        </tbody>
    </table>
    
</div>



<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Admins</h5>
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
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Role</th>
                <th class="font-weight-bold py-2 border-0 " style="color: #fea116;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $rec)
                
           
            <tr>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->id}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->name}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->email}}</th>
                <th class="font-weight-bold py-2 border-0 ">{{$rec->role}}</th>
                
                <th class="font-weight-bold py-2 border-0 ">


                    <form action="{{ route('user_promote.show', ['user_promote'=>$rec->id] ) }}" class="login-form" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-danger" style="font-size: 12px">Demote</button>
                    </form>
                    </div>

                        
                </th>

            @endforeach
        </tbody>
    </table>
    
</div>
    
</div>

@endsection