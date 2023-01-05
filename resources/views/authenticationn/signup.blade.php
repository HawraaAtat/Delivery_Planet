@extends('layout.app')
@extends('layout.navbar_authentication')

@section('pagelink')
<div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto py-0 pe-4">
        <a href="{{ url("login")}} " class="nav-item nav-link ">Log In</a>
        <a href="{{ url("/")}} " class="nav-item nav-link ">Home</a>
    </div>
</div>
@endsection


@section('body')

<div class="container">
            <div class="container-xxl py-5">

            <div class="container">
                <!-- form -->
                <form id="form" action="{{ route('signup.store') }}" method="post" >
                    @csrf
                    <h2 class="text-center mb-4 text-primary">Sign Up Form</h2>
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control border border-primary" >

                                @error('name')
                                <label style="color: #f40142">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control border border-primary" aria-describedby="emailHelp">

                                @error('email')
                                <label style="color: #f40142">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control border border-primary" >

                                @error('password')
                                <label style="color: #f40142">{{$message}}</label>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirm" class="form-control border border-primary" >

                                @error('password_confirm')
                                <label style="color: #f40142">{{$message}}</label>
                                @enderror
                            </div>


                            <fieldset>
                                <label for="exampleInputRole" class="form-label">Role</label>
                                <input type="radio" name="role" value="User"> User
                                <input type="radio" name="role" value="Store"> Store

                                @error('role')
                                <label style="color: #f40142">{{$message}}</label>
                                @enderror

                            </fieldset>

                            <br>

                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Sign Up</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <p class="mb-0  text-center">Already have an account?
                                <a href="{{url('login')}}" class="text-primary fw-bold">Log In</a>
                            </p>
                        </div>
                </form>

            </div>
        </div>
</div>
@endsection


