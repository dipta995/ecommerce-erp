<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sleep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function orderproductview(Request $request)
    {
        $url = '/customer/order';

        $search = $request->query('search');
        if ($search) {
            $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','0')->where('sleeps.sleep_no','LIKE',"%{$search}%")->orWhere('users.email', 'LIKE',"%{$search}%")->get();
        }else{
        $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','0')->get();
        }
        return view('user.order',compact('sleeps','url'));
    }


    public function orderproductview_one(Request $request)
    {
        $url = '/customer/order/ontheway';
        $search = $request->query('search');
        if ($search) {
            $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','1')->where('sleeps.sleep_no','LIKE',"%{$search}%")->orWhere('users.email', 'LIKE',"%{$search}%")->get();
        }else{
        $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','1')->get();
        }
        return view('user.order',compact('sleeps','url'));
    }


    public function orderproductview_two(Request $request)
    {
        $url = '/customer/order/delivered';
        $search = $request->query('search');
        if ($search) {
            $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','2')->where('sleeps.sleep_no','LIKE',"%{$search}%")->orWhere('users.email', 'LIKE',"%{$search}%")->get();
        }else{
        $sleeps =Sleep::join('users', 'users.id', '=', 'sleeps.customer_id')->orderBy('sleeps.created_at', 'desc')->where('delivery_status', '=','2')->get();
        }
        return view('user.order',compact('sleeps','url'));
    }








    public function payconfirmation(Request $request,$sleep_no)
    {

        $catup = Sleep::where('sleep_no', $sleep_no)->update([
            'pay_status' =>'1'

            ]);
            if ($catup) {
                return back()->with('success','Successfull');
              }
              else{
                return back()->with('fail','Something went wrong Try Again!');
              }

    }

    public function cencelproductorder(Request $request,$product_code,$sleep_no)
    {

        $viewcart = Order::where('sleep_no', '=',$sleep_no)->where('product_code', '=',$product_code)->first();
        $product = Product::where('product_code', '=',$product_code)->first();
        $up =Product::where('product_code', $viewcart['product_code'])->update([
            'quantity'=>$product['quantity']+$viewcart['order_quantity']

            ]);
            if ($up) {

                $del =Order::where('sleep_no', '=',$sleep_no)->where('product_code', '=',$product_code)->delete();
                if ($del) {
                    $orderdata = Order::where('sleep_no', '=',$sleep_no)->get();
                    $product_price_totals=0;
                    foreach ($orderdata as $or) {
                       $price = ($or['order_quantity']*$or['selling_price']);
                       $product_price_totals += $price;
                    }
                    $aftervat = ($product_price_totals*0.05);
                    $newamount=($product_price_totals+$aftervat);
                    Sleep::where('sleep_no', $sleep_no)->update([
                        'total_amount'=>$newamount

                        ]);
                        return redirect()->back();

                }
            }

    }


    public function makeontheway(Request $request,$sleep_no)
    {
        $up =Sleep::where('sleep_no', $sleep_no)->update([
            'delivery_status'=>1
            ]);
            return redirect()->back();
    }

    public function Delivered(Request $request,$sleep_no)
    {
        $up =Sleep::where('sleep_no', $sleep_no)->update([
            'delivery_status'=>2
            ]);
            return redirect()->back();
    }

    public function showinvoice(Request $request,$sleep)
    {
        $invoice =Product::join('orders', 'products.product_code', '=', 'orders.product_code')->where('orders.sleep_no', '=',$sleep)->get();
        $customer =Sleep::join('billings', 'billings.sleep_no', '=', 'sleeps.sleep_no')->where('sleeps.sleep_no', '=',$sleep)->first();

        return view('user.invoice',compact('invoice','customer'));
    }
    public function showguestinvoice(Request $request,$phone)
    {
        $invoice =Product::join('orders', 'products.product_code', '=', 'orders.product_code')->join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('sleeps.phone_no', '=',$phone)->get();
        $customer =Sleep::join('billings', 'billings.sleep_no', '=', 'sleeps.sleep_no')->where('sleeps.phone_no', '=',$phone)->first();

        return view('user.guestdetails',compact('invoice','customer'));
    }




}
