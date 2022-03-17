@extends('layouts.master')
@section('content')

	<!--main area-->
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>detail</span></li>
				</ul>
			</div>
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							{{-- <div class="product-gallery">
							  <ul class="slides">

							    <li data-thumb="{{ url('/images') }}/{{ $singlepr->image_one }}">
							    	<img src="{{ url('/images') }}/{{ $singlepr->image_one }}" alt="product thumbnail" />
							    </li>

							    <li data-thumb="{{ url('/images') }}/{{ $singlepr->image_two }}">
							    	<img src="{{ url('/images') }}/{{ $singlepr->image_two }}" alt="product thumbnail" />
							    </li>

							    <li data-thumb="{{ url('/images') }}/{{ $singlepr->image_three }}">
							    	<img src="{{ url('/images') }}/{{ $singlepr->image_three }}" alt="product thumbnail" />
							    </li>


							  </ul>
							</div> --}}
                            <div class="column">
                                <img id=featured src="{{ url('/images') }}/{{ $singlepr->image_one }}">

                                <div id="slide-wrapper" >
                                    <img id="slideLeft" class="arrow" src="https://cdn2.iconfinder.com/data/icons/arrows-part-1/32/tiny-arrow-left-1-512.png">

                                    <div id="slider">
                                        <img class="thumbnail active" src="{{ url('/images') }}/{{ $singlepr->image_one }}">
                                        @php
                                            $productimage = DB::table('productimages')->where('product_code','=',$singlepr->product_code)->get();
                                        @endphp
                                        @foreach ($productimage as $primg)

                                        <img class="thumbnail" src="{{ url('/images') }}/{{ $primg->image }}">
                                        @endforeach



                                    </div>

                                    <img id="slideRight" class="arrow" src="https://cdn.iconscout.com/icon/free/png-256/right-arrow-1438234-1216195.png">
                                </div>
                            </div>


						</div>
						<div class="detail-info">
							<div class="product-rating">
                                @php
                                if (!empty($singlepr->total_rat)) {


                                $star = round($singlepr->total_rat/$singlepr->total_hit);
                                    for ($i=0; $i < $star; $i++) {
                                        echo ' <i style="color: red" class="fa fa-star" aria-hidden="true"></i>';

                                    }
                                    for ($j=1; $j <= (5-$star); $j++) {
                                            echo ' <i style="color: #7e7e7a" class="fa fa-star" aria-hidden="true"></i>';
                                        }
                                        echo '<a href="#" class="count-review">'. $singlepr->total_hit. 'review</a>';
                                    }else{
                                    }
                                @endphp

                            </div>
                            <h2 class="product-name">{{ $singlepr->name }}</h2>
                            {{-- <div class="short-desc">
                                <ul>
                                    <li>7,9-inch LED-backlit, 130Gb</li>
                                    <li>Dual-core A7 with quad-core graphics</li>
                                    <li>FaceTime HD Camera 7.0 MP Photos</li>
                                </ul>
                            </div> --}}

                            <div class="wrap-price"><span class="product-price">@php
                                if ($singlepr->discount>0) {
                                    $discount =($singlepr->discount* $singlepr->sell_price)/100;
                                   echo $singlepr->sell_price- $discount;
                                }else{
                                    echo $singlepr->sell_price;
                                }
                            @endphp Taka </span></div>
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>@php
                                    if ($singlepr->quantity==0) {

                                       echo "Out of Stock";
                                    }else{
                                        echo "In Stock";
                                    }
                                @endphp </b></p>
                            </div>
                            <form method="post" action="{{ url('/add_cart') }}">
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

                                @csrf
                            <div class="quantity">
                            	<span>Quantity:</span>
								<div class="quantity-input">

									<input type="text" name="product-quatity" value="1" data-max="@php echo $singlepr->quantity; @endphp" pattern="[0-9]*" >

									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div>
							<div class="wrap-butons">


                                    <input type="hidden" name="product_code" value="{{ $singlepr->product_code }}">
                                    <input type="hidden" name="unit_name" value="{{ $singlepr->unit_name }}">
                                    <input type="hidden" name="buy_price" value="{{ $singlepr->buy_price }}">
                                    <input type="hidden" name="sell_price" value="@php
                                        if ($singlepr->discount>0) {
                                            $discount =($singlepr->discount* $singlepr->sell_price)/100;
                                           echo $singlepr->sell_price- $discount;
                                        }else{
                                            echo $singlepr->sell_price;
                                        }
                                    @endphp">
                                    <div class="radio-toolbar">
                                        <?php
                                        $subcat = DB::table('sizes')->where('product_code','=',$singlepr->product_code)->get();
                                        foreach ($subcat as $key => $value) { ?>


                                        <input type="radio" id="radio{{ $value->size }}" name="size" value="{{ $value->size }}">
                                        <label for="radio{{ $value->size }}">{{ $value->size }}</label>
                                        <?php } ?>

                                    </div>



                                    <div class="radio-toolbar">
                                        <?php
                                        $colors = DB::table('colors')->where('product_code','=',$singlepr->product_code)->get();
                                        foreach ($colors as $key => $value) { ?>


                                        <input type="radio" id="radio{{ $value->color }}" name="color" value="{{ $value->color }}">
                                        <label for="radio{{ $value->color }}">{{ $value->color }}</label>
                                        <?php } ?>

                                    </div>







                                    @php
                                    if ($singlepr->quantity==0) {

                                       echo "Out of Stock";
                                    }else{
                                       echo '<input class="btn add-to-cart" type="submit" value="Add to Cart">';
                                    }
                                @endphp

                                </form>

                                <div class="wrap-btn">


                                </div>
							</div>
						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">description</a>

								<a href="#review" class="tab-control-item">Reviews</a>
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
									@php
                                        echo $singlepr->details;
                                    @endphp
								</div>

								<div class="tab-content-item " id="review">

									<div class="wrap-review-form">

										<div id="comments">

