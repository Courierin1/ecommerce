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
                    <div class="card-header mainHeading">
                        <h2>USER ACCOUNT DETAILS</h2>
                    </div>
                    <!-- <div class="card-body pt-4">
                  <p>Sleek Dashboard is a fully featured admin template and UI kit built on top of awesome Bootstrap 4. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content managements systems and CRMs. It is fully responsive and
                  customizable. Its UI elements can be used very easily on any page. We are very excited to share this dashboard with you and we look forward to hearing your feedback!</p>
                </div> -->
                </div>
            </div>
            
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
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Consultant</th>
                                        <th>Create At</th>
                                        <th>More Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if($users)
                                <tbody>
                                    @foreach($users as $user)
                                    <?php
                                        $statusArr = [0 => '<span class="badge badge-secondary">In-Active</span>',1 => '<span class="badge badge-success">Active</span>']
                                    ?>
                                    <tr>
                                        <td>{{$user['unique_id']}}</td>
                                        <td>{{$user['user_name']}}</td>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{$user['phone']}}</td>
                                        <td>{!! $statusArr[$user['status']] !!}</td>
                                        <td>{{isset($user['consultant']) ? $user['consultant']['unique_id']:'N/A'}}</td>
                                        <td>{{date("m/d/y g:i A", strtotime($user['created_at'])) }}</td>
                                        <td>
                                            <span class="mb-2 mr-2 badge badge-primary  ">
                                                <a href="#" data-toggle="modal" class="text-white" data-target="#view-{{$user['id']}}"><span class="mdi mdi-eye"></span></a>
                                            </span>
                                            <!-- view model -->
                                            <div class="modal fade" id="view-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="view-{{$user['id']}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card card-default">
                                                                <div class="card-header card-header-border-bottom">
                                                                    <h2>Biling Details | {{$user['user_name']}}</h2>
                                                                </div>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item text-dark">Country<span style="float: right;">{{($user['country']) ? $user['country']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">State<span style="float: right;">{{($user['state']) ? $user['state']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Zip<span style="float: right;">{{($user['zip']) ? $user['zip']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">City<span style="float: right;">{{($user['city']) ? $user['city']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Address<span style="float: right;">{{($user['address']) ? $user['address']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Another Address<span style="float: right;">{{($user['alt_address']) ? $user['alt_address']:'N/A'}}</span></li>
                                                                 
                                                                </ul>
                                                                @if(isset($user['consultant']))
                                                                <hr/>
                                                                <div class="card-header card-header-border-bottom">
                                                                    <h2>Consultant Of | {{$user['user_name']}}</h2>
                                                                </div>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item text-dark">Rep<span style="float: right;">{{($user['consultant']['country']) ? $user['consultant']['country']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">User Name<span style="float: right;">{{($user['consultant']['country']) ? $user['consultant']['country']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Full Name<span style="float: right;">{{($user['consultant']['state']) ? $user['consultant']['state']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Zip<span style="float: right;">{{($user['consultant']['zip']) ? $user['consultant']['zip']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">City<span style="float: right;">{{($user['consultant']['city']) ? $user['consultant']['city']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Address<span style="float: right;">{{($user['consultant']['address']) ? $user['consultant']['address']:'N/A'}}</span></li>
                                                                    <li class="list-group-item text-dark">Another Address<span style="float: right;">{{($user['consultant']['alt_address']) ? $user['consultant']['alt_address']:'N/A'}}</span></li>
                                                                 
                                                                </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            @if($user['status'])
                                            <span class="mb-2 mr-2 badge badge-danger">
                                                <a href="{{route('admin.customer.confirmed',$user['id'])}}">Suspend</a>
                                            </span>
                                            @else
                                            <span class="mb-2 mr-2 badge badge-success">
                                                <a href="{{route('admin.customer.confirmed',$user['id'])}}">Active</a>
                                            </span>
                                            @endif
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



<div class="modal fade alignButtons" id="deletepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalSmallTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalSmallTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">
                    ARE YOU SURE YOU WANT TO SUSPEND THIS ACCOUNT?
                </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">
                    NO
                </button>
                <button type="button" class="btn btn-primary btn-pill">
                    YES
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete alert ends -->
@endsection

@section('afterScript')
<script src="{{ asset('admin_assets/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('admin_assets/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#basic-data-table").DataTable({
            dom: '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
        });
    });
</script>
@endsection