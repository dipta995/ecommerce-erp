@extends('user.master')
@section('content')
<div class="content-wrapper">


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Prodcuct Table</h4>
                <p class="card-description">Your Created Products</p>
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
                        <th>Name </th>
                        <th>Email </th>


                      </tr>
                    </thead>
                    <tbody>
 
                        @foreach ($allcustomer as $i => $item)
 

                      <tr>
                          <td>{{ $i+1 }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>




                      </tr>


                        @endforeach
                        {{ $allcustomer->links('pagination.custom') }}

                    </tbody>
                  </table>

              </div>
            </div>
          </div>

    </div>


@stop
