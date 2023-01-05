<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RestaurantApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $user=Restaurant::find($id);
        // $user->role = "User" ;
        // $user->save();

        $approved=User::where('role','Store')->where('confirmed',true)->get();
        $not_approved=User::where('role','Store')->where('confirmed',false)->get();
        return view("admin.approve.restaurant_approve", compact('approved','not_approved'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::destroy($id);
        

        $approved=User::where('role','Store')->where('confirmed',true)->get();
        $not_approved=User::where('role','Store')->where('confirmed',false)->get();
        return view("admin.approve.restaurant_approve", compact('approved','not_approved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $user->confirmed = true ;
        $user->save();

        $approved=User::where('role','Store')->where('confirmed',true)->get();
        $not_approved=User::where('role','Store')->where('confirmed',false)->get();
        return view("admin.approve.restaurant_approve", compact('approved','not_approved'));
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
