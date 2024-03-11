@extends('layout.admin.app')
@section('content')
<div class="content-wrapper">
    <div class="content topsCategory">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header mainHeading">
                        <h2>ORDER DETAILS</h2>
                    </div>
                    <!-- <div class="card-body pt-4">
                  <p>Sleek Dashboard is a fully featured admin template and UI kit built on top of awesome Bootstrap 4. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content managements systems and CRMs. It is fully responsive and
                  customizable. Its UI elements can be used very easily on any page. We are very excited to share this dashboard with you and we look forward to hearing your feedback!</p>
                </div> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header p-2">
                        <h2 class="w-100 text-center">ALL RECORDS</h2>
                    </div>
                    <div class="card-body p-2">
                        <p class="text-center">This will be use for slug</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header p-0">
                        <!-- <h2>Credits / Plugins</h2> -->
                    </div>
                    <div class="card-body pt-4">
                    <!-- <p>Here is the list of plugins with the official documentation. We are thankful to each of them.</p> -->
                        <div class="table-responsive">
                            <table id="basic-data-table" class="table nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Order NO</th>
                                        <th>Total</th>
                                        <th>Admin Profit</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->order_id}}</td>
                                        <td>
                                                            ${{$order->grand_total}}

                                                        </td>
                                                        <td>
                                                            ${{$order->admin_profit ?? 0.00}}

                                                        </td>
                                        <td>{{date('d/m/Y',strtotime($order->created_at))}}</td>
                                        <td class="d-flex">
                                        <select name="order_status" 
                                            onchange="dispatch(this,'{{$order->order_id}}')"
                                            class="bss_select form-control" style="width: 150px !important" required>
                                            <option value="0" {{ $order->status=='0' ? 'selected' : ''}}>Pending</option>
                                            <option value="1" {{ $order->status=='1' ? 'selected' : ''}}>Dispatched</option>
                                        </select>
                                        </td>
                                        <td>
                                            <span class="mb-2 mr-2 badge badge-primary">
                                                <a href="{{route('order.details',$order->order_id)}}" target="_blank">Preview</a>
                                            </span>
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

@endsection

@section('afterScript')
<script src="{{ asset('admin_assets/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('admin_assets/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#basic-data-table").DataTable({
            sorting: false,
            dom: '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
        });
    });

    function dispatch(item,id){
        let order_status = $('select[name="order_status"]').val();
        $.ajax({
            url: "{{ route('order.dispatch') }}",
            method: "GET",
            data: {
                id: id,
                order_status: order_status,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                  
                  successtoast('success!');
                   
                } 
                
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });

    }

</script>
@endsection