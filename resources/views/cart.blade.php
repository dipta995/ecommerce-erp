@extends('layouts.master')
@section('content')

	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>login</span></li>
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
<div class="row">
    <div class="col-md-8">
<div class="wrap-iten-in-cart">
					<h3 class="box-title">Products Name</h3>
					<ul class="products-cart">
                        @php
                        $product_price_totals=0;
                    @endphp
                        @foreach ($carts as $item)


						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{ url('/images') }}/{{ $item->image_one }}" alt=""></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{ url('/product/details') }}/{{  $item->product_code }}">{{ $item->name }}</a>
							</div>
                            <form method="POST" action="{{ url('/update_cart') }}" class="forms-sample">
                        @csrf
                        <input type="hidden" name="product_code" value="{{ $item->product_code }}">
							<div class="price-field produtc-price"><button type="submit"><i style="font-size: 30px;" class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </button></div>
							<div class="quantity">
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="{{ $item->cart_quantity }}" data-max="{{ $item->quantity }}" pattern="[0-9]*" >
									<a class="btn btn-increase" href="#"></a>
									<a class="btn btn-reduce" href="#"></a>
								</div>
							</div>
                        </form>
							<div class="price-field sub-total"><p class="price">{{ $price = $item->cart_sell_price*$item->cart_quantity }} Taka</p></div>

                            <form action="{{ url('/remove_cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_code" value="{{ $item->product_code }}">

                                <button type="submit"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                            </form>
						</li>
                        <?php  $product_price_totals += $price; ?>
                            @endforeach
					</ul>
				</div>
    </div>
    <div class="col-md-4">
        <div class="wrap-contacts ">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="contact-box contact-form">
                    <h2 class="box-title">Leave a Message</h2>

                    <form action="{{ url('/add_order') }}" method="POST">
                        <label for="name">Name<span>*</span></label>
                        <input type="text" readonly value="{{ $profile->name }}" id="name" name="name" >

                        <label for="email">Email<span>*</span></label>
                        <input type="text" readonly value="{{ $profile->email }}" id="email" name="email" >

                        <label for="phone">Number Phone</label>
                        <input type="text" value="" id="phone" name="phone" >
                        <label for="phone">House No</label>
                        <input type="text" textarea="house-12 10th floor 11-A " id="phone" name="house" >

                        <label for="comment">Your Home Address</label>
                        <textarea name="address" id="comment"></textarea>




                </div>
            </div>
        </div>
    </div>
</div>


				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">Order Summary</h4>
						<p class="summary-info"><span class="title">Subtotal</span><b class="index">{{ $product_price_totals}} Taka</b></p>
						<p class="summary-info"><span class="title">Shipping Charge</span><b class="index">{{ $shipping_charge = 0 }}</b></p>
                        <p class="summary-info"><span class="title">Vat 5%</span><b class="index">@php
                           echo $vatamount=(5)/100;

                        @endphp Taka</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">{{ $final_amount =round((( $product_price_totals*$vatamount)+$product_price_totals)+$shipping_charge) }} Taka</b></p>
					</div>
					<div class="checkout-info">
						{{-- <label class="checkbox-field">
							<input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
						</label> --}}
                        <?php
                            if($final_amount==0){

                            }else{
                        ?>

                            @csrf
							<input type="hidden" name="sell_price" value="{{ round($final_amount) }}">
                            <input type="hidden" name="sleep_no" value="@php
                                 echo $rand = rand(time(),6)
                            @endphp ">
                            <input class="btn btn-checkout" type="submit" value="Check Out AND Confirm Order">

						</form>
<?php } ?>
						{{-- <a class="btn btn-checkout" href="checkout.html">Check out</a> --}}
						<a class="link-to-shop" href="{{ url('/shop') }}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>

				</div>

				@include('layouts.popular')
			</div><!--end main content area-->
		</div><!--end container-->

	</main>

    @stop
