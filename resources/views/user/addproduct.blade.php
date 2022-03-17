@extends('user.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Create New Product</h4>
                <p class="card-description">All Field is <span style="color: red;">required</span>    So Fill up all the field Carefully </p>
                <form method="POST" action="{{ url('/create_product') }}" class="forms-sample" enctype="multipart/form-data">
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
                <label for="country">Select Catagory:</label>
                <select name="cat_id" class="form-control" name="cat_id" style="width:250px">
                    <option value="">--- Select Catagory ---</option>
                    @foreach ($data as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="col-md-6">
         <div class="form-group">
                <label for="state">Select sub Catagory:</label>
                <select name="subcat_id" class="form-control"style="width:250px">
                <option>--Choose Catagory First--</option>
                </select>
            </div>
    </div>
    <div class="col-md-3">
         <div class="form-group">
                    <label for="exampleSelectGender">Brand</label>
                    <select class="form-control" name="brand_id" id="exampleSelectGender">
                        <option value="0" disabled selected>--Choose brand--</option>
                        @foreach ($allbrand as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                      @endforeach
                    </select>
                  </div>
    </div>
    <div class="col-md-3">
         <div class="form-group">
                    <label for="exampleSelectGender">Product type</label>
                    <select class="form-control" name="product_type_id"  id="exampleSelectGender">

                        @foreach ($allpt as $pt)
                      <option value="{{ $pt->id }}">{{ $pt->product_type }}</option>
                      @endforeach
                    </select>
                  </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
                    <label for="exampleInputName1">Product Code</label>
                    <input type="text" class="form-control" value="<?php echo time();?>" name="product_code" id="exampleInputName1" placeholder="Code">
                  </div>
    </div>
</div>


                  <div class="form-group">
                    <label for="exampleInputEmail3">Product title</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail3" placeholder="title">
                  </div>
                  <div class="row">
                      <div class="col-md-3">
                           <div class="form-group">
                    <label for="exampleInputEmail3">Product Quantity</label>
                    <input type="number" min="1" class="form-control" name="quantity" id="exampleInputEmail3" placeholder="quantity">
                  </div>
                      </div>
                      <div class="col-md-3">
                            <div class="form-group">
                    <label for="exampleSelectGender">Product Unit</label>
                    <select name="unit_id" class="form-control" id="exampleSelectGender">
                        <option >--Choose Unit--</option>
                        @foreach ($allunit as $unit)
                      <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                      @endforeach
                    </select>
                  </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                    <label for="exampleInputEmail3">Buying Price</label>
                    <input type="text" class="form-control" step="0.5" name="buy_price" id="exampleInputEmail3" placeholder="Buying Price">
                  </div>
                      </div>
                      <div class="col-md-3">
                           <div class="form-group">
                    <label for="exampleInputEmail3">Selling Price</label>
                    <input type="text" class="form-control" step="0.5" name="sell_price" id="exampleInputEmail3" placeholder="Selling Price">
                  </div>
                      </div>
                  </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail3">Discount</label>
          <input type="number" class="form-control" min="0" step="0.1" value="0" name="discount" id="exampleInputEmail3" placeholder="Discount">
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
          <label class="form-label" for="customFile">Choose Image</label>
          <input type="file" class="form-control" name="image1" id="customFile" />

        </div>
    </div>
</div>

<div class="form-group">
    <label for="exampleTextarea1">Details</label>
    <textarea name="details" rows="4"  class="form-control"></textarea>
</div>
<button type="submit" class="btn btn-primary mr-2">Submit</button>


                </form>
              </div>
            </div>
          </div>


    </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="cat_id"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getstates/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="subcat_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="subcat_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="subcat_id"]').empty();
               }
            });
    });
    </script>
@stop
