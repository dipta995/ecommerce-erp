@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Guest Pay  Form</h4>
                <p class="card-description"></p>



                <form method="POST" action="{{ url('/pay_due') }}" class="forms-sample">
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
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Payment Amount</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="phone_no" value="{{ $phone }}">
                        <input type="hidden" name="due" value="{{ $due }}">
                      <input type="number" name="paid" value="{{ $due }}" max="{{ $due }}" min="1" step=".01" class="form-control" id="exampleInputUsername2" placeholder="Category  Name">
                    </div>
                  </div>
                  <button type="submit" name="createcat" class="btn btn-primary mr-2">Pay</button>

                </form>





              </div>
            </div>
          </div>
    </div>


@stop