@php

$prcode = $singlepr->product_code;
     $comments = DB::table('ratauts')->join('comments', 'comments.product_code', '=', 'ratauts.product_code')->join('users', 'users.id', '=', 'ratauts.customer_id')->where('ratauts.product_code', '=', $prcode)->get();

@endphp
<h2 class="woocommerce-Reviews-title">01 review for </h2>
                                            @foreach ($comments as $com)


											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container">
														<img alt="" src="{{ asset('assets/images/demo.png') }}" height="40" width="40">
														<div class="comment-text">
                                                            <div class="product-rating">


                                                            @php
                                                            $star = $com->customer_rat;
                                                                for ($i=0; $i < $star; $i++) {
                                                                    echo ' <i style="color: red" class="fa fa-star" aria-hidden="true"></i>';

                                                                }
                                                                for ($j=1; $j <= (5-$star); $j++) {
                                                                        echo ' <i style="color: #7e7e7a" class="fa fa-star" aria-hidden="true"></i>';
                                                                    }

                                                            @endphp

</div>
															<p class="meta">
																<strong class="woocommerce-review__author">{{ $com->name }}</strong>
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >@php
                                                                    echo date('d-M-Y', strtotime($com->created_at));
                                                                @endphp</time>
															</p>
															<div class="description">
																<p>{{ $com->comment }}</p>
															</div>
														</div>
													</div>
												</li>
											</ol>
                                            @endforeach

										</div><!-- #comments -->



									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget widget-our-services ">
						<div class="widget-content">
							<ul class="our-services">



								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-gift" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Special Offer</b>
											<span class="subtitle">Get a gift!</span>

										</div>
									</a>
								</li>

							
							</ul>
						</div>
					</div><!-- Categories widget-->

					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">Popular Products</h2>
						<div class="widget-content">
							<ul class="products">

