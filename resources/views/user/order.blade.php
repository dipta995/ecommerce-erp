@extends('user.master')
@section('content')
<div class="content-wrapper">

    {{-- <div class="sidebar-item search-form">
        <form action="{{ url($url) }}" method="GET">
          <input type="text" name="search" >
          <button type="submit"><i class="icofont-search"></i></button>
        </form>
      </div> --}}

      <form class="search-form d-none d-md-block" action="{{ url($url) }}" method="GET">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                 <div class="form-group">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Search</button>
              </div>
            </div>
          </div></div>
        </div>

      </form>
     

      <!-- End sidebar search formn-->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Prodcuct Table</h4>
                <p class="card-description">Your Created Products</p>
                  {{-- MESSAGE --}}
                                        @if (Session::get('sss'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>

                                               {{ Session::get('sss') }}
                                        </div>
                                        @endif


                                        @if (Session::get('fff'))
                                        <div class="alert alert-danger alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                         {{ Session::get('fff') }}
                                        </div>
                                        @endif






                                        <div id="accordion" class="accordion-container">

                                            @foreach ($sleeps as $item)


                                            <article class="content-entry">



                                                    <h4 class="article-title"><i></i> <span>{{ $item->sleep_no }}</span> <span>{{ $item->total_amount }}Taka</span>    <span>{{ $item->name }} [{{ $item->email }}] </span>
                                                     <?php
                                                    $sleep =  $item->sleep_no;
                                                        if($item->pay_status==0)
                                                        { ?>
                                                          <a  class='btn btn-success' onclick='return myFunction("Check your account again and click confirm")' href='{{ url('confirm_payment') }}/{{$item->sleep_no}}'>Not Paid</a>
                                                      <?php  }else{
                                                          echo "paid";
                                                  }
                                                   ?>
<?php if ($item->delivery_status==0) { ?>

    <a  class='btn btn-success' onclick='return myFunction("Are you sure that your product is ready for Delivery?")' href='{{ url('delivery_status') }}/{{$item->sleep_no}}'>Make On the way</a>
<?php } elseif ($item->delivery_status==1) { ?>


<a  class='btn btn-success' onclick='return myFunction("Are you sure that your product Reached successfully?")' href='{{ url('delivery_status_final') }}/{{$item->sleep_no}}'>Delivered </a>

<?php }?>
<a style="float: right;" class='btn btn-success' target="__blank" href='{{ url('invoice') }}/{{$item->sleep_no}}'>Invoice </a>

                                                </h4>






                                                    <div class="accordion-content">

 <table id="tableid" class="table">
                                                            <thead>
                                                              <tr>
                                                                <th>NO</th>
                                                                <th>Product Code</th>
                                                                <th> Product Name </th>
                                                                <th>Price </th>
                                                                <th>Quantity </th>


                                                                <th>Action</th>

                                                              </tr>
                                                            </thead>
                                                            <tbody>

<?php
     $orderlist =  DB::table('orders')->where('orders.sleep_no', '=',$sleep)->join('products', 'products.product_code', '=', 'orders.product_code')->get();
      
foreach ($orderlist as $i => $value) {
     
?>
                                                              <tr>
                                                                  <td>{{ $i+1 }}</td>
                                                                <td>{{ $value->product_code }}</td>
                                                                  <td> {{ $value->name }}</td>
                                                                  <td>{{ $value->selling_price*$value->order_quantity }}</td>
                                                                  <td>{{ $value->order_quantity }}</td>
                                                                  <td>
                                                                    <?php
                                                                    if ($item->delivery_status==2) { }elseif($item->pay_status==1){}else{
                                                                ?>
                                                                    <a  class='btn btn-danger' onclick='return myFunction("Are you sure that you want to cancell product?")' href='{{ url('cancell_product_order') }}/{{$value->product_code}}/{{$sleep}}'>Cancel</a>
                                                                    <?php } ?>


                                                                </td>
                                                              </tr>


                                                              <?php } ?>


                                                            </tbody>
                                                          </table>


                                                    </div>
                                                    <!--/.accordion-content-->
                                            </article>

                                            @endforeach
                                    </div>


<style>

.article-title span{
    color:black; font-size: 14px; padding:10px;}
.accordion-container {
		position: relative;
		width: 100%;
		border: 1px solid #0079c1;
		border-top: none;
		outline: 0;
		cursor: pointer
}

.accordion-container .article-title {
		display: block;
		position: relative;
		margin: 0;
		padding: 0.625em 0.625em 0.625em 2em;
		border-top: 1px solid #0079c1;
		font-size: 1.25em;
		font-weight: normal;
		color: #0079c1;
		cursor: pointer;
}

.accordion-container .article-title:hover,
.accordion-container .article-title:active,
.accordion-container .content-entry.open .article-title {
		background-color: #00aaa7;
		color: white;
}

.accordion-container .article-title:hover i:before,
.accordion-container .article-title:hover i:active,
.accordion-container .content-entry.open i {
		color: white;
}

.accordion-container .content-entry i {
		position: absolute;
		top: 3px;
		left: 12px;
		font-style: normal;
		font-size: 1.625em;
		sans-serif;
		color: #0079c1;
}

.accordion-container .content-entry i:before {
		content: "+ ";
}

.accordion-container .content-entry.open i:before {
		content: "- ";
}

.accordion-content {
		display: none;
		padding-left: 2.3125em;
}
/* This stuff is just for the Codepen demo */

#content {
		width: 100%;
}

.accordion-container,
#description {
		width: 90%;
		margin: 1.875em auto;
}

#description p {
		line-height: 1.5;
}

#description h2 {
		text-align: center;
}

@media all and (min-width: 860px) {
		#content {
				width: 70%;
				margin: 0 auto;
		}
}
 </style>















              </div>
            </div>
          </div>

    </div>


@stop
