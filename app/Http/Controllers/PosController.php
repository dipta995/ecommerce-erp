<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Agentpay;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Cat;
use App\Models\Guest;
use App\Models\Guestpay;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchaseproduct;
use App\Models\Sleep;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class PosController extends Controller
{

    public function posview(Request $request)
    {
        $cats = Cat::all();
        $search = $request->query('search');
        if ($search) {

        $products = Product::where('products.name','LIKE',"%{$search}%")->orWhere('products.product_code', 'LIKE',"%{$search}%")->where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')
        ->paginate(30);
        } else{
            $products = Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
            ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->paginate(30);
        }
        $catid=0;
        $cart  = Product::join('units', 'products.unit_id', '=', 'units.id')->join('carts', 'products.product_code', '=', 'carts.product_code')->where('carts.session_id', '=','0')
        ->get();
        if (Session::has('success_message')) {
            Alert::alert(session('your_title'),Session::has('success_message'), 'Type');

        }
        return view('user.pos',compact('products','cats','catid','cart'));
    }
    public function posviewbycat(Request $request,$catid)
    {
        $cats = Cat::all();
        $products = Product::where('junk', 0)->join('cats', 'products.cat_id', '=', 'cats.id')
        ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('producttypes', 'products.product_type_id', '=', 'producttypes.id')
        ->join('units', 'products.unit_id', '=', 'units.id')->where('products.cat_id', $catid)->paginate(30);
        $cart  = Product::join('units', 'products.unit_id', '=', 'units.id')->join('carts', 'products.product_code', '=', 'carts.product_code')->where('carts.session_id', '=','0')->get();
        return view('user.pos',compact('products','cats','catid','cart'));
    }




    public function addtoorderguest (Request $request)
    {
       $validate = $request->validate([
           'sleep_no' =>'required|unique:sleeps',
           'phone_no' =>'required',
           'paid_amount' =>'required',

        ]);


       $viewcart = Cart::where('session_id', '=','0')->join('products', 'carts.product_code', '=', 'products.product_code')->get();
       $addtosleep = Sleep::insert([

           'phone_no'=>$request->input('phone_no'),
           'sleep_no'=>$request->input('sleep_no'),
           'total_amount'=>$request->input('sell_price'),
           'delivery_status'=>2

       ]);
       if ($addtosleep) {
      Billing::insert([

           'name'=>$request->input('guest_name'),

           'phone'=>$request->input('phone_no'),

           'sleep_no'=>$request->input('sleep_no'),
           'address'=>$request->input('address')



       ]);

 $customarpay = $request->input('paid_amount');
        $neededprice = $request->input('sell_price');
        if ($customarpay>$neededprice) {
            $request->session()->put('your_title','Your Change :');

            $ps =$customarpay-$neededprice;
            $pp = $request->input('sell_price');
            $request->session()->put('ps',$ps);
            Guestpay::insert([

                'paid_amount'=>$pp,
                'phone'=>$request->input('phone_no')


            ]);
        }elseif($customarpay<$neededprice){

            $request->session()->put('your_title','Your Due :');
            $ps =$neededprice-$customarpay;
            $pp = $request->input('paid_amount');
            $request->session()->put('ps',$ps);
            Guestpay::insert([

                'paid_amount'=>$pp,
                'phone'=>$request->input('phone_no')


            ]);
        }elseif($customarpay==$neededprice){
            $request->session()->put('your_title','Your Due :');
            $ps =$neededprice-$customarpay;
            $request->session()->put('ps',$ps);
            $pp = $request->input('paid_amount');
            Guestpay::insert([

                'paid_amount'=>$pp,
                'phone'=>$request->input('phone_no')


            ]);
        }
       foreach ($viewcart as $value) {




           $senddata = Order::insert([

            'sleep_no'=>$request->input('sleep_no'),

               'product_code'=>$value['product_code'],


               'color'=>$value['color'],
               'size'=>$value['size'],
               'order_quantity'=>$value['cart_quantity'],
               'buy_price'=>$value['buy_price'],
               'selling_price'=>$value['cart_sell_price'],

               'sleep_no'=>$request->input('sleep_no')


           ]);



           $guenst = Guest::where('phone', '=', $request->input('phone_no'))->get();


           $gestcount = $guenst->count();
           if ($gestcount==0) {





        Guest::insert([

            'guest_name'=>$request->input('guest_name'),

            'phone'=>$request->input('phone_no')


        ]);
    }

            Product::where('product_code', $value['product_code'])->update([
               'quantity'=>$value['quantity']-$value['cart_quantity']

               ]);





       }
     if ($senddata) {

       $removedata = Cart::where('session_id', '=','0')->delete();

        // return redirect()->back();
        return redirect('guestdetails/'.$request->input('phone_no'));

        if ($removedata) {

            return back()->withSuccessMessage(session('ps'));

          }
          else{
            return back()->with('fail','Something went wrong Try Again!');
          }
     }

   }
   }


   public function guestall(Request $request)
   {
    $search = $request->query('search');
    if ($search) {
        $allguest =Guest::where('guests.phone','LIKE',"%{$search}%")->orWhere('guests.guest_name', 'LIKE',"%{$search}%")->get();
    }else{
    $allguest = Guest::all();
}
    return view('user.guestcustomer',compact('allguest'));

   }

public function showguestpayform(Request $request,$phone)
{
    $paylist =  Guestpay::where('phone', '=',$phone)->get();
    $sleeps =  Sleep::where('phone_no', '=',$phone)->get();
    $paid =0;
    $sleep =0;
foreach ($paylist as $value) {
    $paid += $value->paid_amount;
}
foreach ($sleeps as $value) {
    $sleep += $value->total_amount;
}
$due = $sleep-$paid;
if (Session::has('success_message')) {
    Alert::alert(session('your_title'),Session::has('success_message'), 'Type');

}
    return view('user.guestpayform',compact('due','phone'));
}
public function duepay(Request $request)
{
    $due = $request->input('due');
    if ($due>$request->input('paid')) {
        $request->session()->put('your_title','Your Due :');
        $ps = $due-$request->input('paid');
        Guestpay::insert([
            'paid_amount'=>$request->input('paid'),
            'due_pay'=>'1',
            'phone'=>$request->input('phone_no')
        ]);
    }elseif($due==$request->input('paid')){
        $request->session()->put('your_title','No Due :');
        $ps = 0;
        Guestpay::insert([
            'paid_amount'=>$request->input('paid'),
            'due_pay'=>'1',
            'phone'=>$request->input('phone_no')
        ]);
    }elseif($due<$request->input('paid')){
        $request->session()->put('your_title','Your Change :');
        $ps = $request->input('paid')-$due;
        Guestpay::insert([
            'paid_amount'=>$due,
            'due_pay'=>'1',
            'phone'=>$request->input('phone_no')
        ]);
    }

    return back()->withSuccessMessage($ps);
}

public function agentlist()
{
    $allagent = Agent::paginate(3);
    //$agentdue = Agent::join('purchaseproducts', 'purchaseproducts.agent_id', '=', 'agents.id')->join('agentpays', 'agentpays.agent_id', '=', 'agents.id')->peginate(3);
    return view('user.agent',compact('allagent'));
}
public function addagentlist(Request $request)
{
     $request->validate([
        'agent_phone' =>'required|unique:agents',
        'agent_name' =>'required',
        'agent_company' =>'required',

     ]);



    $addagent = Agent::insert([

        'agent_name'=>$request->input('agent_name'),
        'agent_phone'=>$request->input('agent_phone'),
        'agent_email'=>$request->input('agent_email'),
        'agent_company'=>$request->input('agent_company'),
        'address'=>$request->input('address')


    ]);
    if ($addagent) {
        return back()->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
}

public function viewpurchase()
{
    $allagent = Agent::all();
    $allunit = Unit::all();
    $products = Agent::where('sift_status', '=',0)->join('purchaseproducts', 'purchaseproducts.agent_id', '=', 'agents.id')->join('units', 'purchaseproducts.pr_unit', '=', 'units.id')->paginate(3);
    return view('user.agentproduct',compact('products','allunit','allagent'));
}

public function addpurchase(Request $request)
{
    $request->validate([
        'agent_id' =>'required',
        'pr_price' =>'required',
        'pr_name' =>'required',
        'pr_unit' =>'required',
        'pr_quantity' =>'required',
     ]);



    $addagent = Purchaseproduct::insert([

        'agent_id'=>$request->input('agent_id'),
        'pr_code'=>$request->input('pr_code'),
        'pr_name'=>$request->input('pr_name'),
        'pr_price'=>$request->input('pr_price'),
        'pr_extracost'=>$request->input('pr_extracost'),
        'pr_unit'=>$request->input('pr_unit'),
        'pr_quantity'=>$request->input('pr_quantity')


    ]);
    if ($addagent) {
        return back()->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
}

public function addpurchasetostock(Request $request)
{
    $request->validate([
        'product_code' =>'required',

     ]);

    $prcode  =$request->input('pr_code');
    $productcode  =$request->input('product_code');
    $purchaseproduct = Purchaseproduct::where('pr_code',$prcode)->first();
    $product = Product::where('product_code',$productcode)->first();
    if ($purchaseproduct['sift_status']==1) {
        return back()->with('fail','Already added');
    }else{
    $addagent = Product::where('product_code',$productcode)->update([
        'quantity'=>$product['quantity']+$purchaseproduct['pr_quantity']

        ]);
        Purchaseproduct::where('pr_code',$prcode)->update([
            'sift_status'=>1

            ]);

    if ($addagent) {
        return Redirect('purchase/product')->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
    }
}

public function viewasidstock($id)
{
    $purchaseproduct = Purchaseproduct::join('units', 'purchaseproducts.pr_unit', '=', 'units.id')->where('purchaseproducts.pr_code',$id)->first();
    $products = Product::where('junk',0)->get();
    return view('user.addtostock',compact('purchaseproduct','products'));
}

public function alreadyadded($agentid=NULL)
{
    $agents = Agent::all();

    if ($agentid) {
        $products =  Purchaseproduct::where('sift_status', '=',1)->where('agent_id', '=',$agentid)->join('agents', 'purchaseproducts.agent_id', '=', 'agents.id')->join('units', 'purchaseproducts.pr_unit', '=', 'units.id')->paginate(3);

    }else{

        $products =  Purchaseproduct::where('sift_status', '=',1)->join('agents', 'purchaseproducts.agent_id', '=', 'agents.id')->join('units', 'purchaseproducts.pr_unit', '=', 'units.id')->paginate(3);
    }





    return view('user.alreadystocked',compact('products','agents'));
}

public function totaldueatagent($id)
{
    $agents = Agent::all();
    $due = Purchaseproduct::join('agents', 'purchaseproducts.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
    $due1 = Agent::join('agentpays', 'agentpays.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
    $total= 0;
    $paid = 0;
    foreach ($due as  $value) {
       $price = $value->pr_price*$value->pr_quantity;

       $total += $price;
    }
    foreach ($due1 as $key => $value) {
        $paid += $value->paid_amouont;
    }
    $getdue =  $total-$paid;

    //echo "<td>".$getdue."</td>";
    return view('user.agentdue',compact('getdue','agents','id'));


}
public function addtotaldueatagent(Request $request)
{
$id =$request->input('agent_id');
 $due = Purchaseproduct::join('agents', 'purchaseproducts.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
    $due1 = Agent::join('agentpays', 'agentpays.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
    $total= 0;
    $paid = 0;
    foreach ($due as  $value) {
       $price = $value->pr_price*$value->pr_quantity;

       $total += $price;
    }
    foreach ($due1 as $key => $value) {
        $paid += $value->paid_amouont;
    }
    $getdue =  $total-$paid;
if ($getdue==0 || $getdue<0) {
    return back()->with('fail','No due');
}else{
    $addagent = Agentpay::insert([

        'agent_id'=>$id,
        'paid_amouont'=>$request->input('paid_amouont')


    ]);
    if ($addagent) {
        return Redirect('purchase/agent')->with('success','Successfully New subCategory Created');
      }
      else{
        return back()->with('fail','Something Went wrong Try Again!');
      }
}
}
}
