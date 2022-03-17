
@extends('user.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Paaid due record store </h4>
                <p class="card-description">All Field is <span style="color: red;">required</span>    So Fill up all the field Carefully </p>
                <form method="POST" action="{{ url('purchese/due') }}" class="forms-sample" enctype="multipart/form-data">
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
                <label for="country">Your Payment range up to : {{ $getdue }} Taka</label>
                <input type="hidden" class="form-control"  value="{{ $id }}"  name="agent_id" id="">
            </div>
            <div class="form-group">
            <input type="number" class="form-control"  value="{{ $getdue }}" " min="0" max="{{ $getdue }}" name="paid_amouont" id="">
            </div>
    </div>

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>
              </div>
            </div>
          </div>


    </div>


@stop
