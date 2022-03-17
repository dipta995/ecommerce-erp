<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
<title>Squanchy POS</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('pos/images/logos/squanchy.jpg') }}" >
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('pos/images/logos/squanchy.jpg') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('pos/images/logos/squanchy.jpg') }}">
<!-- jQuery -->
<!-- Bootstrap4 files-->
<link href="{{ asset('pos/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('pos/css/ui.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('pos/fonts/fontawesome/css/fontawesome-all.min.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('pos/css/OverlayScrollbars.css') }}" type="text/css" rel="stylesheet"/>
<!-- Font awesome 5 -->
<style>
	.avatar {
  vertical-align: middle;
  width: 35px;
  height: 35px;
  border-radius: 50%;
}
.bg-default, .btn-default{
	background-color: #f2f3f8;
}
.btn-error{
	color: #ef5f5f;
}
</style>
<!-- custom style -->
</head>
<body>
    @include('sweetalert::alert')

<section class="header-main">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-3">
	<div class="brand-wrap">
		<img class="logo" src="{{ asset('pos/assets/images/logos/squanchy.jpg') }}">
		<h2 class="logo-text">Software maker (POS)</h2>
	</div> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-6 col-sm-6">
		<form action="{{ url('/poshome') }}" method="GET" class="search-wrap">
			<div class="input-group">
			    <input type="text" class="form-control" name="search" placeholder="Search">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
			    </div>
		    </div>
		</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-3 col-sm-6">
		<div class="widgets-wrap d-flex justify-content-end">
			<div class="widget-header">
				<a href="#" class="icontext">
					<a href="{{ url('/author') }}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
															<i class="fa fa-home"></i>
														</a>
				</a>
			</div> <!-- widget .// -->
			<div class="widget-header dropdown">
				<a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
					<img src="{{ asset('admin/images/faces/face8.jpg') }}" class="avatar" alt="">
				</a>
				<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
				</div> <!--  dropdown-menu .// -->
			</div> <!-- widget  dropdown.// -->
		</div>	<!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y-sm bg-default ">
<div class="container-fluid">
<div class="row">
	<div class="col-md-8 card padding-y-sm card ">
		<ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
	<li class="nav-item">
		<a class="nav-link show  @php
        if($catid==0){echo "active";}
    @endphp" href="{{ url('/poshome') }}">
		<i class="fa fa-tags"></i> All</a></li>
        @foreach ($cats as $item)


	<li class="nav-item">
		<a class="nav-link @php
            if($item->id==$catid){echo "active";}
        @endphp " href="{{ url('poshome/'.$item->id) }}">
		<i class="fa fa-tags "></i> {{ $item->cat_name }}</a></li>
@endforeach


</ul>
<span   id="items">
<div class="row">




@foreach ($products as $pr)
<a href="{{ url('add_cart_admin') }}/{{ $pr->product_code }}">
<div class="col-md-2">
	<figure class="card card-product">
		 @php
            if ($pr->discount>0) { echo '<span class="badge-new">'.$pr->discount.'%</span>';}
        @endphp
		<div style="height: 110px;" class="img-wrap">
			<img style="height: 100px;width:90px" src="{{ url('images/'.$pr->image_one )}}">
			<a class="btn-overlay" href="{{ url('/product/details/'. $pr->product_code) }}" target="__blank"><i class="fa fa-search-plus"></i> Quick view</a>
		</div>
		<figcaption style="min-height: 130px;" class="info-wrap">
			<a href="{{ url('add_cart_admin') }}/{{ $pr->product_code }}" class="title">{{ $pr->name }}</a>
			<div class="action-wrap">


				<div class="price-wrap h6">
					<span  class="price-new">@php
                        if ($pr->discount>0) {
                            $discount =($pr->discount* $pr->sell_price)/100;
                           echo round($pr->sell_price- $discount).' Taka';
                           echo "<del style='color:red;'>".$pr->sell_price." Taka";
                        }else{
                            echo round($pr->sell_price).' Taka ';
                        }
                    @endphp</span>
				</div> <!-- price-wrap.// -->

			</div> <!-- action-wrap -->

		</figcaption>
        <?php
        if ($pr->quantity==0 ) {
            echo "Out of stock";
        }else{
    ?>
<a href="{{ url('add_cart_admin') }}/{{ $pr->product_code }}" class="btn btn-primary btn-sm float-right" type="submit"> <i class="fa fa-cart-plus"></i> Add </a>
<?php } ?>
	</figure> <!-- card // -->
