@extends('user.master')
@section('content')
<div class="content-wrapper">







    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Already Added Stock</h4>

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

<p>
    @foreach ($agents as $item)

    <a class="btn btn-primary mr-2" href="{{ url('/purchase/stock/already/'.$item->id) }}">{{ $item->agent_name }}</a>
    @endforeach
</p>
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
                        <th>Add to stock</th>
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
                            {{ $item->updated_at }}
                        </td>
                      </tr>


                        @endforeach

                    </tbody>
                  </table>

              </div>
            </div>
          </div>




              </div>
            </div>
          </div>
    </div>


@stop
