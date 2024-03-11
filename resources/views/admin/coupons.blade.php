@extends('layout.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="content topsCategory">
        <div class="row">
            <div class="col-lg-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p><strong>Errors!</strong>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                    </p> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header py-4">
                        <h2 class="w-100 text-center">ALL KITS</h2>
                    </div>
                </div>
            </div>
            <a href="{{route('admin.coupon.add')}}" class="btn btn-primary" style="margin:15px;margin-top:-15px;">Add Coupon</a>
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header p-0">
                    </div>
                    <div class="card-body pt-4">
                        <div class="table-responsive">
                            <table id="basic-data-table" class="table nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @if($coupons)
                                <tbody>
                                    <?php
                                        $statusArr = [0 => '<span class="badge badge-secondary">In-Active</span>',1 => '<span class="badge badge-success">Active</span>']
                                    ?>
                                    @foreach($coupons as $items)
                                    <tr>
                                        <td>{{$items['id']}}</td>
                                        <td>{{$items['code']}}</td>
                                        <td>{{$items['discount']}} %</td>
                                        <td>{!! $statusArr[$items['status']] !!}</td>
                                        <td>{{date("m/d/y g:i A", strtotime($items['created_at'])) }}</td>
                                        <td class="d-flex">
                                            <span class="mb-2 mr-2 badge badge-success">
                                                <!-- <a href="#" data-toggle="modal" data-target="#edit-{{$items['collection_id']}}"><span class="mdi mdi-square-edit-outline"></span></a> -->
                                                <a href="{{route('admin.coupon.edit.view',$items['id'])}}"><span class="mdi mdi-square-edit-outline"></span></a>
                                            </span>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal starts -->


<!-- Delete alert ends -->
@endsection

@section('afterScript')
<script src="{{ asset('admin_assets/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('admin_assets/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#basic-data-table").DataTable({
            dom: '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            order: [[3, 'desc']],
        });
    });
</script>
<script>
    function generateSlug(str){
        str = str.toLowerCase();
        str = str.replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
        return str;
    }
    $(".collection_name").keyup(function(){
        var Text = $(this).val();
        var id = $(this).attr('id').split("-").pop();
        console.log(id);
        $(`#slug-${id}`).val(generateSlug(Text));    
    });

    // $("#submit").click(function(){
    //     var Text = $('#slug').val();
    //     $("#slug").val(generateSlug(Text));   
    //     // alert(generateSlug(Text)) 
    // });
    $(document).on('keydown', 'input[pattern]', function(e) {
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');

        setTimeout(function() {
            var newVal = input.val();
            if (!regex.test(newVal)) {
                input.val(oldVal);
            }
        }, 0);
    });
</script>
@endsection