@foreach ($popular as $pop)




								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="{{ url('product/details/'.$pop->product_code) }}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src="{{ url('images/'.$pop->image_one) }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="{{ url('product/details/'.$pop->product_code) }}" class="product-name"><span>{{ $pop->name }}</span></a>
											<div class="wrap-price"><span class="product-price">@php
                                                if ($pop->discount>0) {
                                                    $discount =($pop->discount* $pop->sell_price)/100;
                                                   echo $pop->sell_price- $discount.' Taka';
                                                   echo "</p></ins><del><p class='product-price'>".$pop->sell_price." Taka</p></del></div>";
                                                }else{
                                                    echo $pop->sell_price.' Taka </div>';
                                                }
                                            @endphp
										</div>
									</div>
								</li>
@endforeach

							</ul>
						</div>
					</div>

				</div><!--end sitebar-->

				<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site">
						<h3 class="title-box">Related Products</h3>
						<div class="wrap-products">
							<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                                @foreach ($reltedpr as $rel)


								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="{{ url('product/details/'.$rel->product_code) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
											<figure><img src="{{{ url('images/'.$rel->image_one) }}}" width="800" style="height: 250px;" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
										</a>

										<div class="wrap-btn">
											<a href="{{ url('product/details/'.$rel->product_code) }}" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="{{ url('product/details/'.$rel->product_code) }}" class="product-name"><span>{{ $rel->name }}</span></a>
										<div class="wrap-price"><span class="product-price">@php
                                            if ($rel->discount>0) {
                                                $discount =($rel->discount* $rel->sell_price)/100;
                                               echo $rel->sell_price- $discount.' Taka';
                                               echo "</p></ins><del><p class='product-price'>".$rel->sell_price." Taka</p></del></div>";
                                            }else{
                                                echo $rel->sell_price.' Taka </div>';
                                            }
                                        @endphp
									</div>
								</div>

 @endforeach





							</div>
						</div><!--End wrap-products-->
					</div>
				</div>

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->
    <style>
 .radio-toolbar {
  margin: 10px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 10px 20px;
    font-family: sans-serif, Arial;
    font-size: 16px;
    border: 2px solid #444;
    border-radius: 4px;
}

.radio-toolbar label:hover {
  background-color: #dfd;
}

.radio-toolbar input[type="radio"]:focus + label {
    border: 2px dashed #444;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
}


</style>

<script type="text/javascript">
    let thumbnails = document.getElementsByClassName('thumbnail')

    let activeImages = document.getElementsByClassName('active')

    for (var i=0; i < thumbnails.length; i++){

        thumbnails[i].addEventListener('mouseover', function(){
            console.log(activeImages)

            if (activeImages.length > 0){
                activeImages[0].classList.remove('active')
            }


            this.classList.add('active')
            document.getElementById('featured').src = this.src
        })
    }


    let buttonRight = document.getElementById('slideRight');
    let buttonLeft = document.getElementById('slideLeft');

    buttonLeft.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft -= 180
    })

    buttonRight.addEventListener('click', function(){
        document.getElementById('slider').scrollLeft += 180
    })


</script>
<style>#content-wrapper{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.column{
    width: 400px;
    padding: 10px;

}

#featured{
    max-width: 400px;
    min-width: 400px;
    max-height: 600px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid black;

}

.thumbnail{
    object-fit: cover;
    max-width: 180px;
    max-height: 100px;
    cursor: pointer;
    opacity: 0.5;
    margin: 5px;
    border: 2px solid black;

}

.thumbnail:hover{
    opacity:1;
}

.active{
    opacity: 1;
}

#slide-wrapper{
    max-width: 400px;
    display: flex;
    min-height: 100px;
    align-items: center;
}

#slider{
    width: 400px;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;

}

#slider::-webkit-scrollbar {
        width: 8px;

}

#slider::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);

}

#slider::-webkit-scrollbar-thumb {
  background-color: #dede2e;
  outline: 1px solid slategrey;
   border-radius: 100px;

}

#slider::-webkit-scrollbar-thumb:hover{
    background-color: #18b5ce;
}

.arrow{
    width: 30px;
    height: 30px;
    cursor: pointer;
    transition: .3s;
}

.arrow:hover{
    opacity: .5;
    width: 35px;
    height: 35px;
}</style>
@stop
