@extends('user.master')
@section('content')
<div class="content-wrapper">

    <form class="search-form d-none d-md-block" action="{{ url('/guestlist') }}" method="GET">
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
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Guest Customers Overview</h4>
                <p class="card-description">Here you can check and changes</p>
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


                                            @php
                                                $dues = 0;
                                            @endphp
@foreach ($allguest as $item)
                                            <article class="content-entry">
                                                    <h4 class="article-title"><i></i> <span>{{ $item->guest_name }}</span> <span>{{ $item->phone }}</span>
                                                      @php
                                                       $paylist =  DB::table('guestpays')->where('phone', '=',$item->phone)->get();
     $paidtaka =0;

foreach ($paylist as $value) {$paidtaka += $value->paid_amount; }

  $sleepcal =  DB::table('sleeps')->where('phone_no', '=',$item->phone)->get();
     $buyingat =0;

foreach ($sleepcal as $val) { $buyingat +=$val->total_amount; }

                                                      @endphp
                                                        <p class="amounttitle"><span class="amounttitlea">paid:</span>{{ $paidtaka }} Taka<span class="amounttitlea">Buy:</span>{{ $buyingat }} Taka<span class="amounttitlea">Total dues:</span>  {{ $buyingat-$paidtaka }}Taka </p>
<a style="float: right;margin-top: -50px;" class='@php
     if ($buyingat-$paidtaka>0) {
   echo 'btn btn-danger';
 }else{
  echo 'btn btn-success';
 }
@endphp' target="__blank" href='{{ url('guestdetails') }}/{{ $phone=$item->phone}}'>Details</a>
                                                </h4>
                                                    <div class="accordion-content">
 <table id="tableid" class="table">
                                                            <thead>
                                                              <tr>
                                                                <th>NO</th>

                                                                <th>Price </th>



                                                                <th></th>

                                                              </tr>
                                                            </thead>
                                                            <tbody>

<?php
     $paylist =  DB::table('guestpays')->where('phone', '=',$phone)->get();

  
foreach ($paylist as $i=> $value) {
?>
                                                              <tr>
                                                                  <td>{{ $i+1 }}</td>

                                                                  <td>{{  $tk = $value->paid_amount }} Taka</td>
                                                                  <td>
                                                                    {!! date('d/M/Y', strtotime($value->created_at)) !!}
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
    .amounttitle {
    color: #000000;
    font-size: 16px;
    background-color: #bbbbbb;
    padding: 2px;
    border-radius: 3px;
    width: 500px;
}
    .amounttitlea{ color: #000000; font-size: 16px;}

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
