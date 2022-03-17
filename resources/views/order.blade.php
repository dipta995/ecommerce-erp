@extends('layouts.master')
@section('content')

	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Order</span></li>
				</ul>
			</div>
            @if (Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>

                   {{ Session::get('success') }}
            </div>
            @endif


            @if (Session::get('fail'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
             {{ Session::get('fail') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

			<div class=" main-content-area">

				<div class="wrap-iten-in-cart">
					<h3 class="box-title">Products Name</h3>
					<ul class="products-cart">


						<li class="pr-cart-item">
							 @foreach ($orderlist as $i => $item)
                             <p>{{ $item->total_amount }} ({{ $item->created_at }}) >>>@php
                                if($item->pay_status==0){
                                    echo "<span style='color:red;font-size:16px;font-weight: 600'>Pending</span>";
                                }
                                else{
                                    echo "<span style='color:#039127;font-size:16px;font-weight: 600'>Paid</span>";
                                }
                            @endphp</p> <a style="float: right;" class='btn btn-success' target="__blank" href='{{ url('invoice') }}/{{$item->sleep_no}}'>Invoice </a>
                             <div class="row">
                                 <div class="col-md-2"></div>
                                 <div class="col-md-10">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                              <th>NO</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Price</th>
                                            <th>quantity</th>
                                            <th>Orderd at</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                                     <?php
                                          $id = $item->sleep_no;
                   $datas = DB::table('orders')->join('products', 'products.product_code', '=', 'orders.product_code')->where('sleep_no', '=', $id)->get();
                   foreach ($datas as $values) {
                       //echo "<p><a href='".url("order/{$id}")."'>".$item->id."</a></p>";
?>

                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td><img style="height: 60px;width:60px;" src="{{ url('images/'.$values->image_one )}}" alt=""></td>
                                        <td>{{ $values->name }}</td>
                                        <td>{{ $values->product_code }}</td>
                                        <td>{{ $values->selling_price }}</td>
                                        <td>{{ $values->order_quantity }}</td>
                                        <td>{{ $values->order_at }}</td>


                                    </tr>

                   <?php } ?>
                                        </tbody>
                                    </table>
                                 </div>
                             </div>

                             @endforeach


						</li>

					</ul>
				</div>

				<div class="summary">

					<div class="checkout-info">
						{{-- <label class="checkbox-field">
							<input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
						</label> --}}


						{{-- <a class="btn btn-checkout" href="checkout.html">Check out</a> --}}
						<a class="link-to-shop" href="{{ url('/shop') }}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>

				</div>

				@include('layouts.popular')

			</div><!--end main content area-->
		</div><!--end container-->

	</main>

    @stop
