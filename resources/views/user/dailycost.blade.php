@extends('user.master')
@section('content')






<div class="row">
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="row">
            <div class="col-md-2"></div>
        <div class="col-md-2">  <form method="get" action="{{ url('dailycost') }}">
        <input type="hidden" value="@php $today = new DateTime('today');
        echo $today->format('Y-m-d'); @endphp" name="todaydate">
   <button type="submit"  class="btn btn-outline-primary">Today</button>
          </form>
</div>
        <div class="col-md-2"> <form method="get" action="{{ url('dailycost') }}">
            <input type="hidden" value="@php $yesterday = new DateTime('yesterday');
            echo $yesterday->format('Y-m-d');  @endphp" name="yesterday">
      <button  type="submit"  class="btn btn-outline-primary">Yesterday</button>
     </form>
</div>
        <div class="col-md-6">

     <form method="get" action="{{ url('dailycost') }}">
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



    <div class="col-md-8 grid-margin stretch-card">
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
                    <th>Category Name</th>
                    <th>Report</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                    @php
                        $finalcost=0;
                    @endphp

                    @foreach ($allcost as $i => $item)

                  <tr>
                      <td>{{ $i+1 }}</td>
                    <td>{{ $finalcost += $item->cost }} Taka</td>
                    <td>{{ $item->report }} </td>

                    <td>
                       <form action="{{ url('/delcost') }}" method="POST">
                           @csrf
                        <input type="hidden" value="{{ $item->id }}" name="id" >

                        <button style="padding: 5px; border:1px solid red; margin-bottom:3px;" class="badge badge-danger">Delete</button>
                    </form>

                 
                    </td>
                  </tr>


                    @endforeach
                    Total Cost:
                  @php
                      echo $finalcost;
                  @endphp
Taka
</p> {{ $allcost->links('pagination.custom') }}
                </tbody>
              </table>

          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Daily Cost  Form</h4>
            <p class="card-description">Create Todays Cost </p>



            <form method="POST" action="{{ url('/create_cost') }}" class="forms-sample" enctype="multipart/form-data">


                @csrf



                  <div class="form-group">
                    <label for="exampleInputEmail3">Amount</label>
                    <input type="number" class="form-control" min="1" step=".01" name="cost" id="exampleInputEmail3" placeholder="title">
                  </div>


                  <div class="form-group">
                    <label for="exampleTextarea1">Report</label>
                    <textarea name="report" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                  </div>


                  <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>





          </div>
        </div>
      </div>
</div>


@stop
