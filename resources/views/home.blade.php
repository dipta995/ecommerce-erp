@extends('layouts.master')
@section('content')

	<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">

                    @foreach ($slides as $sl)


					<div class="item-slide">
						<img style="height: 500px;width:100%;" src="{{ url('images') }}/{{ $sl->image }}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							@php
                                echo $sl->details
                            @endphp
							<a href="{{ url('/shop/subcat/'.$sl->subcat_name) }}" class="btn-link">Shop Now</a>
						</div>
					</div>

                    @endforeach


				</div>
			</div>



			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>

				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                    @foreach ($allproduct as $pr)
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{ url('/product/details/') }}/{{ $pr->product_code }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{ url('images') }}/{{ $pr->image_one }}" width="800" style="height: 250px;" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="{{ url('/product/details/') }}/{{ $pr->product_code }}" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{ $pr->name }}</span></a>
                                            <div class="wrap-price"><ins><p class="product-price">@php
                                                if ($pr->discount>0) {
                                                    $discount =($pr->discount* $pr->sell_price)/100;
                                                   echo $pr->sell_price- $discount.' Taka';
                                                   echo "</p></ins><del><p class='product-price'>".$pr->sell_price." Taka</p></del></div>";
                                                }else{
                                                    echo $pr->sell_price.' Taka </div>';
                                                }
                                            @endphp

										</div>
									</div>


                                    @endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			 
			</div>

		</div>

	</main>



@stop
