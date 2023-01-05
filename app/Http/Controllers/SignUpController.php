<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('authenticationn.signup');
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
        // return "store in signup";
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6',
            'password_confirm' => 'required_with:password|same:password|min:6',
            'role' => 'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirm = $request->password_confirm;
        $role = $request->role;

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($role == "User") {

            $add = User::create(['name' => $name, 'email' => $email, 'password' => $hash, 'role' => $role, 'confirmed' => true]);
            $display_message = "You Are Signed Up Successfully, Login To Access Your Account";
            return view('authenticationn.login_success', compact('display_message', 'email', 'password'));

            return redirect('/');
        } else if ($role == "Store") {
            $add = User::create(['name' => $name, 'email' => $email, 'password' => $hash, 'role' => $role, 'confirmed' => false]);
            $display_message = "Waiting The Admin Approval";
            return view('authenticationn.login_success', compact('display_message', 'email', 'password'));
        }
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
