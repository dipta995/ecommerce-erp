<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

   <div class="page-content container">
       <div class="page-header text-blue-d2">
           <h1 class="page-title text-secondary-d1">
               Invoice
               <small class="page-info">
                   <i class="fa fa-angle-double-right text-80"></i>
                   ID: # {{ $customer->sleep_no }}
               </small>
           </h1>

           <div class="page-tools">
               <div class="action-buttons">
                   <a class="btn bg-white btn-light mx-1px text-95" href="#" onclick="window.print()" data-title="Print">
                       <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                       Print
                   </a>
                   {{--  <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                       <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                       Export
                   </a>  --}}
               </div>
           </div>
       </div>

       <div class="container px-0">
           <div class="row mt-4">
               <div class="col-12 col-lg-10 offset-lg-1">
                   {{--  <div class="row">
                       <div class="col-12">
                           <div class="text-center text-150">
                               <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                               <span class="text-default-d3">Bootdey.com</span>
                           </div>
                       </div>
                   </div>  --}}
                   <!-- .row -->

                   <hr class="row brc-default-l1 mx-n1 mb-4" />

                   <div class="row">
                       <div class="col-sm-6">
                           <div>
                               <span class="text-sm text-grey-m2 align-middle">To:</span>
                               <span class="text-600 text-110 text-blue align-middle">{{ $customer->name }}</span>
                           </div>
                           <div class="text-grey-m2">
                               <div class="my-1">
                                   {{ $customer->house }}
                               </div>
                               <div class="my-1">
                                   {{ $customer->address }}
                               </div>
                               <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $customer->phone }}</b></div>
                           </div>
                       </div>
                       <!-- /.col -->

                       <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                           <hr class="d-sm-none" />
                           <div class="text-grey-m2">
                               <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                   Invoice
                               </div>

                               <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{ $customer->sleep_no }}</div>

                               <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ $customer->updated_at }}</div>

                               <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Due:</span> <span class="badge badge-warning badge-pill px-25">@php
    $paylist =  DB::table('guestpays')->where('phone', '=',$customer->phone)->get();
    $sleeps =   DB::table('sleeps')->where('phone_no', '=',$customer->phone)->get();
    $paid =0;
    $sleep =0;
foreach ($paylist as $value) {
    $paid += $value->paid_amount;
}
foreach ($sleeps as $value) {
    $sleep += $value->total_amount;
}
echo $due = $sleep-$paid;
                               @endphp</span></div>
                           </div>
                       </div>
                       <!-- /.col -->
                   </div>

                   <div class="mt-4">
                       <div class="row text-600 text-white bgc-default-tp1 py-25">
                           <div class="d-none d-sm-block col-1">#</div>
                           <div class="col-9 col-sm-5">Description</div>
                           <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                           <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                           <div class="col-2">Amount</div>
                       </div>

                       <div class="text-95 text-secondary-d3 ">
@php
$total_amount=0;

@endphp
@foreach ($invoice as $i => $item)



                           <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                               <div class="d-none d-sm-block col-1">{{ $i+1 }}</div>
                               <div class="col-9 col-sm-5">{{ $item->name }} <br><span style="font-size: 12px;color:#807d7d">product code :{{ $item->product_code }} </span></div>
                               <div class="d-none d-sm-block col-2">{{ $item->order_quantity }} </div>
                               <div class="d-none d-sm-block col-2 text-95">{{ $item->selling_price }} Taka</div>
                               <div class="col-2 text-secondary-d2">{{ $total = $item->order_quantity*$item->selling_price }} Taka</div>
                           </div>

                           @php
                                   $total_amount +=$total;
                           @endphp

