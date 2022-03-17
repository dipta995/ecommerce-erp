@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Product Update Form</h4>

                <form method="POST" action="{{ url('/up_product') }}" class="forms-sample" enctype="multipart/form-data">
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




                  <div class="form-group">
                    <label for="exampleSelectGender">Categorie</label>
                    <select name="cat_id" class="form-control" id="exampleSelectGender">

                        @foreach($data as $cat)
                      <option value="{{ $cat->id }}"  @if ($singlepr->cat_name==$cat->cat_name)
                       selected
                      @endif>{{ $cat->cat_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Sub Categorie</label>
                    <select name="subcat_id" class="form-control" id="exampleSelectGender">

                        @foreach($subcats as $sub)
                      <option value="{{ $sub->id }}"  @if ($singlepr->subcat_name==$sub->subcat_name)
                       selected
                      @endif>{{ $sub->subcat_name }}</option>
                      @endforeach
                    </select>
                  </div>




                  <div class="form-group">
                    <label for="exampleSelectGender">Brand</label>
                    <select class="form-control" name="brand_id" id="exampleSelectGender">

                        @foreach ($allbrand as $brand)
                      <option value="{{ $brand->id }}" @if ($singlepr->brand_name==$brand->brand_name)
                       selected
                      @endif>{{ $brand->brand_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectGender">Product type</label>
                    <select class="form-control" name="product_type_id"  id="exampleSelectGender">

                        @foreach ($allpt as $pt)
                      <option value="{{ $pt->id }}" @if ($singlepr->product_type==$pt->product_type)
                       selected
                      @endif>{{ $pt->product_type }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Product Code</label>
                    <input type="text" class="form-control" readonly value="{{ $singlepr->product_code }}" name="product_code" id="exampleInputName1" placeholder="Code">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail3">Product title</label>
                    <input type="text" class="form-control" value="{{ $singlepr->name }}" name="name" id="exampleInputEmail3" placeholder="title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Product Quantity</label>
                    <input type="number" min="1" value="{{ $singlepr->quantity }}" class="form-control" name="quantity" id="exampleInputEmail3" placeholder="quantity">
                  </div>

                   <div class="form-group">
                    <label for="exampleSelectGender">Product Unit</label>
                    <select name="unit_id" class="form-control" id="exampleSelectGender">

                        @foreach ($allunit as $unit)
                      <option value="{{ $unit->id }}" @if ($singlepr->unit_name==$unit->unit_name)
                       selected
                      @endif>{{ $unit->unit_name }}</option>

                      @endforeach

                    </select>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail3">Buying Price</label>
                    <input type="text" class="form-control" value="{{ $singlepr->buy_price }}" name="buy_price" id="exampleInputEmail3" placeholder="Email">
                     <input type="hidden" class="form-control" value="{{ $singlepr->id }}" name="id" id="exampleInputEmail3" placeholder="Email">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail3">Selling Price</label>
                    <input type="text" value="{{ $singlepr->sell_price }}" class="form-control" name="sell_price" id="exampleInputEmail3" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Discount</label>
                    <input type="number" min="0" value="{{ $singlepr->discount }}" class="form-control" name="discount" id="exampleInputEmail3" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea1">Details</label>
                    <textarea name="details" rows="4"  class="form-control tinymce-editor">{{ $singlepr->details }}</textarea>
                  </div>
                  <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Choose Image</label>
                        <input type="file" class="form-control" name="image1" id="customFile" />
                        <img style="height:60px;width:60px" src="{{ asset('images')}}/{{ $singlepr->image_one }}">
                    </div>

                  </div>

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
