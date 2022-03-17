@extends('user.master')
@section('content')
<div class="content-wrapper">


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

 <form class="search-form d-none d-md-block" action="{{ url('/product') }}" method="GET">
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

                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Code </th>
                        <th>Name </th>
                        <th>Category</th>

                        <th>Brand  </th>
                        <th> Type </th>

                        <th>buying Price </th>
                        <th>Selling Price </th>
                        <th>images </th>

                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($allproduct as $i => $item)


                      <tr>
                          <td>{{ $i+1 }}</td>
                          <td>{{ $item->product_code }}</td>
                          <td>{{ $item->name }}</td>
                        <td>{{ $item->cat_name }}</td>

                        <td>{{ $item->brand_name }}</td>
                        <td>{{ $item->product_type }}</td>

                        <td>{{ $item->buy_price }} Taka</td>
                        <td>{{ $item->sell_price }} Taka</td>
                        <td><img style="height: 60px;width:60px;" src="{{ url('images') }}/{{ $item->image_one }}" alt=""></td>


                        <td>
                           <form action="{{ url('/junkproduct') }}" method="POST">
                               @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id" >

                            <button style="padding: 5px; border:1px solid red; margin-bottom:3px;" class="badge badge-danger">Delete</button>
                        </form>
                        <a  style="padding: 5px;" href="{{ url('/product') }}/{{ $item->product_code }}" class="badge badge-success">Update</a>
 


                        </td>
                      </tr>


                        @endforeach
                        {{ $allproduct->links('pagination.custom') }}

                    </tbody>
                  </table>

              </div>
            </div>
          </div>

    </div>


@stop