</div>
</a>
{{-- </form> --}}

@endforeach



</div> <!-- row.// -->
<div  class="row">

    {{ $products->links('pagination.custom') }}
</div>
 <!-- row.// -->
</span>
	</div>
	<div class="col-md-4">
<div class="card">
	<span id="cart">


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

<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Item</th>
  <th scope="col" width="120">Qty</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200">Delete</th>
</tr>
</thead>
<tbody>

@php
    $total_price = 0;
@endphp
@foreach ($cart as $item)



<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="{{ url('/images/'.$item->image_one) }}" class="img-thumbnail img-xs"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">{{ $item->name }}</h6>
	</figcaption>
</figure>
	</td>
	<td class="text-center">
				<div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                    <form action="{{ url('/update_cart_admin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
				<input type="number" name="product-quatity" min="1" value="{{ $item->cart_quantity }}" max="{{ $item->quantity }}">
			</div>
	</td>
	<td>
		<div class="price-wrap">
			<var class="price">{{ $price = $item->cart_sell_price*$item->cart_quantity }} Taka</var>
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right">
        <button type="submit" class="btn btn-outline-success btn-round"> <i class="fas fa-sync-alt"></i></button>
    </form>
		<a href="{{ url('/remove_cart_admin/'. $item->id ) }}" class="btn btn-outline-danger btn-round"> <i class="fa fa-trash"></i></a>
	</td>
</tr>
@php

    $total_price +=$price;
@endphp
@endforeach

</tbody>
</table>
</span>
</div> <!-- card.// -->
<div class="box">
<dl class="dlist-align">
  <dt>Tax: </dt>
  <dd class="text-right">(5%) {{ $vat = $total_price*0.05 }} Taka</dd>
</dl>
{{-- <dl class="dlist-align">
  <dt>Discount:</dt>
  <dd class="text-right"><a href="#">0%</a></dd>
</dl> --}}
<dl class="dlist-align">
  <dt>Sub Total:</dt>
  <dd class="text-right">{{ $total_price }} Taka</dd>
</dl>
<dl class="dlist-align">
  <dt>Total: </dt>
  <dd class="text-right h4 b"> {{ $total_price+$vat }} Taka</dd>
</dl>
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('add_cart_admin') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 inputfield">
        <label for="">Customer Name </label>
        <input type="text" name="guest_name" placeholder="enter name">
            </div>
            <div class="col-md-6 inputfield">
        <label for="">Paid amount</label>
        <input type="text" id="paidamount" name="paid_amount">
            </div>
            <div class="col-md-6 inputfield">
        <label for="">Phone No</label>
        <input type="text" name="phone_no" value="" placeholder="enter phone number">
            </div>
        </div>
<style>
    .inputfield input{
        padding:10px;
        width: 100%;
        border-radius: 2px;

    }
</style>


        <input type="hidden" name="sell_price" id="sellprice" value="{{ ($total_price+$vat) }}">


                            <input type="hidden" name="sleep_no" value="@php
                                 echo $rand = rand(time(),6)
                            @endphp "></div>
	<div class="col-md-6">

<script>
// function calculate_change()
// {

//     var sp=document.getElementById('sellprice').value;
//     var cp=document.getElementById('paidamount').value;
//     if(sp<cp)
//     {

//        alert(cp-sp);
//     }
//     else if(sp>cp)
//     {

//        alert(sp-cp);
//     }
// }
// </script>

		<a href="#" class="btn  btn-default btn-error btn-lg btn-block"><i class="fa fa-times-circle "></i> Cancel </a>
	</div>
	<div class="col-md-6">
        <?php if ($total_price!=0) {
           ?>
		<button type="submit" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i> Sell </button> <?php } ?> </form>
	</div>
</div>
</div> <!-- box.// -->
	</div>
</div>
</div><!-- container //  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<script src="{{ asset('pos/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pos/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pos/js/OverlayScrollbars.js') }}" type="text/javascript"></script>
<script>
	$(function() {
	//The passed argument has to be at least a empty object or a object with your desired options
	//$("body").overlayScrollbars({ });
	$("#items").height(552);
	$("#items").overlayScrollbars({overflowBehavior : {
		x : "hidden",
		y : "scroll"
	} });
	$("#cart").height(445);
	$("#cart").overlayScrollbars({ });
});
</script>
</body>
</html>
