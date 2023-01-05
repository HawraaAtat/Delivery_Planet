<?php

use App\Http\Controllers\AdmninOrdersManageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Location;
use App\Models\User;
use App\Models\Cart;
use App\Http\Controllers\MenuPostController;
use App\Http\Controllers\RestaurantPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RestaurantApproveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserPromoteController;
use App\Http\Controllers\OpperationManageController;
use App\Http\Controllers\StoreAddMenuController;
use App\Http\Controllers\StoreAddRestaurantController;
use App\Http\Controllers\StoreOfferAddController;
use App\Http\Controllers\StoreOrdersManageController;
use App\Mail\Contactme;
use App\Models\Orders;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});




Route::get("/", [HomeController::class, 'index']);
Route::get("/admin_home", [HomeController::class, 'admin_home']);
Route::get("/store_home", [HomeController::class, 'store_home']);
Route::get("/user_home", [HomeController::class, 'user_home']);

Route::get("/about", [HomeController::class, 'about']);
Route::get("/menu", [HomeController::class, 'menu']);
Route::get("/restaurant", [HomeController::class, 'restaurant']);





Route::get("/search_menu", [MenuPostController::class, 'search_menu']);
Route::get("/search_restaurant", [RestaurantPostController::class, 'search_restaurant']);
Route::get("/location_search", [MenuPostController::class, 'location_search']);




Route::resource("meals", MenuPostController::class);
Route::resource("restaurants", RestaurantPostController::class);
Route::resource("review", ReviewController::class);

Route::resource("login", LoginController::class);
Route::resource("signup", SignUpController::class);
Route::resource("cart", CartController::class);
Route::resource("order", OrdersController::class);

Route::get('logout', function () {
    if (session()->has('user')) {
        session()->pull('user');
        return redirect('/');
    }
    if (session()->has('admin')) {
        session()->pull('admin');
        return redirect('/');
    }
    if (session()->has('store')) {
        session()->pull('store');
        return redirect('/');
    } else {
        return redirect('/');
    }
});




////////////////// Payement //////////////////////
Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');




Route::get('/order_history', function () {


    $user_id = session('user_id');
    $user = User::find($user_id);

    if ($user->cart) {
        $item_cart_count = $user->cart->count();
    } else {
        $item_cart_count = 0;
    }

    $orders = Orders::all();
    // return $orders;

    return view("cart.order_history", compact('item_cart_count', 'orders'));
});



/////////////////// contact us mail smtp /////////////////////////
Route::get('/contact', function () {


    $user_id = session('user_id');
    $user = User::find($user_id);

    if ($user != null) {

        if ($user->cart) {
            $item_cart_count = $user->cart->count();
        } else {
            $item_cart_count = 0;
        }

        return view('mail.contact_page', compact('item_cart_count'));
    } else {
        return view('mail.contact_page');
    }
});


Route::post('/contact', function (Request $request) {



    $user_id = session('user_id');
    $user = User::find($user_id);

    if ($user != null) {

        if ($user->cart) {
            $item_cart_count = $user->cart->count();
        } else {
            $item_cart_count = 0;
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required|min:3|max:30',
            'message' => 'required|min:3|max:150',
            'subject' => 'required|min:3|max:100',
        ]);

        $data = request(['name', 'email', 'subject', 'message']);
        Mail::to('Hawraa.atat50@gmail.com')->send(new Contactme($data));
        return redirect('/contact')->with([
            'flash' => 'Message sent successfully!',
            'item_cart_count' => $item_cart_count
        ]);

    } else {
        $data = request(['name', 'email', 'subject', 'message']);
        Mail::to('Hawraa.atat50@gmail.com')->send(new Contactme($data));
        return redirect('/contact')->with('flash', 'Message sent successfully!');
    }
});



//////////////////// admin ////////////////////
Route::resource("user_promote", UserPromoteController::class);
Route::resource("restaurant_approve", RestaurantApproveController::class);
Route::resource("admmin_orders_manage", AdmninOrdersManageController::class);



