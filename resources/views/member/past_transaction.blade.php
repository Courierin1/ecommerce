@extends('layout.member.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
<style>
    #myTable tbody tr td{
        color: #000;
    }
</style>
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h2 class="text-dark">
                     Transactions History
                </h2>

            </div>
            <div class="col-md-12">
                <table id="myTable" class="display cell-border hover">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Order Id</th>
                            <th>Quantity</th>
                            <th>Products</th>
                            <th>Shipping Address</th>
                            <th>Shipping Country</th>
                            <th>Grand Total</th>
                            <th>Action</th>
                             </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($data as $x)
                        <tr>
                             <td>{{$i}}</td>
                            <td>{{ $x->order_id ?? ''}}</td>
                            <td>{{ $x->qty ?? ''}}</td>
                            <td>
                                                              @if(isset($x->name))
                                                              <?php

                                                              $slug = "";

                                                                    if (Auth::user()->role==2) {
                                                                        $slug = isset($x->slug) ? $x->slug : '';
                                                                    }


                                                              ?>
                                  <a href="{{ url('/product-detail')}}/{{ $slug }}">{{$x->name ?? ''}}</a><br>
                               @endif

                            </td>
                            <td>
                                <p>{{ $x->ship_street_1 ?? '' }}</p>
                            </td>
                            <td>
                                <p> {{ $x->bill_country ?? '' }}</p>
                            </td>
                            <td>
                                <p><strong>{{ $x->price ?? '' }}</strong></p>
                            </td>
                            <td class="text-center">
                                <p> <a href="{{route('delete.transaction' , $x->order_id)}}"><i class="fa-solid fa-trash text-danger "></i></a></p>
                            </td>
                        </tr>
                        @php $i++; @endphp

                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script>
   let table = new DataTable('#myTable', {
    responsive: true,

});
</script>
@endsection
