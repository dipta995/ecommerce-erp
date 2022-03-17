@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Color Table</h4>
                <p class="card-description">Your products color</p>
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


  {{ $colors->links('pagination.custom') }}
                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Product code</th>
                        <th>Product Name</th>
                        <th>Colors</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($colors as $i => $item)

                        <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->product_code}}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->color }}</td>

                        <td>
                           <form action="{{ url('/delcolor') }}" method="POST">
                               @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id" >

                            <button style="padding: 5px; border:1px solid red; margin-bottom:3px;" class="badge badge-danger">Delete</button>
                        </form>


                        </td>
                      </tr>


                        @endforeach

                    </tbody>
                  </table>

              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Color Form</h4>
                <p class="card-description">Add New Color </p>
                <form method="POST" action="{{ url('/create_color') }}" class="forms-sample">
                                        {{-- MESSAGE --}}
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
                    <label for="exampleSelectGender" class="col-sm-3">Product Name</label>
                    <select name="product_id" class="form-control" id="exampleInputUsername2">
                      @foreach ($products as $items)
                      <option  value="{{ $items->product_code }}">{{ $items->name}}</option>
                       @endforeach
                    </select>
                  </div>


                  <div class="form-group row">
                    <label for="exampleSelectGender" class="col-sm-3">color Name</label>
                    <select name="color" class="form-control" id="exampleInputUsername2">
                        <option value="">--Choose Color--</option>
                        @foreach ($createcolor as $cl)
                      <option  value="{{ $cl->color_name }}">{{ $cl->color_name }}</option>
                      @endforeach

                    </select>
                  </div>


                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Create</button>

                </form>





              </div>
            </div>
          </div>
    </div>


@stop
