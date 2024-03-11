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
                        <h2 class="w-100 text-center">ALL PRODUCTS</h2>
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
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Regular Price</th>
                                        <th>Sale Price</th>
                                        <th>In-Stock</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @if($product)
                                <tbody>
                                    <?php
                                        $statusArr = [0 => '<span class="badge badge-secondary">In-Active</span>',1 => '<span class="badge badge-success">Active</span>']
                                    ?>
                                    @foreach($product as $items)
                                    <tr>
                                        <td>{{$items['product_id']}}</td>
                                        <td>{{$items['name']}}</td>
                                        <td>{{$items['regular_price']}} $</td>
                                        <td>{{$items['sale_price']}} $</td>
                                        <td>{{$items['in_stock']}}</td>
                                        <td>{!! $statusArr[$items['status']] !!}</td>
                                        <td>{{date("m/d/y g:i A", strtotime($items['created_at'])) }}</td>
                                        <td class="d-flex">
                                            <span class="mb-2 mr-2 badge badge-primary">
                                                <a href="#" data-toggle="modal" data-target="#view-{{$items['product_id']}}"><span class="mdi mdi-eye"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-success">
                                                <a href="{{route('admin.product.show',$items['product_id'])}}"><span class="mdi mdi-square-edit-outline"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-danger">
                                                <a href="#" data-toggle="modal" data-target="#delete-{{$items['product_id']}}"><span class="mdi mdi-trash-can-outline"></span></a>
                                            </span>
                                        </td>
                                        <!-- view model -->
                                        <div class="modal fade" id="view-{{$items['product_id']}}" tabindex="-1" role="dialog" aria-labelledby="view-{{$items['product_id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <!-- <h5 class="modal-" id="view-{{$items['product_id']}}">
                                                            Modal Title
                                                        </h5> -->
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-default">
                                                            <div class="card-header card-header-border-bottom">
                                                                <h2>{{$items['name']}} - {{$items['product_id']}}#:</h2>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <ul class="list-group">
                                                                        <!-- <li class="list-group-item text-dark">Product ID<span style="float: right;">{{$items['product_id']}}</span></li> -->
                                                                        <li class="list-group-item text-dark">Product Name<span style="float: right;">{{$items['name']}}</span></li>
                                                                        <li class="list-group-item text-dark">Product Category<span style="float: right;">{{$items['categories'] ? $items['categories'][0]['name'] : "n/a"}}</span></li>
                                                                        <li class="list-group-item text-dark">Slug<span style="float: right;">{{$items['slug']}}</span></li>
                                                                        <li class="list-group-item text-dark">SKU<span style="float: right;">{{$items['sku']}}</span></li>
                                                                        <li class="list-group-item text-dark">Regular Price<span style="float: right;">$ {{$items['regular_price']}}</span></li>
                                                                        <li class="list-group-item text-dark">Sale Price<span style="float: right;">$ {{$items['sale_price']}}</span></li>
                                                                        <li class="list-group-item text-dark">In-Stock<span style="float: right;">{{$items['in_stock']}}</span></li>
                                                                        <li class="list-group-item text-dark">Short Description<span style="float: right;">{!! $items['short_description'] !!}</span></li>
                                                                        <li class="list-group-item text-dark">Long Description<span style="float: right;">{!! $items['long_description'] !!}</span></li>
                                                                        
                                                                        
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item text-dark">Feature Image<span style="float: right;"><img src="{{($items['image']) ? $items['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span></li>
                                                                        <li class="list-group-item text-dark">Gallary Images
                                                                            @if(isset($items['gallery_images']))
                                                                            @foreach(json_decode($items['gallery_images']) as $images)
                                                                            <span style="float: right;">
                                                                                <img src="{{($images) ? $images:asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" />
                                                                            </span>
                                                                            @endforeach
                                                                            @endif
                                                                        </li>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete -->
                                        <div class="modal fade alignButtons" id="delete-{{$items['product_id']}}" tabindex="-1" role="dialog" aria-labelledby="delete-{{$items['product_id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-{{$items['product_id']}}"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3 class="text-center">ARE YOU SURE YOU WANT TO DELTE IT?</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">
                                                            NO
                                                        </button>
                                                        <a href="{{route('admin.product.remove',$items['product_id'])}}" type="button" class="btn btn-primary btn-pill">
                                                            YES
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
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

<!-- <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormTitle">
                    Modal Title
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                    </div>
                    <div class="form-check pl-0">
                        <label class="control control-checkbox">Check me out
                            <input type="checkbox" checked="checked" />
                            <div class="control-indicator"></div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary btn-pill">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Ends -->

<!-- UPDATE MODAL STARTS  -->

<!-- <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormTitle">
                    Modal Title
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                    </div>
                    <div class="form-check pl-0">
                        <label class="control control-checkbox">Check me out
                            <input type="checkbox" checked="checked" />
                            <div class="control-indicator"></div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary btn-pill">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div> -->

<!-- UPDATE MODAL ENDS  -->

<!-- Delete alert starts -->

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
                <h3 class="text-center">ARE YOU SURE YOU WANT TO DELTE IT?</h3>
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
            order: [[6, 'desc']],
        });
    });
</script>

@endsection