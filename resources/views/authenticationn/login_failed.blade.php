@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("signup")}} " class="nav-item nav-link ">Sign Up</a>
        <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
    </div>
</div>
@endsection


@section('body')

            <div class="container-xxl py-5">

            <div class="container">

                <!-- form -->
                <form id="form" action="{{ route('login.store') }}" method="post" >
                    @csrf
                    <h2 class="text-center mb-4 text-primary">Log In Form</h2>
                    
                        <div class="alert alert-danger mx-auto" style="text-align: center;">
                            {{$display_message}}
                        </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$email}}">

                        @error('email')
                            <label style="color: #f40142">{{$message}}</label>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control border border-primary" id="exampleInputPassword1" value="{{$password}}">

                        @error('password')
                            <label style="color: #f40142">{{$message}}</label>
                        @enderror
                    </div>
                    {{-- <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p>

                    <label for="remember" class="checkbox-hero">
                        <input type="checkbox" name="remember" id="remember" />
                        <span class="checkbox-cover"></span>
                        <span class="checkbox-name"> Remember Me </span>
                    </label> --}}

                    <br>

                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Log In</button>
                    </div>

                    <div class="mt-3">
                        <p class="mb-0  text-center">Don't have an account?
                            <a href="{{url('signup')}}" class="text-primary fw-bold">Sign Up</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>

@endsection
