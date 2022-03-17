@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Unite Table</h4>
                <p class="card-description">Your Created Unit</p>
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
                        <th>Unit Name</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0;
                    @endphp
                        @foreach ($allunit as $item)
                        @php
                        $i++;
                    @endphp
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->unit_name }}</td>

                        <td>

                        <form action="{{ url('/delunit') }}" method="POST">
                        @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id" >

                            <button style="padding: 5px; border:1px solid red; margin-bottom:3px;" class="badge badge-danger">Delete</button>
                        </form>
                        <a style="padding: 5px;" href="{{ url('/cat') }}/{{ $item->id }}" class="badge badge-success">update</a>

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
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="card-title">Unit  Form</h4>
                        <p class="card-description">Update unit name </p>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('/unit') }}" class="btn btn-success">Create New</a>
                    </div>
                </div>






                <form method="POST" action="{{ url('/up_unit') }}" class="forms-sample">
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
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Unit  Name</label>
                    <div class="col-sm-9">
                      <input type="text" value="{{ $unitbyid->unit_name }}" name="unit_name" class="form-control" id="exampleInputUsername2" placeholder="Ener Unit name">
                        <input type="hidden" value="{{ $unitbyid->id }}" name="id" >
                    </div>
                  </div>
                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Update</button>

                </form>


              </div>
            </div>
          </div>
    </div>


@stop
