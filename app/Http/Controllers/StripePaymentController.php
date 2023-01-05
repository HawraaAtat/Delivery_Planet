<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Stripe;

use Illuminate\Http\Request;


class StripePaymentController extends Controller
{
  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripe()
  {
    $user_id = session('user_id');
    $user = User::find($user_id);


    if ($user != null) {
      if ($user->cart) {
        $item_cart_count = $user->cart->count();
      } else {
        $item_cart_count = 0;
      }
      return view('cart.payment', compact('item_cart_count'));
    }
    return view('cart.payment');
  }

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripePost(Request $request)
  {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


    //     try {
    //     Stripe\Charge::create ([
    //             "amount" => 100 * 100,
    //             "currency" => "usd",
    //             "source" => $request->stripeToken,
    //             "description" => "Test payment from itsolutionstuff.com." 
    //     ]);
    //     } catch (\Stripe\Exception\InvalidRequestException $e) {
    //     // handle error
    //     Session::flash($e);
    //   }

    try {
      $charge = \Stripe\Charge::create([
        'amount' => 1000,
        'currency' => 'usd',
        //   "source" => $request->stripeToken,
        'source' => 'tok_visa',
      ]);
    } catch (\Stripe\Exception\InvalidRequestException $e) {
      // handle error
      Session::flash($e);
    }

    Session::flash('success', 'Payment successful!');

    return back();
  }
}
