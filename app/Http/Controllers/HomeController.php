<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Billing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Subcat;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Producttype;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Order;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Rataut;
use App\Models\Size;
use App\Models\Sleep;
use App\Models\User;
use Session;
class HomeController extends Controller
{
    public $a = 20;
    public function index()
    {
        $allcat = Cat::all();
        $allproduct =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->take(16)->latest('products.id')->get();
        $slides = Banner::where('banner_flag',0)->get();
        return view('home',compact('allproduct','allcat','slides'));

    }

    public function viewshop()
    {
        $allcat = Cat::all();
        $allbrand = Brand::all();
        $banner = Banner::where('banner_flag',1)->first();
        $allproduct =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->latest('products.id')->paginate($this->a);
        $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();
        return view('shop',compact('allproduct','allbrand','allcat','popular','banner'));

    }

    public function viewshopbysubcat($name)
    {
        $allcat = Cat::all();
        $allbrand = Brand::all();
        $banner = Banner::where('banner_flag',1)->first();
        $allproduct =Product::where('junk', 0)->where('subcats.subcat_name', $name)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->latest('products.id')->paginate($this->a);
        $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();
        return view('shop',compact('allproduct','allbrand','allcat','popular','banner'));
    }

    public function viewshopbybrand($name)
    {
        $allcat = Cat::all();
        $allbrand = Brand::all();
        $banner = Banner::where('banner_flag',1)->first();
        $allproduct =Product::where('junk', 0)->where('brands.brand_name', $name)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->latest('products.id')->paginate($this->a);
        $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();
        return view('shop',compact('allproduct','allbrand','allcat','popular','banner'));
    }
    public function viewshopbytype($name)
    {
        $allcat = Cat::all();
        $allbrand = Brand::all();
        $banner = Banner::where('banner_flag',1)->first();
        $allproduct =Product::where('junk', 0)->where('producttypes.product_type', $name)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->latest('products.id')->paginate($this->a);
        $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();
        return view('shop',compact('allproduct','allbrand','allcat','popular','banner'));
    }

    public function searchproduct(Request $request)
    {

       $search =  $request->query('search');
       $allcat = Cat::all();
        $allbrand = Brand::all();
       $allproduct =Product::where('junk', 0)->where('products.name','LIKE',"%{$search}%")->orWhere('products.details','LIKE',"%{$search}%")->orWhere('cats.cat_name','LIKE',"%{$search}%")->orWhere('subcats.subcat_name','LIKE',"%{$search}%")->orWhere('brands.brand_name','LIKE',"%{$search}%")->orWhere('producttypes.product_type','LIKE',"%{$search}%")->join('cats', 'products.cat_id', '=', 'cats.id')
       ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
       ->join('brands', 'products.brand_id', '=', 'brands.id')
       ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
       ->join('units', 'products.unit_id', '=', 'units.id')->latest('products.id')->paginate($this->a);
       $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
       ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
       ->join('brands', 'products.brand_id', '=', 'brands.id')
       ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
       ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();
       $banner = Banner::where('banner_flag',1)->first();
       return view('shop',compact('allproduct','allbrand','allcat','popular','banner'));

    }

    public function singleproduct($code)
    {
        $prtest = Product::where('product_code', '=',$code)->first();
        if ($prtest==null) {
            return redirect('index');
        }
        $singlepr =Product::join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->where('products.product_code', '=',$code)
        ->first();
        $data = Cat::all();
        $subcats = Subcat::all();
        $allbrand = Brand::all();
        $allpt = Producttype::all();
        $allunit = Unit::all();
        $reletedcat = $singlepr->cat_id;
        $reltedpr = Product::join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->where('products.cat_id', '=',$reletedcat)
        ->get();


        $popular =Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->orderBy('total_rat', 'desc')->limit(4)->get();



        return view('singleproduct',compact('singlepr','data','subcats','allbrand','allpt','allunit','reltedpr','popular'));

    }

