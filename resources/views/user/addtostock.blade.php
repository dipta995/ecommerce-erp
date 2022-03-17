@extends('user.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Product to Stock List</h4>
                <p class="card-description"><span style="color: red;">Imprtant Field </span>    So Fill up the field Carefully </p>
                <form method="POST" action="{{ url('/purchase/product/stockadd') }}" class="forms-sample" enctype="multipart/form-data">
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
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                <label for="country">Select Product:</label>
                <select name="product_code" class="form-control"  style="width:250px">
                    <option value="">--- Select product ---</option>
                    @foreach ($products as $value)
                    <option value="{{ $value->product_code }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <h3 style="background: #c02e2e; padding:10px; width:400px; height:auto;border-radius:5px;color:white" >{{ $purchaseproduct->pr_name }} [{{ $purchaseproduct->pr_quantity }}/{{ $purchaseproduct->unit_name }}]</h3>
            <input type="hidden" value="{{ $purchaseproduct->pr_code }}" name="pr_code" id="">
    </div>

                  <button type="submit" class="btn btn-primary mr-2">Add to Stock</button>

                </form>
              </div>
            </div>
          </div>
    </div>
@stop