//////////////////// store ///////////////////
Route::resource("menu_add", StoreAddMenuController::class);
Route::resource("add_restaurant", StoreAddRestaurantController::class);
Route::resource("offer_add", StoreOfferAddController::class);
Route::resource("orders_manage", StoreOrdersManageController::class);

























/////////////////  data fill  ////////////////////
Route::get('datafill', function () {

    $restaurant = Restaurant::create([
        'location_id' => 1,
        'restaurant_name' => 'macdo',
        'cuisine' => 'japanese',
        'description' => 'i am a retaurant',
        'image' => 'restaurant-1.jpg',
        'confirmed' => true,
    ]);
    $restaurant = Restaurant::create([
        'location_id' => 1,
        'restaurant_name' => 'macdooooo',
        'cuisine' => 'japanessse',
        'description' => 'i am a retaurant',
        'image' => 'restaurant-3.jpg',
        'confirmed' => true,
    ]);
    $restaurant = Restaurant::create([
        'location_id' => 2,
        'restaurant_name' => 'macdooo',
        'cuisine' => 'japanessssssse',
        'description' => 'i am a retaurant',
        'image' => 'restaurant-2.jpg',
        'confirmed' => true,
    ]);

    $menu = Menu::create([
        'restaurant_id' => 1,
        'menu_name' => 'Big Mac',
        'price' => '15',
        'calorie_count' => '556.45',
        'diet' => 'Paleolithic',
        'cuisine' => 'French',
        'description' => 'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time' => 9,
        'image' => 'menu-4.jpg',
        'confirmed' => true,
        'has_offer' => 'no',
    ]);

    $menu = Menu::create([
        'restaurant_id' => 2,
        'menu_name' => 'Big Macc',
        'price' => '15',
        'calorie_count' => '556.45',
        'diet' => 'Ketogenic',
        'cuisine' => 'Hawaiian',
        'description' => 'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time' => 4,
        'image' => 'menu-5.jpg',
        'confirmed' => true,
        'has_offer' => 'yes',
    ]);
    $menu = Menu::create([
        'restaurant_id' => 3,
        'menu_name' => 'Big Macccc',
        'price' => '15',
        'calorie_count' => '556.45',
        'diet' => 'Vegan',
        'cuisine' => 'Indian',
        'description' => 'The Big Mac is a hamburger sold by the international fast food restaurant chain McDonald\'s. It was introduced in the Greater Pittsburgh area in 1967 and across the United States in 1968. It is one of the company\'s flagship products and signature dishes.',
        'order_time' => 3,
        'image' => 'menu-6.jpg',
        'confirmed' => true,
        'has_offer' => 'yes',
    ]);

    $location = Location::create([
        'country' => 'Lebanon',
        'city' => 'Beirouth',
        'state' => 'Beirouth',
        'building' => 'Building 1',
    ]);





    Review::create([
        'user_id' => 1,
        'restaurant_id' => 2,
        'title' => 'Delicious food',
        'body' => 'I stopped by this fast food restaurant on my way home from work and was pleasantly surprised by the quality of the food. The burgers were juicy and cooked to perfection, and the fries were crispy and delicious. The service was also great - the staff were friendly and efficient, and the restaurant was clean and well-maintained. Overall, I had a great experience and would definitely come back again.',
        'rating' => 5,

    ]);
    Review::create([
        'user_id' => 1,
        'restaurant_id' => 2,
        'title' => 'Pleasantly surprised by the quality',
        'body' => 'I stopped by this fast food restaurant on my way home from work and was pleasantly surprised by the quality of the food. The burgers were juicy and cooked to perfection, and the fries were crispy and delicious. The service was also great - the staff were friendly and efficient, and the restaurant was clean and well-maintained. Overall, I had a great experience and would definitely come back again.',
        'rating' => 4,

    ]);
    Review::create([
        'user_id' => 1,
        'restaurant_id' => 1,
        'title' => 'A great experience',
        'body' => 'I stopped by this fast food restaurant on my way home from work and was pleasantly surprised by the quality of the food. The burgers were juicy and cooked to perfection, and the fries were crispy and delicious. The service was also great - the staff were friendly and efficient, and the restaurant was clean and well-maintained. Overall, I had a great experience and would definitely come back again.',
        'rating' => 4,

    ]);
    Review::create([
        'user_id' => 1,
        'restaurant_id' => 1,
        'title' => 'Impressive burgers and fries',
        'body' => 'I stopped by this fast food restaurant on my way home from work and was pleasantly surprised by the quality of the food. The burgers were juicy and cooked to perfection, and the fries were crispy and delicious. The service was also great - the staff were friendly and efficient, and the restaurant was clean and well-maintained. Overall, I had a great experience and would definitely come back again.',
        'rating' => 3,

    ]);

    $restaurant = Restaurant::create([
        'location_id' => 1,
        'restaurant_name' => 'Macdo',
        'cuisine' => 'japanessse',
        'description' => 'i am a retaurant',
        'image' => 'restaurant-3.jpg',
        'confirmed' => true,
    ]);



    echo $restaurant;
    echo $menu;
    echo $location;
});