    public function addtocart(Request $request)
    {
        $sId = Auth::id();
        $data = Cart::where('session_id', '=',$sId)->where('product_code', '=',$request->input('product_code'))->get();
        $data = count($data);
        if ($data>0) {
            return back()->with('fail','Already Added');
        }else{


                           $subcatins = Cart::insert([
                               'session_id'=>$sId,
                               'product_code'=>$request->input('product_code'),
                               'cart_quantity'=>$request->input('product-quatity'),
                               'unit_name'=>$request->input('unit_name'),
                               'buy_price'=>$request->input('buy_price'),
                               'size'=>$request->input('size'),
                               'color'=>$request->input('color'),
                               'cart_sell_price'=>round($request->input('sell_price'))

                           ]);
                           if ($subcatins) {
                             return back()->with('success','Successfully New subCategory Created');
                           }
                           else{
                             return back()->with('fail','Something Went wrong Try Again!');
                           }
        }






    }

    public function addtocartpr(Request $request,$product_code)
    {
        $sId = Auth::id();
        $data = Cart::where('session_id', '=',$sId)->where('product_code', '=',$product_code)->get();
        $data = count($data);
        if ($data>0) {

            return back()->with('fail','Already Added');
        }else{

            

            $sp = Product::where('product_code', '=',$product_code)->join('units', 'products.unit_id', '=', 'units.id')->first();
            if ($sp->discount>0) {
                $discount =($sp->discount* $sp->sell_price)/100;
               $price = $sp->sell_price- $discount;
            }else{
                $price =  $sp->sell_price;
            }

                           $subcatins = Cart::insert([
                               'session_id'=>$sId,
                               'product_code'=>$sp['product_code'],
                               'cart_quantity'=>1,
                               'unit_name'=>$sp['unit_name'],
                               'buy_price'=>$sp['buy_price'],
                               'cart_sell_price'=>round( $price)

                           ]);
                           if ($subcatins) {
                             return back()->with('success','Added Successfully');
                           }
                           else{
                             return back()->with('fail','Something Went wrong Try Again!');
                           }
        }


    }
    public function addtocartadmin(Request $request,$product_code)
    {
        $sId = 0;
        $data = Cart::where('session_id', '=',$sId)->where('product_code', '=',$product_code)->get();
        $data = count($data);
        if ($data>0) {

            return back()->with('fail','Already Added');
        }else{

            $sp = Product::where('product_code', '=',$product_code)->join('units', 'products.unit_id', '=', 'units.id')->first();
            if ($sp->discount>0) {
                $discount =($sp->discount* $sp->sell_price)/100;
               $price = $sp->sell_price- $discount;
            }else{
                $price =  $sp->sell_price;
            }

                           $subcatins = Cart::insert([
                               'session_id'=>$sId,
                               'product_code'=>$sp['product_code'],
                               'cart_quantity'=>1,
                               'unit_name'=>$sp['unit_name'],
                               'buy_price'=>$sp['buy_price'],
                               'cart_sell_price'=>round( $price)

                           ]);
                           if ($subcatins) {
                             return back()->with('success','Successfully New subCategory Created');
                           }
                           else{
                             return back()->with('fail','Something Went wrong Try Again!');
                           }
        }


    }

    public function viewcart()
    {
        $sId = Auth::id();
       // dd($sId);
        $carts = Cart::where('session_id', '=',$sId)->join('products', 'products.product_code', '=', 'carts.product_code')->get();
        $profile = User::where('id', '=',$sId)->first();

        return view('cart',compact('carts','profile'));
    }