@endforeach

                       </div>

                       <div class="row border-b-2 brc-default-l2"></div>

                       <!-- or use a table instead -->
                       <!--
               <div class="table-responsive">
                   <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                       <thead class="bg-none bgc-default-tp1">
                           <tr class="text-white">
                               <th class="opacity-2">#</th>
                               <th>Description</th>
                               <th>Qty</th>
                               <th>Unit Price</th>
                               <th width="140">Amount</th>
                           </tr>
                       </thead>

                       <tbody class="text-95 text-secondary-d3">
                           <tr></tr>
                           <tr>
                               <td>1</td>
                               <td>Domain registration</td>
                               <td>2</td>
                               <td class="text-95">$10</td>
                               <td class="text-secondary-d2">$20</td>
                           </tr>
                       </tbody>
                   </table>
               </div>
               -->

                       <div class="row mt-3">
                           <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                               Extra note such as company or payment information...
                           </div>

                           <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                               <div class="row my-2">
                                   <div class="col-7 text-right">
                                       SubTotal
                                   </div>
                                   <div class="col-5">
                                       <span class="text-120 text-secondary-d1">{{ $total_amount }}Taka</span>
                                   </div>
                               </div>

                               <div class="row my-2">
                                   <div class="col-7 text-right">
                                       Tax (5%)
                                   </div>
                                   <div class="col-5">
                                       <span class="text-110 text-secondary-d1">{{ $subtotal=(($total_amount*0.05)) }}Taka</span>
                                   </div>
                               </div>
                               <div class="row my-2">
                                   <div class="col-7 text-right">
                                      Shipping Charge
                                   </div>
                                   <div class="col-5">
                                       <span class="text-110 text-secondary-d1">{{ 0 }}Taka</span>
                                   </div>
                               </div>
                               <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                   <div class="col-7 text-right">
                                       Total Amount
                                   </div>
                                   <div class="col-5">
                                       <span class="text-150 text-success-d3 opacity-2">{{(($total_amount*0.05)+$total_amount)+0 }}Taka</span>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <hr />
<?php if ( $due==0) {

}else{ ?>
                       <div>
                           <span class="text-secondary-d1 text-105">Thank you for your business</span>
                           <a href="{{ url('/guestpay/'.$customer->phone) }}" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                       </div>
                       <?php } ?>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <style>body{
       margin-top:20px;
       color: #484b51;
   }
   .text-secondary-d1 {
       color: #728299!important;
   }
   .page-header {
       margin: 0 0 1rem;
       padding-bottom: 1rem;
       padding-top: .5rem;
       border-bottom: 1px dotted #e2e2e2;
       display: -ms-flexbox;
       display: flex;
       -ms-flex-pack: justify;
       justify-content: space-between;
       -ms-flex-align: center;
       align-items: center;
   }
   .page-title {
       padding: 0;
       margin: 0;
       font-size: 1.75rem;
       font-weight: 300;
   }
   .brc-default-l1 {
       border-color: #dce9f0!important;
   }

   .ml-n1, .mx-n1 {
       margin-left: -.25rem!important;
   }
   .mr-n1, .mx-n1 {
       margin-right: -.25rem!important;
   }
   .mb-4, .my-4 {
       margin-bottom: 1.5rem!important;
   }

   hr {
       margin-top: 1rem;
       margin-bottom: 1rem;
       border: 0;
       border-top: 1px solid rgba(0,0,0,.1);
   }

   .text-grey-m2 {
       color: #888a8d!important;
   }

   .text-success-m2 {
       color: #86bd68!important;
   }

   .font-bolder, .text-600 {
       font-weight: 600!important;
   }

   .text-110 {
       font-size: 110%!important;
   }
   .text-blue {
       color: #478fcc!important;
   }
   .pb-25, .py-25 {
       padding-bottom: .75rem!important;
   }

   .pt-25, .py-25 {
       padding-top: .75rem!important;
   }
   .bgc-default-tp1 {
       background-color: rgba(121,169,197,.92)!important;
   }
   .bgc-default-l4, .bgc-h-default-l4:hover {
       background-color: #f3f8fa!important;
   }
   .page-header .page-tools {
       -ms-flex-item-align: end;
       align-self: flex-end;
   }

   .btn-light {
       color: #757984;
       background-color: #f5f6f9;
       border-color: #dddfe4;
   }
   .w-2 {
       width: 1rem;
   }

   .text-120 {
       font-size: 120%!important;
   }
   .text-primary-m1 {
       color: #4087d4!important;
   }

   .text-danger-m1 {
       color: #dd4949!important;
   }
   .text-blue-m2 {
       color: #68a3d5!important;
   }
   .text-150 {
       font-size: 150%!important;
   }
   .text-60 {
       font-size: 60%!important;
   }
   .text-grey-m1 {
       color: #7b7d81!important;
   }
   .align-bottom {
       vertical-align: bottom!important;
   }



   </style>
</body>
</html>
