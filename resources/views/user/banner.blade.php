@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Banner Table</h4>
                <p class="card-description">Your Created Banner</p>
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


                                {{ $banners->links('pagination.custom') }}
                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Category Name</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
 
                        @foreach ($banners as $i => $item)
      
                      <tr>
                          <td>{{ $i }}</td>
                        <td>{{ $item->subcat_name }}</td>
                        <td><img style="height: 60px;width:60px;" src="{{ url('images') }}/{{ $item->image }}" alt=""></td>

                        <td>
                           <form action="{{ url('/delbanner') }}" method="POST">
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
                <h4 class="card-title">Banner  Form</h4>
                <p class="card-description">Create New Banner </p>



                <form method="POST" action="{{ url('/create_banner') }}" class="forms-sample" enctype="multipart/form-data">
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
                                        <label for="exampleSelectGender" class="col-sm-3">Sub Category</label>
                                        <select name="subcat_name" class="form-control" id="exampleInputUsername2">
                                          @foreach ($allsubcat as $items)
                                          <option  value="{{ $items->subcat_name }}">{{ $items->subcat_name}}</option>
                                           @endforeach
                                        </select>
                                      </div>

                                      <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label"> Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="details" rows="4"  class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <input name="image" type="file">

                                      </div>
                                      <div class="form-group row">
                                        <label for="exampleSelectGender" class="col-sm-3">Sub Category</label>
                                        <select name="banner_flag" class="form-control" id="exampleInputUsername2">

                                          <option  value="0">Slide View</option>
                                          <option  value="1">Banner View</option>

                                        </select>
                                      </div>
                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Create</button>

                </form>





              </div>
            </div>
          </div>
    </div>


@stop