    public function updatecart(Request $request)
    {
        $sId = Auth::id();


        $subcatins = Cart::where('session_id', $sId)->where('product_code', '=',$request->input('product_code'))->update([

            'cart_quantity'=>$request->input('product-quatity')



        ]);

        if ($subcatins) {
          return back()->with('success','Successfully New subCategory Created');
        }
        else{
          return back()->with('fail','Something Went wrong Try Again!');
        }
    }
    public function updatecartadmin(Request $request)
    {
        $sId = 0;


        $subcatins = Cart::where('session_id', $sId)->where('id', '=',$request->input('id'))->update([

            'cart_quantity'=>$request->input('product-quatity')



        ]);

        if ($subcatins) {
          return back()->with('success','Successfully New subCategory Created');
        }
        else{
          return back()->with('fail','Something Went wrong Try Again!');
        }
    }
 public function removecart(Request $request)
 {
    $sId = Auth::id();
    $remove = Cart::where('session_id', '=',$sId)->where('product_code', '=',$request->input('product_code'))->delete();
    if ($remove) {
        return back()->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
 }
 public function removecartadmin(Request $request,$id)
 {
    $sId = 0;
    $remove = Cart::where('session_id', '=',$sId)->where('id', '=',$id)->delete();
    if ($remove) {
        return back()->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
 }

 public function addtoorder (Request $request)
 {
    $validate = $request->validate([
        'sleep_no' =>'required|unique:sleeps',
        'phone' =>'required',
        'house' =>'required',
        'address' =>'required',



     ]);




$id = Auth::id();

    $viewcart = Cart::where('session_id', '=',$id)->join('products', 'carts.product_code', '=', 'products.product_code')->get();
    $addtosleep = Sleep::insert([

        'customer_id'=>$id,
        'sleep_no'=>$request->input('sleep_no'),
        'total_amount'=>$request->input('sell_price'),
        'delivery_status'=>0



    ]);

    if ($addtosleep) {


   Billing::insert([

        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'phone'=>$request->input('phone'),
        'house'=>$request->input('house'),
        'sleep_no'=>$request->input('sleep_no'),
        'address'=>$request->input('address')



    ]);


    foreach ($viewcart as $value) {




        $senddata = Order::insert([

            'customer_id'=>$value['session_id'],

            'product_code'=>$value['product_code'],


            'color'=>$value['color'],
            'size'=>$value['size'],
            'order_quantity'=>$value['cart_quantity'],
            'buy_price'=>$value['buy_price'],
            'selling_price'=>$value['cart_sell_price'],

            'sleep_no'=>$request->input('sleep_no')


        ]);
         Product::where('product_code', $value['product_code'])->update([
            'quantity'=>$value['quantity']-$value['cart_quantity']

            ]);





    }
  if ($senddata) {

    $removedata = Cart::where('session_id', '=', $id)->delete();
      return redirect('order');
  }

}
}


public function orderview()
{
    $id = Auth::id();
    $orderlist =  Sleep::latest('created_at')->where('sleeps.customer_id', '=', $id)->get();
   // $allcat = Cat::all();
    return view('order',compact('orderlist'));
}


public function viewreviewproduct()
{
    $id = Auth::id();
    $orderproducts =  Order::join('products', 'products.product_code', '=', 'orders.product_code')->join('sleeps', 'orders.customer_id', '=', 'sleeps.customer_id')->where('sleeps.customer_id', '=', $id)->where('delivery_status', '=', '2')->get();
    $reviews =  Rataut::join('products', 'products.product_code', '=', 'ratauts.product_code')->where('ratauts.customer_id', '=', $id)->get();


    return view('review',compact('orderproducts','reviews'));
}
public function addreviewproductview(Request $request,$product_code)
{
    $productcode = $product_code;
$id = Auth::id();
    return view('addreview',compact('productcode',));
}

public function addreview(Request $request)
{

$product_code = $request->input('product_code');
$id = Auth::id();


     $ratcheck = Rataut::where('customer_id', '=', $id)->where('product_code', '=', $product_code)->get();
     $proval = Product::where('product_code', '=', $product_code)->first();

     $ratcount = $ratcheck->count();
     if ($ratcount==0) {







         Comment::insert([

            'customer_id'=>$id,
            'comment'=>$request->input('comment'),
            'product_code'=>$product_code

        ]);
        Rataut::insert([

            'customer_id'=>$id,
            'customer_rat'=>$request->input('star'),
            'product_code'=>$product_code

        ]);

         Product::where('product_code', $proval['product_code'])->update([
            'total_rat'=>$request->input('star')+ $proval['total_rat'],
            'total_hit'=>1+ $proval['total_hit']

            ]);

     }
     return redirect('review');

}

public function aboutus()
{
    return view('about');
}

}
