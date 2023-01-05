<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Cart;
use App\Models\Location;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("authenticationn.login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;


        $user = User::where('Email', '=', $email)->first();
        if ($user) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            if (!Hash::check($password, $user->password)) {

                $display_message = "Wrong Password";
            } else if (Hash::check($password, $user->password)) {

                if ($user->role == "User") {
                    $data = $request->input();
                    $request->session()->put('user', $user->name);
                    $request->session()->put('user_id', $user->id);
                    $menu = Menu::where("confirmed", true)->orderBy("order_time", "desc")->get()->take(6);
                    $restaurants = Restaurant::where("confirmed", true)->orderBy("id", "desc")->get()->take(8);

                    if ($user != null) {
                        if ($user->cart) {
                            $item_cart_count = $user->cart->count();
                        } else {
                            $item_cart_count = 0;
                        }

                        return view('home.user_home', compact('restaurants', 'menu', 'item_cart_count'));
                    } else {
                        return view('home.user_home', compact('restaurants', 'menu'));
                    }
                } else if ($user->role == "Store") {

                    if ($user->confirmed == true) {
                        $data = $request->input();
                        $request->session()->put('store', $user->name);
                        $request->session()->put('store_id', $user->id);
                        return view('store.home.store_home');
                    } else if ($user->confirmed == false) {
                        $display_message = "Waiting The Admin Approval";
                        return view('authenticationn.login_success', compact('display_message', 'email', 'password'));
                    }
                } else if ($user->role == "Admin") {
                    $data = $request->input();
                    $request->session()->put('admin', $user->name);
                    return view('admin.home.admin_home');
                }
            }
        } else {
            $display_message = "You Dont Have An Account, Sign Up Now!";
        }


        return view("authenticationn.login_failed", compact('display_message', 'email', 'password'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
