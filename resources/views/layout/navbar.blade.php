@section('navbar')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        @yield('page_name')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ url("/")}}">Home</a></li>
                @yield('name')
            </ol>
        </nav>
    </div>
</div>
@endsection
