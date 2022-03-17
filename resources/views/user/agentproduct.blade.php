@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Category Table</h4>
                <p class="card-description">Your Created Category</p>
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


                                {{ $products->links('pagination.custom') }}
                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Code </th>
                        <th>name</th>
                        <th>avg price/total price</th>

                        <th>quantity</th>
                        <th>Agent </th>

                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $i => $item)

                      <tr>
                          <td>{{ $i+1 }}</td>
                        <td>{{ $item->pr_code }}</td>
                        <td>{{ $item->pr_name }} </td>
                        <td>{{ $item->pr_price }} Taka <br>{{ $item->pr_price*$item->pr_quantity }} Taka  </td>

                        <td>{{ $item->pr_quantity }} {{ $item->unit_name }}</td>
                        <td>{{ $item->agent_name }} <br> {{ $item->agent_phone }}</td>

                        <td>


                        <a href="{{ url('/upagent') }}/{{ $item->id }}" class="badge badge-success">update</a>
                        <a href="{{ url('/add_stock') }}/{{ $item->pr_code }}" class="badge badge-success">Add Stock</a>

                        </td>
                      </tr>


                        @endforeach

                    </tbody>
                  </table>

              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Buy Product Form</h4>
                <p class="card-description">Create new product  </p>



                <form method="POST" action="{{ url('/purchase/product') }}" class="forms-sample">
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
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Product Code </label>
                    <div class="col-sm-9">
                      <input type="text" value="{{ time() }}" name="pr_code" class="form-control" id="exampleInputUsername2" placeholder="Category  Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Product Title</label>
                    <div class="col-sm-9">
                      <input type="text" name="pr_name" class="form-control" id="exampleInputUsername2" placeholder="Product Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Buying Price</label>
                    <div class="col-sm-9">
                      <input type="number" step="0.1" name="pr_price" class="form-control" id="exampleInputUsername2" placeholder="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-9">
                      <input type="number" min="1" name="pr_quantity" class="form-control" id="exampleInputUsername2" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Product Unit</label>
                    <select name="pr_unit" class="form-control" id="exampleSelectGender">
                        <option >--Choose Unit--</option>
                        @foreach ($allunit as $unit)
                      <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="form-group">
            <label for="exampleSelectGender">Unit Name</label>
            <select name="agent_id" class="form-control" id="exampleSelectGender">
                <option >--Choose Unit--</option>
                @foreach ($allagent as $ag)
              <option value="{{ $ag->id }}">{{ $ag->agent_name }}</option>
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
