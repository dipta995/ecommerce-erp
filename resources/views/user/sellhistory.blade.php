@extends('user.master')
@section('content')




</br>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="row">
            <div class="col-md-2">
                <form method="get" action="{{ url('sell/history') }}">
                    <input type="hidden" value="mostsold" name="mostsold">
               <button type="submit"  class="btn btn-outline-primary">Most sold</button>
                      </form>
            </div>
        <div class="col-md-2">  <form method="get" action="{{ url('sell/history') }}">
        <input type="hidden" value="@php $today = new DateTime('today');
        echo $today->format('Y-m-d'); @endphp" name="todaydate">
   <button type="submit"  class="btn btn-outline-primary">Today</button>
          </form>
</div>
        <div class="col-md-2"> <form method="get" action="{{ url('sell/history') }}">
            <input type="hidden" value="@php $yesterday = new DateTime('yesterday');
            echo $yesterday->format('Y-m-d');  @endphp" name="yesterday">
      <button  type="submit"  class="btn btn-outline-primary">Yesterday</button>
     </form>
</div>
        <div class="col-md-6">

     <form method="get" action="{{ url('sell/history') }}">
<div class="row">
    <div class="col-md-5"><input   class="form-control" type="date" value="@php $yesterday = new DateTime('yesterday');
      echo $yesterday->format('Y-m-d');  @endphp" name="month1"></div>
    <div class="col-md-5"> <input class="form-control" type="date" value="@php $today = new DateTime('today');
       echo $today->format('Y-m-d');  @endphp" name="month"></div>
    <div class="col-md-1">  <button  type="submit"  class="btn btn-outline-primary">Confirm</button></div>
    <div class="col-md-1"></div>
</div>



    </form></div>



    </div>
    </div>






    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Daily Cost Table</h4>
            <p class="card-description">Your Costs</p>
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


                                    <table id="tableid" class="table">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Buying price</th>
                                                <th>Selling price</th>
                                                <th>Product Quanity</th>
                                                <th>Order At</th>

                                            </tr>
                                        </thead>

                <tbody>
                    @php
                    $tb=0;
                    $ts=0;
                    $quantity=0;
                 
                    @endphp

                    @foreach ($totalsell as $i => $item)
 



                  <tr>
                      <td>{{ $i+1 }}</td>
                    <td>{{ $buyprice = $item->buy_price*$item->order_quantity }} Taka</td>
                    <td>{{ $sellprice = (($item->selling_price*$item->order_quantity)*0.05)+($item->selling_price*$item->order_quantity) }} Taka</td>

                    <td>{{ $quan = $item->order_quantity }} </td>
                    <td>{{  date('d-M-Y', strtotime($item->order_at)) }} </td>
                    @php
                          $tb += $buyprice;
                        $ts += $sellprice;
                        $quantity += $quan;
                    @endphp
                  </tr>


                    @endforeach
                  <p class="spanpra">  Buying Price:
                    @php
                    echo '<span class="spanclass">'.$tb.' Taka </span> Selling Price: <span class="spanclass">'.$ts.' Taka</span> Quantity: <span class="spanclass">'. $quantity. 'Piece</span> Total collection : <span class="spanclass">'. $totalcollect. 'Taka</span>  Spend : <span class="spanclass">'. $totalcost. 'Taka</span>';


                 @endphp
</p> 
 







{{ $totalsell->links('pagination.custom') }}
<style>
    .spanpra{
        color: #ffffff; padding:3px; width:960px; text-align: center;background: #858586
    }
    .spanclass{
        background: #555252;
        padding: 8px;
        border-radius: 2px;
        margin-right: 10px;
    }
</style>
                </tbody>
              </table>

          </div>
        </div>
      </div>

</div>


@stop
