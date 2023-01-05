<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;
use App\Models\User;

class MenuPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }



            $menu = Menu::find($id);
            return view('menu.Meal_details', compact('menu', 'item_cart_count'));
        } else {
            $menu = Menu::find($id);
            return view('menu.Meal_details', compact('menu'));
        }
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



    public function search_menu(Request $request)
    {
        $search_name = $request->search_name;
        $search_price = $request->search_price;

        $price_filter = $request->price_filter;
        $cuisine_filter = $request->cuisine_filter;
        $diet_filter = $request->diet_filter;
        $offers_filter = $request->offers_filter;

        // $query = User::query();

        // if (request('search')) {
        //     $query
        //         ->where('name', 'like', '%' . request('search') . '%')
        //         ->orWhere('email', 'like', '%' . request('search') . '%')
        //         ->orWhere('id', 'like', '%' . request('search') . '%');
        // }

        // if ($request->has(['field', 'sortOrder']) && $request->field != null) {
        //     $query->orderBy(request('field'), request('sortOrder'));
        // }




        // name yes
        if ($search_name != null) {
            // price
            // price yes
            if ($search_price != null) {


                if ($price_filter == "Lower") {
                    //<

                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '<', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '<', $search_price)
                                    ->get();
                            }
                        }
                    }
                } else if ($price_filter == "Higher") {
                    //>

                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->where("price", '>', $search_price)
                                ->where("diet", $diet_filter)
                                ->get();


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("diet", $diet_filter)
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("diet", $diet_filter)
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                    }
                } else {
                    //=
                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->where("price", '=', $search_price)
                                ->where("diet", $diet_filter)
                                ->get();


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("diet", $diet_filter)
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("diet", $diet_filter)
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("menu_name", 'like', '%' . $search_name . '%')
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                    }
                }
            }
            //price no
            else if ($search_price == null) {
                //=
                //cuisine
                // cuisine yes
                if ($cuisine_filter != "Cuisine") {

                    //diet
                    //diet yes
                    if ($diet_filter != "Diet") {
                        $result = Menu::where("confirmed", true)
                            ->where("menu_name", 'like', '%' . $search_name . '%')
                            ->where("cuisine", $cuisine_filter)
                            ->where("diet", $diet_filter)
                            ->get();


                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {

                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->where("diet", $diet_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->where("diet", $diet_filter)
                                ->get();
                        }
                    }
                    //diet no
                    else if ($diet_filter == "Diet") {
                        //<

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("cuisine", $cuisine_filter)
                                ->get();
                        }
                    }
                }
                // cuisine no
                else if ($cuisine_filter == "Cuisine") {
                    //<

                    //diet
                    //diet yes
                    if ($diet_filter != "Diet") {

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("diet", $diet_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where("diet", $diet_filter)
                                ->get();
                        }
                    }
                    //diet no
                    else if ($diet_filter == "Diet") {

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("menu_name", 'like', '%' . $search_name . '%')
                                ->get();
                        }
                    }
                }
            }
        }


        //name no
        else {
            // price
            // price yes
            if ($search_price != null) {


                if ($price_filter == "Lower") {
                    //<

                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '<', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '<', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("price", '<', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '<', $search_price)
                                    ->get();
                            }
                        }
                    }
                } else if ($price_filter == "Higher") {
                    //>

                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {
                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->where("price", '>', $search_price)
                                ->where("diet", $diet_filter)
                                ->get();


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("diet", $diet_filter)
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("diet", $diet_filter)
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '>', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '>', $search_price)
                                    ->get();
                            }
                        }
                    }
                } else {
                    //=
                    //cuisine
                    // cuisine yes
                    if ($cuisine_filter != "Cuisine") {

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {
                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->where("price", '=', $search_price)
                                ->where("diet", $diet_filter)
                                ->get();


                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {

                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where("diet", $diet_filter)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {
                            //<

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("cuisine", $cuisine_filter)
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                    }
                    // cuisine no
                    else if ($cuisine_filter == "Cuisine") {
                        //<

                        //diet
                        //diet yes
                        if ($diet_filter != "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("diet", $diet_filter)
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("diet", $diet_filter)
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                        //diet no
                        else if ($diet_filter == "Diet") {

                            //offer
                            //offer yes
                            if ($offers_filter != "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '=', $search_price)
                                    ->where('has_offer', $offers_filter)
                                    ->get();
                            }
                            //offer no
                            else if ($offers_filter == "Offers") {
                                $result = Menu::where("confirmed", true)
                                    ->where("price", '=', $search_price)
                                    ->get();
                            }
                        }
                    }
                }
            }
            //price no
            else if ($search_price == null) {
                //=
                //cuisine
                // cuisine yes
                if ($cuisine_filter != "Cuisine") {

                    //diet
                    //diet yes
                    if ($diet_filter != "Diet") {
                        $result = Menu::where("confirmed", true)
                            ->where("cuisine", $cuisine_filter)
                            ->where("diet", $diet_filter)
                            ->get();


                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {

                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->where("diet", $diet_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->where("diet", $diet_filter)
                                ->get();
                        }
                    }
                    //diet no
                    else if ($diet_filter == "Diet") {
                        //<

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("cuisine", $cuisine_filter)
                                ->get();
                        }
                    }
                }
                // cuisine no
                else if ($cuisine_filter == "Cuisine") {
                    //<

                    //diet
                    //diet yes
                    if ($diet_filter != "Diet") {

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("diet", $diet_filter)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where("diet", $diet_filter)
                                ->get();
                        }
                    }
                    //diet no
                    else if ($diet_filter == "Diet") {

                        //offer
                        //offer yes
                        if ($offers_filter != "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->where('has_offer', $offers_filter)
                                ->get();
                        }
                        //offer no
                        else if ($offers_filter == "Offers") {
                            $result = Menu::where("confirmed", true)
                                ->get();
                        }
                    }
                }
            }
        }


        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }



            if ($search_name != null) {
                $data = compact('result', 'search_name', 'request', 'item_cart_count');
            } else if ($search_price != null) {
                $data = compact('result', 'search_price', 'request', 'item_cart_count');
            } else if ($search_price != null && $search_name != null) {
                $data = compact('result', 'search_name', 'search_price', 'request', 'item_cart_count');
            } else {
                $data = compact('result', 'request', 'item_cart_count');
            }
            return view('search.menu.menu_search')->with($data);
        } else {

            if ($search_name != null) {
                $data = compact('result', 'search_name', 'request');
            } else if ($search_price != null) {
                $data = compact('result', 'search_price', 'request');
            } else if ($search_price != null && $search_name != null) {
                $data = compact('result', 'search_name', 'search_price', 'request');
            } else {
                $data = compact('result', 'request');
            }
            return view('search.menu.menu_search')->with($data);
        }
    }

    public function location_search(Request $request)
    {
        $user_id = session('user_id');
        $user = User::find($user_id);


        if ($user != null) {
            if ($user->cart) {
                $item_cart_count = $user->cart->count();
            } else {
                $item_cart_count = 0;
            }

            return view("search.menu.location_search", 'item_cart_count');
        } else {
            return view("search.menu.location_search");
        }
    }
}
