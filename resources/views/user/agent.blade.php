@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Purchase Company Table</h4>
                <p class="card-description">Here you can registration and and pay your previous due</p>
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


                                {{ $allagent->links('pagination.custom') }}
                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Name</th>
                        <th>Email <br> Contact No</th>
                        <th>Address</th>
                        <th>Due</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
@php
    $i = 0;
    $getduetotal=0;
@endphp
                        @foreach ($allagent as $item)
                        @php
                            $i++;

         $id = $item->id;
              $due = DB::table('purchaseproducts')->join('agents', 'purchaseproducts.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
$due1 = DB::table('agents')->join('agentpays', 'agentpays.agent_id', '=', 'agents.id')->where('agents.id', $id)->get();
$total= 0;
$paid = 0;
foreach ($due as  $value) {
$price = $value->pr_price*$value->pr_quantity;

$total += $price;
}
foreach ($due1 as $key => $value) {
$paid += $value->paid_amouont;
}
$getdue =  $total-$paid;
$getduetotal += $getdue;


         @endphp

                      <tr style=" @php
                          if ($getdue>0) {
    echo "background:#a09999;";
}else{
    echo "background:#fcf7f7;";
}
                      @endphp " >
                          <td>{{ $i }}</td>
                        <td>{{ $item->agent_name }}</td>
                        <td>{{ $item->agent_email }} <br> {{ $item->agent_phone }}</td>
                        <td>{{ $item->agent_company }} <br> {{ $item->address }}</td>
<td>{{ $getdue }}</td>
                        <td>

                        <a style="padding:5px; margin-bottom: 3px;" href="{{ url('/upagent') }}/{{ $item->id }}" class="badge badge-success">update</a>
                        <?php if ($getdue!=0) { ?>
                        <a style="padding:5px;" href="{{ url('/purchese/due') }}/{{ $item->id }}" class="badge badge-success">pay</a>
                        <?php } ?>

                        </td>
                      </tr>


                        @endforeach
                        <p style="background:<?php if ($getduetotal>0) {echo "#ff5252";}else{echo "#32ad2a";}?> ;padding:5px;width:auto; text-align: center; color:white;">Total Due: {{ $getduetotal }}</p>



                    </tbody>
                  </table>

              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Purchas Company  Form</h4>
                <p class="card-description">Create New Purchas Company </p>



                <form method="POST" action="{{ url('/purchase/agent') }}" class="forms-sample">
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
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Company Agent Name </label>
                    <div class="col-sm-9">
                      <input type="text" name="agent_name" class="form-control" id="exampleInputUsername2" placeholder=" Company Agent Name ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Email (Optional)</label>
                    <div class="col-sm-9">
                      <input type="email" name="agent_email" class="form-control" id="exampleInputUsername2" placeholder="example@email.com">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Contact No</label>
                    <div class="col-sm-9">
                      <input type="text" name="agent_phone" class="form-control" id="exampleInputUsername2" placeholder="123456789">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Company Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="agent_company" class="form-control" id="exampleInputUsername2" placeholder="Company  Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> address (Optional)</label>
                    <div class="col-sm-9">
                      <textarea type="text" name="address" class="form-control" id="exampleInputUsername2" placeholder="Address"></textarea>
                    </div>
                  </div>
                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Create</button>

                </form>





              </div>
            </div>
          </div>
    </div>


@stop
