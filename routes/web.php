<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
Route::get('/clearall', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    echo "Cleared all caches successfully.";
});

// Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::get('/author', function () {
        //     return view('user.home');
        // });
       // Route::get("/author",[AdminController::class,'adminhome'])->middleware('auth');


Route::group(['middleware'=>['auth:sanctum','verified','accessrole',]],function(){
// CAT
Route::get("/cat",[BasicController::class,'showcat']);
Route::get("/cat/{id}",[BasicController::class,'showcatbyid']);
Route::post("/up_cat",[BasicController::class,'updatecat']);
Route::post("/create_cat",[BasicController::class,'createcat']);
Route::post("/delcat",[BasicController::class,'delcats']);





// SUB CAT
Route::get("/subcat",[BasicController::class,'showsubcat']);
Route::get("/subcat/{id}",[BasicController::class,'showsubcatbyid']);
Route::post("/up_subcat",[BasicController::class,'updatesubcat']);
Route::post("/create_subcat",[BasicController::class,'createsubcat']);
Route::post("/delsubcat",[BasicController::class,'delsubcats']);



// BRAND CAT
Route::get("/brand",[BasicController::class,'showbrand']);
Route::get("/brand/{id}",[BasicController::class,'showbrandbyid']);
Route::post("/up_brand",[BasicController::class,'updatebrand']);
Route::post("/create_brand",[BasicController::class,'createbrand']);
Route::post("/delbrand",[BasicController::class,'delbrand']);

// PRODUCT TYPE
Route::get("/producttype",[BasicController::class,'showprtype']);
Route::get("/producttype/{id}",[BasicController::class,'showprtypebyid']);
Route::post("/up_prtype",[BasicController::class,'updateprtype']);
Route::post("/create_prtype",[BasicController::class,'createprtype']);
Route::post("/delprtype",[BasicController::class,'delprtype']);


//UNIT
Route::get("/unit",[BasicController::class,'showunit']);
Route::get("/unit/{id}",[BasicController::class,'showunitbyid']);
Route::post("/up_unit",[BasicController::class,'updateunit']);
Route::post("/create_unit",[BasicController::class,'createunit']);
Route::post("/delunit",[BasicController::class,'delunit']);


//COLOR New
Route::get("/color/create",[BasicController::class,'showcolornew']);

Route::post("/create_color_new",[BasicController::class,'createcolornew']);
Route::post("/delcolor_new",[BasicController::class,'delcolornew']);
//Size New
Route::get("/size/create",[BasicController::class,'showsizenew']);

Route::post("/create_size_new",[BasicController::class,'createsizenew']);
Route::post("/delsize_new",[BasicController::class,'delsizenew']);

//COLOR
Route::get("/color",[BasicController::class,'showcolor']);

Route::post("/create_color",[BasicController::class,'createcolor']);
Route::post("/delcolor",[BasicController::class,'delcolor']);
//SIZE
Route::get("/size",[BasicController::class,'showsize']);
Route::post("/create_size",[BasicController::class,'createsize']);
Route::post("/delsize",[BasicController::class,'delsize']);


//COST
Route::get("/dailycost",[BasicController::class,'showcost']);

Route::post("/create_cost",[BasicController::class,'createcost']);
Route::post("/delcost",[BasicController::class,'delcost']);






//Product
Route::get("/product",[ProductController::class,'showproduct']);
Route::get("/product/{name}",[ProductController::class,'productbytitle']);
// Route::get("/return_product/{code}",[ProductController::class,'returnviewpr']);
// Route::post("/return_pr",[ProductController::class,'junkproduct']);
Route::get("/productadd",[ProductController::class,'addnewproduct']);
Route::get("/up_product",[ProductController::class,'addnewproduct']);
Route::post("/up_product",[ProductController::class,'updateproduct']);
Route::post("/create_product",[ProductController::class,'inserproduct']);
Route::post("/junkproduct",[ProductController::class,'junkproduct']);
Route::get('dropdownlist/getstates/{id}',[ProductController::class,'getStates']);

// BANNER
Route::get("/banner",[ProductController::class,'showbanner']);
Route::post("/create_banner",[ProductController::class,'createbanner']);
Route::post("/delbanner",[ProductController::class,'delbanner']);

//ORDER
Route::get("/customer/order",[OrderController::class,'orderproductview']);
Route::get("/customer/order/ontheway",[OrderController::class,'orderproductview_one']);
Route::get("/customer/order/delivered",[OrderController::class,'orderproductview_two']);
Route::get("/confirm_payment/{id}",[OrderController::class,'payconfirmation']);
Route::get("/delivery_status/{id}",[OrderController::class,'makeontheway']);
Route::get("/delivery_status_final/{id}",[OrderController::class,'Delivered']);
Route::get("/cancell_product_order/{product_code}/{sleep_no}",[OrderController::class,'cencelproductorder']);



//image
Route::get("/image",[BasicController::class,'showimage']);
Route::post("/create_image",[BasicController::class,'creatimages']);
Route::post("/delimage",[BasicController::class,'delimage']);


//STOCK
Route::get("/author",[AdminController::class,'totalsell'])->middleware('auth');
Route::get("/sell/history",[BasicController::class,'viewsellhistory']);

//INVOICE

Route::get("/invoice/{sleep}",[OrderController::class,'showinvoice']);
Route::get("/guestdetails/{phone}",[OrderController::class,'showguestinvoice']);




//POS

Route::get("/poshome",[PosController::class,'posview']);
Route::get("/poshome/{id}",[PosController::class,'posviewbycat']);
Route::get("/add_cart_admin/{product_code}",[HomeController::class,'addtocartadmin'])->middleware('auth');

Route::post("/add_cart_admin",[PosController::class,'addtoorderguest'])->middleware('auth');
Route::post("/update_cart_admin",[HomeController::class,'updatecartadmin'])->middleware('auth');
Route::get("/remove_cart_admin/{id}",[HomeController::class,'removecartadmin'])->middleware('auth');

Route::get("/guestlist",[PosController::class,'guestall']);
Route::get("/guestpay/{phone}",[PosController::class,'showguestpayform']);
Route::post("/pay_due",[PosController::class,'duepay']);


//Online customer
Route::get("/customer",[AdminController::class,'showcustomer']);

//Purchase Products Zone
Route::get("/purchase/agent",[PosController::class,'agentlist']);
Route::post("/purchase/agent",[PosController::class,'addagentlist']);

Route::get("/purchase/product",[PosController::class,'viewpurchase']);
Route::post("/purchase/product",[PosController::class,'addpurchase']);
Route::post("/purchase/product/stockadd",[PosController::class,'addpurchasetostock']);
Route::get("/add_stock/{id}",[PosController::class,'viewasidstock']);
Route::get("purchase/stock/already",[PosController::class,'alreadyadded']);
Route::get("purchase/stock/already/{id}",[PosController::class,'alreadyadded']);


//Route::get("purchese/due",[PosController::class,'totaldueatagent']);

 Route::get("purchese/due/{id}",[PosController::class,'totaldueatagent']);
 Route::post("purchese/due",[PosController::class,'addtotaldueatagent']);



});
// Route::get("/guest/{id}",[PosController::class,'guestbyid']);



