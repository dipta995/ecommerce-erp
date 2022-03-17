<?php

namespace App\Http\Controllers;

use App\Models\Dailycost;
use App\Models\Guestpay;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sleep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;

class AdminController extends Controller
{

    // public function adminhome()
    // {
    //     $id = Auth::id();
    //     $prtest = User::where('id', '=',$id)->first();
    //     //$prtest->count();
    //     $role = $prtest->role;
    //     if ($role == 0) {
    //         return redirect('/');
    //     }elseif ($role==1) {

    //         return view('user.home');
    //     }else{
    //         dd('error');
    //     }
    // }


    public function totalsell()
    {
        $id = Auth::id();
        $prtest = User::where('id', '=',$id)->first();
        //$prtest->count();
        $role = $prtest->role;
        if ($role == 'user') {
            return redirect('/');
        }
    //     $orders = Order::join('sleeps', 'orders.sleep_no', '=', 'sleeps.sleep_no')->where('pay_status', '=','1')->where('delivery_status', '=','2')->get();
    //     $totalbuy=0;
    //     $totalsell=0;
    //     $quantity=0;
    //     foreach ($orders as $key => $value) {

    //         $buyprice = $value['buy_price']*$value['order_quantity'];
    //         $sellprice = $value['selling_price']*$value['order_quantity'];
    //         $quantity += $value['order_quantity'];

    //         $totalbuy += $buyprice;
    //         $totalsell += $sellprice;
    //     }
    //    $totalbuyingprice = $totalbuy;
    //    $totalsellingprice = $totalsell;


    //    $sleeps = Sleep::all();
    //    $ts=0;
    //    foreach ($sleeps as $key => $val) {
    //     $ts += $val['total_amount'];

    //    }
    //    $sleeps = Sleep::where('pay_status', '=','1')->get();
    //    $cl=0;
    //    foreach ($sleeps as $key => $vl) {
    //     $cl += $vl['total_amount'];

    //    }
    //    $due= $ts-$cl;


    //    $product = Product::where('junk', '=','0')->get();
    //    $totalsp=0;
    //    foreach ($product as $key => $pr) {

    //     $totalsp += $pr['sell_price']*$pr['quantity'];

    //    }
    //   $stockproductprice =$totalsp;

//step one for total
$totalamount=0;
$totalinvestamount=0;
$dailycosts=0;
$sleepdues=0;
$sleepduespos=0;
$guestpaid=0;
    $totalsell = Sleep::all();
    $sleepdue = Sleep::where('phone_no', '=',NULL)->where('pay_status', '=',0)->get();
    $sleepduepos = Sleep::where('customer_id', '=',NULL)->where('pay_status', '=',0)->get();
    $guestpay = Guestpay::all();
    $totalinvest = Order::all();
    $dailycost = Dailycost::all();

    foreach ($totalsell as $value) {
        $totalamount += $value->total_amount;
    }
    foreach ($totalinvest as $value) {
       $invest= $value->order_quantity*$value->buy_price;
        $totalinvestamount += $invest;
    }
    foreach ($dailycost as $value) {
        $dailycosts += $value->cost;
    }
    foreach ($sleepdue as $value) {
        $sleepdues += $value->total_amount;
    }
    foreach ($sleepduepos as $value) {
        $sleepduespos += $value->total_amount;
    }
    foreach ($guestpay as $value) {
        $guestpaid += $value->paid_amount;
    }
    //total sell  by sleep
    $totalsells =$totalamount;
    //total invest by order
    $investamount = $totalinvestamount;
    //total daily cost
    $dailytotalcost = $dailycosts;
    //$earn total
    $totalearn = $totalsells-$investamount-$dailytotalcost;
    //Total Due
    $posdue = $sleepduespos-$guestpaid;
    $totaldue =$sleepdues+$posdue;

    //Step two for last month
    $date = date('Y-m');

    $search = date("Y-m", strtotime ( '-1 month' , strtotime ( $date ) )) ;





    $totalamountlast=0;
    $totalinvestamountlast=0;
    $dailycostslast=0;
    $sleepdueslast=0;
    $sleepduesposlast=0;
    $guestpaidlast=0;
        $totalselllast = Sleep::where('created_at','LIKE',"%{$search}%")->get();
        $sleepduelast = Sleep::where('phone_no', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$search}%")->get();


        $sleepdueposlast = Sleep::where('customer_id', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$search}%")->get();
        $guestpaylast = Guestpay::where('created_at','LIKE',"%{$search}%")->get();
        $totalinvestlast = Order::where('order_at','LIKE',"%{$search}%")->get();
        $dailycostlast = Dailycost::where('created_at','LIKE',"%{$search}%")->get();

        foreach ($totalselllast as $value) {
            $totalamountlast += $value->total_amount;
        }
        foreach ($totalinvestlast as $value) {
           $investlast= $value->order_quantity*$value->buy_price;
            $totalinvestamountlast += $investlast;
        }
        foreach ($dailycostlast as $value) {
            $dailycostslast += $value->cost;
        }
        foreach ($sleepduelast as $value) {
            $sleepdueslast += $value->total_amount;
        }
        foreach ($sleepdueposlast as $value) {
            $sleepduesposlast += $value->total_amount;
        }
        foreach ($guestpaylast as $value) {
            $guestpaidlast += $value->paid_amount;
        }
        //total sell  by sleep
        $totalsellslast =$totalamountlast;
        //total invest by order
        $investamountlast = $totalinvestamountlast;
        //total daily cost
        $dailytotalcostlast = $dailycostslast;
        //$earn total
        $totalearnlast = $totalsellslast-$investamountlast-$dailytotalcostlast;
        //Total Due
        $posduelast = $sleepduesposlast-$guestpaidlast;
        $totalduelast =$sleepdueslast+$posduelast;
         //Step Three for Yesterday

    $yesterday = new DateTime('yesterday');
    $yesterdays= $yesterday->format('Y-m-d');


    $totalamountlastday=0;
    $totalinvestamountlastday=0;
    $dailycostslastday=0;
    $sleepdueslastday=0;
    $sleepduesposlastday=0;
    $guestpaidlastday=0;
        $totalselllastday = Sleep::where('created_at','LIKE',"%{$yesterdays}%")->get();
        $sleepduelastday = Sleep::where('phone_no', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$yesterdays}%")->get();


        $sleepdueposlastday = Sleep::where('customer_id', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$yesterdays}%")->get();
        $guestpaylastday = Guestpay::where('created_at','LIKE',"%{$yesterdays}%")->get();
        $totalinvestlastday = Order::where('order_at','LIKE',"%{$yesterdays}%")->get();
        $dailycostlastday = Dailycost::where('created_at','LIKE',"%{$yesterdays}%")->get();

        foreach ($totalselllastday as $value) {
            $totalamountlastday += $value->total_amount;
        }
        foreach ($totalinvestlastday as $value) {
           $investlastday= $value->order_quantity*$value->buy_price;
            $totalinvestamountlastday += $investlastday;
        }
        foreach ($dailycostlastday as $value) {
            $dailycostslastday += $value->cost;
        }
        foreach ($sleepduelastday as $value) {
            $sleepdueslastday += $value->total_amount;
        }
        foreach ($sleepdueposlastday as $value) {
            $sleepduesposlastday += $value->total_amount;
        }
        foreach ($guestpaylastday as $value) {
            $guestpaidlastday += $value->paid_amount;
        }
        //total sell  by sleep
        $totalsellslastday =$totalamountlastday;
        //total invest by order
        $investamountlastday = $totalinvestamountlastday;
        //total daily cost
        $dailytotalcostlastday = $dailycostslastday;
        //$earn total
        $totalearnlastday = $totalsellslastday-$investamountlastday-$dailytotalcostlastday;
        //Total Due
        $posduelastday = $sleepduesposlastday-$guestpaidlastday;
        $totalduelastday =$sleepdueslastday+$posduelastday;

        //Step FOUR for Today

        $today = date('Y-m-d');
       



        $totalamounttoday=0;
        $totalinvestamounttoday=0;
        $dailycoststoday=0;
        $sleepduestoday=0;
        $sleepduespostoday=0;
        $guestpaidtoday=0;
            $totalselltoday = Sleep::where('created_at','LIKE',"%{$today}%")->get();
            $sleepduetoday = Sleep::where('phone_no', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$today}%")->get();


            $sleepduepostoday = Sleep::where('customer_id', '=',NULL)->where('pay_status', '=',0)->where('created_at','LIKE',"%{$today}%")->get();
            $guestpaytoday = Guestpay::where('created_at','LIKE',"%{$today}%")->get();
            $totalinvesttoday = Order::where('order_at','LIKE',"%{$today}%")->get();
            $dailycosttoday = Dailycost::where('created_at','LIKE',"%{$today}%")->get();

            foreach ($totalselltoday as $value) {
                $totalamounttoday += $value->total_amount;
            }
            foreach ($totalinvesttoday as $value) {
               $investtoday= $value->order_quantity*$value->buy_price;
                $totalinvestamounttoday += $investtoday;
            }
            foreach ($dailycosttoday as $value) {
                $dailycoststoday += $value->cost;
            }
            foreach ($sleepduetoday as $value) {
                $sleepduestoday += $value->total_amount;
            }
            foreach ($sleepduepostoday as $value) {
                $sleepduespostoday += $value->total_amount;
            }
            foreach ($guestpaytoday as $value) {
                $guestpaidtoday += $value->paid_amount;
            }
            //total sell  by sleep
            $totalsellstoday =$totalamounttoday;
            //total invest by order
            $investamounttoday = $totalinvestamounttoday;
            //total daily cost
            $dailytotalcosttoday = $dailycoststoday;
            //$earn total
            $totalearntoday = $totalsellstoday-$investamounttoday-$dailytotalcosttoday;
            //Total Due
            $posduetoday = $sleepduespostoday-$guestpaidtoday;
            $totalduetoday =$sleepduestoday+$posduetoday;





       return view('user.home',compact('totalsells','investamount','dailytotalcost','totalearn','totaldue','totalsellslast','investamountlast','dailytotalcostlast','totalearnlast','totalduelast','totalsellslastday','investamountlastday','dailytotalcostlastday','totalearnlastday','totalduelastday','totalsellstoday','investamounttoday','dailytotalcosttoday','totalearntoday','totalduetoday'));


    }

    public function showcustomer()
    {
        $allcustomer = User::where('role','user')->paginate(20);
        return view('user.allcustomer',compact('allcustomer'));
    }


}
