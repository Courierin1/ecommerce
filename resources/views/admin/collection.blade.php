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
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @if($collection)
                                <tbody>
                                    <?php
                                        $statusArr = [0 => '<span class="badge badge-secondary">In-Active</span>',1 => '<span class="badge badge-success">Active</span>']
                                    ?>
                                    @foreach($collection as $items)
                                    <tr>
                                        <td>{{$items['collection_id']}}</td>
                                        <td>{{$items['name']}}</td>
                                        <td>{!! $statusArr[$items['status']] !!}</td>
                                        <td>{{date("m/d/y g:i A", strtotime($items['created_at'])) }}</td>
                                        <td class="d-flex">
                                            <span class="mb-2 mr-2 badge badge-primary">
                                                <a href="#" data-toggle="modal" data-target="#view-{{$items['collection_id']}}"><span class="mdi mdi-eye"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-success">
                                                <!-- <a href="#" data-toggle="modal" data-target="#edit-{{$items['collection_id']}}"><span class="mdi mdi-square-edit-outline"></span></a> -->
                                                <a href="{{route('admin.collection.edit.view',$items['collection_id'])}}"><span class="mdi mdi-square-edit-outline"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-danger">
                                                <a href="#" data-toggle="modal" data-target="#delete-{{$items['collection_id']}}"><span class="mdi mdi-trash-can-outline"></span></a>
                                            </span>
                                        </td>
                                        <!-- view model -->
                                        <div class="modal fade" id="view-{{$items['collection_id']}}" tabindex="-1" role="dialog" aria-labelledby="view-{{$items['collection_id']}}" aria-hidden="true">
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
                                                                <h2>{{$items['name']}}</h2>
                                                            </div>
                                                            <ul class="list-group">
                                                                <li class="list-group-item text-dark">ID<span style="float: right;">{{$items['collection_id']}}</span></li>
                                                                <li class="list-group-item text-dark">Name<span style="float: right;">{{$items['name']}}</span></li>
                                                                <li class="list-group-item text-dark">Slug<span style="float: right;">{{$items['slug']}}</span></li>
                                                                <li class="list-group-item text-dark">Price<span style="float: right;">{{$items['regular_price']}}$</span></li>
                                                                <li class="list-group-item text-dark">Sale Price<span style="float: right;">{{$items['sale_price']}}$</span></li>
                                                                <li class="list-group-item text-dark">Description<span style="float: right;">{!! $items['description'] !!}</span></li>
                                                                <li class="list-group-item text-dark">Image<span style="float: right;"><img src="{{($items['image']) ? $items['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- edit model -->
                                        <!-- <div class="modal fade" id="edit-{{$items['collection_id']}}" tabindex="-1" role="dialog" aria-labelledby="edit-{{$items['collection_id']}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-{{$items['collection_id']}}">
                                                            Edit {{$items['name']}} details:
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('admin.collection.edit',$items['collection_id'])}}" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input type="text" class="form-control collection_name" placeholder="" name="name" id="name-{{$items['collection_id']}}" value="{{$items['name']}}" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Slug</label>
                                                                <input type="text" class="form-control collection_slug" placeholder="Slug" name="slug" id="slug-{{$items['collection_id']}}" readonly value="{{$items['slug']}}"  />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Description</label>
                                                                <textarea type="text"  class="form-control"  name="desc" >{{$items['description']}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="">Regular Price</label>
                                                                <input class="form-control" id="" name="regular_price" pattern="^\d*(\.\d{0,2})?$" placeholder="0.00" value="{{$items['regular_price']}}"/>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="">Sale Price</label>
                                                                <input class="form-control" id="" name="sale_price" pattern="^\d*(\.\d{0,2})?$" placeholder="0.00" value="{{$items['sale_price']}}"/>
                                                                
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Upload Image</label>
                                                                <div class="file-upload-wrapper">
                                                                    <input type="file" class="file-upload" name="image" />
                                                                    <span><img src="{{($items['image']) ? $items['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-check pl-0">
                                                                @if($items['status'])
                                                                    <label class="control control-checkbox">Active
                                                                        <input type="checkbox" checked="checked" name="status" />
                                                                        <div class="control-indicator"></div>
                                                                    </label>
                                                                @else
                                                                    <label class="control control-checkbox">In-Active
                                                                        <input type="checkbox" name="status" />
                                                                        <div class="control-indicator"></div>
                                                                    </label>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-pill float-right">UPDATE</button>
                                                        </form>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div> -->
                                         <!-- delete -->
                                         <div class="modal fade alignButtons" id="delete-{{$items['collection_id']}}" tabindex="-1" role="dialog" aria-labelledby="delete-{{$items['collection_id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-{{$items['collection_id']}}"></h5>
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
                                                        <a href="{{route('admin.collection.remove',$items['collection_id'])}}" type="button" class="btn btn-primary btn-pill">
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