//For Customer

Route::get("/",[HomeController::class,'index']);
Route::get("/product/details/{product_code}",[HomeController::class,'singleproduct']);
Route::get("/shop",[HomeController::class,'viewshop']);
Route::get("/shop/subcat/{name}",[HomeController::class,'viewshopbysubcat']);
Route::get("/shop/brand/{name}",[HomeController::class,'viewshopbybrand']);
Route::get("/shop/type/{name}",[HomeController::class,'viewshopbytype']);
Route::get("search/product",[HomeController::class,'searchproduct']);

Route::get("/add_cart/{product_code}",[HomeController::class,'addtocartpr'])->middleware('auth');
Route::post("/add_cart",[HomeController::class,'addtocart'])->middleware('auth');
Route::post("/update_cart",[HomeController::class,'updatecart'])->middleware('auth');
Route::post("/remove_cart",[HomeController::class,'removecart'])->middleware('auth');
Route::get("/cart",[HomeController::class,'viewcart'])->middleware('auth');;


//order
//Route::get("/order_process",[HomeController::class,'viewcart']);
Route::post("/add_order",[HomeController::class,'addtoorder'])->middleware('auth');
Route::get("/order",[HomeController::class,'orderview'])->middleware('auth');


//Review
Route::get("/review",[HomeController::class,'viewreviewproduct'])->middleware('auth');
Route::get("/add_review/{code}",[HomeController::class,'addreviewproductview'])->middleware('auth');
Route::post("/addreview",[HomeController::class,'addreview'])->middleware('auth');




Route::get("/about_us",[HomeController::class,'aboutus']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


