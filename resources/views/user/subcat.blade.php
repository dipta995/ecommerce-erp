@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Sub Category Table</h4>
                <p class="card-description">Your Sub Created Category</p>
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


  {{ $allsubcat->links('pagination.custom') }}
                <table id="tableid" class="table">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>



 
                        @foreach ($allsubcat as $i => $item)
                     

                      <tr>
                          <td>{{ $i+1 }}</td>
                        <td>{{ $item->cat_name }}</td>
                        <td>{{ $item->subcat_name }}</td>

                        <td>
                           <form action="{{ url('/delsubcat') }}" method="POST">
                               @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id" >

                            <button style="padding: 5px; border:1px solid red; margin-bottom:3px;" class="badge badge-danger">Delete</button>
                        </form>
                        <a style="padding: 5px;" href="{{ url('/subcat') }}/{{ $item->id }}" class="badge badge-success">update</a>

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
                <h4 class="card-title">Sub Category  Form</h4>
                <p class="card-description">Create New Sub Category </p>
                <form method="POST" action="{{ url('/create_subcat') }}" class="forms-sample">
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
                    <label for="exampleSelectGender" class="col-sm-3"> Choose Category</label>
                    <select name="cat_id" class="form-control" id="exampleInputUsername2">
                        <option value="">--Choose Category First--</option>
                      @foreach ($allcat as $items)
                      <option  value="{{ $items->id }}">{{ $items->cat_name}}</option>
                       @endforeach
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Sub Category</label>
                    <div class="col-sm-9">
                      <input type="text" name="subcat_name" class="form-control" id="exampleInputUsername2" placeholder="Sub Category  Name">
                    </div>
                  </div>

                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Create</button>

                </form>





              </div>
            </div>
          </div>
    </div>


@stop
