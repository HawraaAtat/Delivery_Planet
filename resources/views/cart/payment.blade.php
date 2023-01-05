@extends('layout.app')
@extends('layout.navbar_authentication')

@section('link')
<link rel="stylesheet" href="{{asset('assests/css/payment.css')}}">

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
  
    
    <div class="row">
        
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <div style="margin-left: 20">
                            <h3 class="panel-title display-td" >Payment Details</h3>
                        </div>
                    </div>                    
                </div>
                <br>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form 
                            role="form" 
                            action="{{ route('stripe.post') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
  
                        <div class='form-row row'>
                            <div style="width: 90% ; margin: 0 auto">
                                <label class='control-label'>Name on Card</label> 
                                    <input class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <br>
  
                        <div class='form-row row'>
                            <div style="width: 90% ; margin: 0 auto">
                                <label class='control-label'>Card Number</label> 
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>

                        
                        <br>

                    <div style="width: 90% ; margin: 0 auto">
                        <div class='form-row row'>
                            
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> 
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> 
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> 
                                    <input  class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                        </div>
                    </div>

                        <br>
  
                        
                        {{-- <div style="width: 90% ; margin: 0 auto">
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                </div>
                            </div>
                        </div> --}}






                            <div class="row d-flex justify-content-between mx-auto mt-4 mb-3">
                                <div class="row justify-content-end">
                                    <div class="input-group col-lg-10 col-md-12" style=" justify-content: center; align-items: center;">
                                        <button type="submit" class="btn btn-primary  btn-lg btn-block">Pay Now</i></button>
                                    </div>
                                </div>
                            </div>


                          
                    </form>
                </div>
            </div>        
        
    </div>



      
</div>


<script>
    
$(function() {
   
   var $form = $(".require-validation");
  
   $('form.require-validation').bind('submit', function(e) {
       var $form         = $(".require-validation"),
       inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
       $inputs       = $form.find('.required').find(inputSelector),
       $errorMessage = $form.find('div.error'),
       valid         = true;
       $errorMessage.addClass('hide');
 
       $('.has-error').removeClass('has-error');
       $inputs.each(function(i, el) {
         var $input = $(el);
         if ($input.val() === '') {
           $input.parent().addClass('has-error');
           $errorMessage.removeClass('hide');
           e.preventDefault();
         }
       });
  
       if (!$form.data('cc-on-file')) {
         e.preventDefault();
         Stripe.setPublishableKey($form.data('stripe-publishable-key'));
         Stripe.createToken({
           number: $('.card-number').val(),
           cvc: $('.card-cvc').val(),
           exp_month: $('.card-expiry-month').val(),
           exp_year: $('.card-expiry-year').val()
         }, stripeResponseHandler);
       }
 
 });
 
 function stripeResponseHandler(status, response) {
       if (response.error) {
           $('.error')
               .removeClass('hide')
               .find('.alert')
               .text(response.error.message);
       } else {
           /* token contains id, last4, and card type */
           var token = response['id'];
              
           $form.find('input[type=text]').empty();
           $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
           $form.get(0).submit();
       }
   }
  
});
</script>
@endsection