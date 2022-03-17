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










    <div class="cont">
    <div class="stars">
        <form action="{{ url('addreview') }}" method="POST" >
            @csrf


                <input class="star star-5" value="5" id="star-5-2" type="radio" name="star"/>
                <label class="star star-5" for="star-5-2"></label>
                <input  value="4" class="star star-4" id="star-4-2" type="radio" name="star"/>
                <label class="star star-4" for="star-4-2"></label>
                <input  value="3" class="star star-3" id="star-3-2" type="radio" name="star"/>
                <label class="star star-3" for="star-3-2"></label>
                <input  value="2" class="star star-2" id="star-2-2" type="radio" name="star"/>
                <label class="star star-2" for="star-2-2"></label>
                <input  value="1" class="star star-1" id="star-1-2" type="radio" name="star"/>
                <label class="star star-1" for="star-1-2"></label>


      <div class="rev-box">
        <textarea class="review" col="30" name="comment"></textarea>
        <label class="review" for="review">Breif Review</label>
        <input class="review inputbtn" type="submit" name="add" >
      </div>


<input type="hidden" value="{{ $productcode }}" name="product_code">


    </form>
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

    <style>


        .inputbtn{
            padding: 5px;
            color: white;
            background: red;
            border-radius: 2px;
            border: 2px solid red;
        }
        .cont{
          width: 93%;
          max-width: 350px;
          text-align: center;
          margin: 4% auto;
          padding: 30px 0;
          background: #ffffff;
          color: #EEE;
          border-radius: 5px;
          border: thin solid #ffffff;
          overflow: hidden;
        }

        hr{
          margin: 20px;
          border: none;
          border-bottom: thin solid rgba(255,255,255,.1);
        }

        div.title{
          font-size: 2em;
        }

        h1 span{
          font-weight: 300;
          color: #Fd4;
        }

        div.stars{
          width: 300px;
          display: inline-block;
        }

        input.star{
          display: none;
        }

        label.star {
          float: right;
          padding: 10px;
          font-size: 36px;
          color: #444;
          transition: all .2s;
        }

        input.star:checked ~ label.star:before {
          content:'\f005';
          color: #FD4;
          transition: all .25s;
        }


        input.star-5:checked ~ label.star:before {
          color:#FE7;
          text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before {
          color: #F62;
        }

        label.star:hover{
          transform: rotate(-15deg) scale(1.3);
        }

        label.star:before{
          content:'\f006';
          font-family: FontAwesome;
        }

        .rev-box{
          overflow: hidden;
          height: 0;
          width: 100%;
          transition: all .25s;
        }

        textarea.review{
            background: #ffffff;
            border: 1px solid #171719;
          width: 100%;
          max-width: 100%;
          height: 100px;
          padding: 10px;
          box-sizing: border-box;
          color: #050202;
        }

        label.review{
          display: block;
          transition:opacity .25s;
        }



        input.star:checked ~ .rev-box{
          height: 125px;
          overflow: visible;
        }






        </style>

    @stop
