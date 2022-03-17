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

			<div class=" main-content-area">










                <div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
							<a href="#fashion_1a" class="tab-control-item active">Your Product</a>
							<a href="#fashion_1b" class="tab-control-item">Watch</a>

						</div>
						<div class="tab-contents">

							<div class="tab-content-item active" id="fashion_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >


@foreach ($orderproducts as $item)
@php
  $checkrat = DB::table('ratauts')->where('product_code', '=', $item->product_code)->where('customer_id', '=', $item->customer_id)->get();
  $count = $checkrat->count();

@endphp
<?php

if ($count==0) {


?>



									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{ url('add_review/'.$item->product_code)}}" title="{{ $item->name }}">
												<figure><img src="{{ url('images/'.$item->image_one )}}" width="800" height="800" alt="{{ $item->name }}"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item sale-label">Bought</span>
											</div>
											<div class="wrap-btn">
												<a href="{{ url('add_review/'.$item->product_code)}}" class="function-link">Review</a>
											</div>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{ $item->name }}</span></a>
											<div class="wrap-price"><ins><p class="product-price">@php
                                                if ($item->discount>0) {
                                                    $discount =($item->discount* $item->sell_price)/100;
                                                   echo $item->sell_price- $discount.' Taka';
                                                   echo "</p></ins><del><p class='product-price'>".$item->sell_price." Taka</p></del></div>";
                                                }else{
                                                    echo $item->sell_price.' Taka </div>';
                                                }
                                            @endphp
										</div>
									</div>
                                    <?php } ?>
@endforeach


								</div>
							</div>

							<div class="tab-content-item" id="fashion_1b">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>









@foreach ($reviews as $rev)

<div class="product product-style-2 equal-elem ">
    <div class="product-thumnail">
        <a href="#" title="{{  $rev->name }}">
            <figure><img src="{{ url('images/'.$rev->image_one ) }}" width="800" height="800" alt="{{  $rev->name }}"></figure>
        </a>

    </div>
    <div class="product-info">
        <a href="#" class="product-name"><span>{{  $rev->name }}</span></a>

    </div>
</div>
@endforeach





								</div>
							</div>



						</div>
					</div>
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