//create menu-restaurant realionship 
// Route::get('menurelationfill', function () {

//     $restaurant =Restaurant::find(2);
//     $menu =Menu::find(1);
//     $restaurant->menus()->save($menu);
//     ///////////////////////////
//     return $restaurant->menus;
//     /////////////////////////////
// });

// //create user-cart realionship
// Route::get('cartrelationfill', function () {

//     $user = User::find(3);
//     //am nkhl2 l cart lal user l id l elo 3
//     $cart= Cart::create(['user_id',3]);
//     echo $user->cart()->save($cart);
//     return $user->cart()->get();
// });


//create user-menu realionship
Route::get('menu_user_relationfill', function () {

    $user = User::find(3);
    $menu = Menu::find(1);
    return $user->menus()->save($menu);
    //am nkhl2 l cart lal user l id l elo 3
    $cart = Cart::create(['user_id', 3]);
    echo $user->cart()->save($cart);
    return $user->cart()->get();
});


//create users

Route::get('userfill', function () {
    $hash1 = password_hash('Hawraa123@', PASSWORD_DEFAULT);
    $hash2 = password_hash('Perla123@', PASSWORD_DEFAULT);
    $hash3 = password_hash('Abdallah123@', PASSWORD_DEFAULT);
    $hash4 = password_hash('Admin123@', PASSWORD_DEFAULT);
    $hash5 = password_hash('Macdo123@', PASSWORD_DEFAULT);

    $user1 = User::create(['name' => 'hawraa', 'email' => 'hawraa@gmail.com', 'password' => $hash1, 'role' => 'User']);
    $user2 = User::create(['name' => 'perla', 'email' => 'perla@gmail.com', 'password' => $hash2, 'role' => 'User']);
    $user3 = User::create(['name' => 'abdallah', 'email' => 'abdallah@gmail.com', 'password' => $hash3, 'role' => 'User']);
    $user4 = User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => $hash4, 'role' => 'Admin']);
    $user5 = User::create(['name' => 'macdo', 'email' => 'macdo@macdo.com', 'password' => $hash5, 'role' => 'Store', 'confirmed' => false]);


    $restaurant=Restaurant::find(1);
    // $user5->restaurant()->save($restaurant);

    $restaurant->user()->save($restaurant);

    echo $restaurant->user;

});

Route::get('sum', function () {
    $user_id = session('user_id');
    return Cart::where('user_id', $user_id)->sum('price');
});


Route::get('addrel', function () {
    $restaurant=Restaurant::find(1);
    // $user5->restaurant()->save($restaurant);

    $user=User::find(5);

    $restaurant->user()->associate($user);
    $restaurant->save();
});

