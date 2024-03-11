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
                        <h2 class="w-100 text-center">ALL CATEGORIES</h2>
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
                                        <th>Category Name</th>
                                        <th>Parent</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @if($category)
                                <tbody>
                                    <?php
                                        $statusArr = [0 => '<span class="badge badge-secondary">In-Active</span>',1 => '<span class="badge badge-success">Active</span>']
                                    ?>
                                    @foreach($category as $items)
                                    <tr>
                                        <td>{{$items['category_id']}}</td>
                                        <td>{{$items['name']}}</td>
                                        <td>{{($items['parent_category']) ? $items['parent_category']['name'] : "n/a"}}</td>
                                        <td>{!! $statusArr[$items['status']] !!}</td>
                                        <td>{{date("m/d/y g:i A", strtotime($items['created_at'])) }}</td>
                                        <td class="d-flex">
                                            <span class="mb-2 mr-2 badge badge-primary">
                                                <a href="#" data-toggle="modal" data-target="#view-{{$items['category_id']}}"><span class="mdi mdi-eye"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-success">
                                                <!-- <a href="#" data-toggle="modal" data-target="#edit-{{$items['category_id']}}"><span class="mdi mdi-square-edit-outline"></span></a> -->
                                                <a href="{{route('admin.category.edit.view', $items['category_id'])}}"><span class="mdi mdi-square-edit-outline"></span></a>
                                            </span>
                                            <span class="mb-2 mr-2 badge badge-danger">
                                                <a href="#" data-toggle="modal" data-target="#delete-{{$items['category_id']}}"><span class="mdi mdi-trash-can-outline"></span></a>
                                            </span>
                                        </td>
                                        <!-- view model -->
                                        <div class="modal fade" id="view-{{$items['category_id']}}" tabindex="-1" role="dialog" aria-labelledby="view-{{$items['category_id']}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- <h5 class="modal-" id="view-{{$items['category_id']}}">
                                                            Modal Title
                                                        </h5> -->
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
                                                                <li class="list-group-item text-dark">Category ID<span style="float: right;">{{$items['category_id']}}</span></li>
                                                                <li class="list-group-item text-dark">Category Name<span style="float: right;">{{$items['name']}}</span></li>
                                                                <li class="list-group-item text-dark">Parent<span style="float: right;">{{($items['parent_category'])?$items['parent_category']['name']: "n/a"}}</span></li>
                                                                <li class="list-group-item text-dark">Slug<span style="float: right;">{{$items['slug']}}</span></li>
                                                                <li class="list-group-item text-dark">Description<span style="float: right;">{!! $items['description'] !!}</span></li>
                                                                <li class="list-group-item text-dark">Image<span style="float: right;"><img src="{{($items['image']) ? $items['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- edit model -->
                                        <!-- <div class="modal fade" id="edit-{{$items['category_id']}}" tabindex="-1" role="dialog" aria-labelledby="edit-{{$items['category_id']}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-{{$items['category_id']}}">
                                                            Edit {{$items['name']}} details:
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('admin.category.edit',$items['category_id'])}}" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                               
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Name</label>
                                                                <input type="text" class="form-control category_name" placeholder="Category Name" name="category_name" id="category_name-{{$items['category_id']}}" value="{{$items['name']}}" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Slug</label>
                                                                <input type="text" class="form-control" placeholder="Category Slug" name="category_slug" id="category_slug-{{$items['category_id']}}" value="{{$items['slug']}}" readonly />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Description</label>
                                                                <textarea type="text"  class="form-control"  name="category_desc" >{{$items['description']}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Upload Image</label>
                                                                <div class="file-upload-wrapper">
                                                                    <input type="file" class="file-upload" name="category_image" />
                                                                    <span><img src="{{($items['image']) ? $items['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-check pl-0">
                                                                <?php
                                                                    $statusChkArr = [0 => '
                                                                        <label class="control control-checkbox">In-Active
                                                                            <input type="checkbox" name="status" />
                                                                            <div class="control-indicator"></div>
                                                                        </label>
                                                                    ',1 => '
                                                                        <label class="control control-checkbox">Active
                                                                            <input type="checkbox" checked="checked" name="status" />
                                                                            <div class="control-indicator"></div>
                                                                        </label>
                                                                    ']
                                                                ?>
                                                                {!! $statusChkArr[$items['status']] !!}
                                                                
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-pill float-right">UPDATE</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- delete -->
                                        <div class="modal fade alignButtons" id="delete-{{$items['category_id']}}" tabindex="-1" role="dialog" aria-labelledby="delete-{{$items['category_id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-{{$items['category_id']}}"></h5>
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
                                                        <a href="{{route('admin.category.remove',$items['category_id'])}}" type="button" class="btn btn-primary btn-pill">
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

@endsection

@section('afterScript')
<script src="{{ asset('admin_assets/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('admin_assets/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#basic-data-table").DataTable({
            dom: '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
            order: [[4, 'desc']],
        });
    });
</script>
<script>
    function generateSlug(str){
        str = str.toLowerCase();
        str = str.replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
        return str;
    }
    $(".category_name").keyup(function(){
        var Text = $(this).val();
        var id = $(this).attr('id').split("-").pop();
        $(`#category_slug-${id}`).val(generateSlug(Text));    
    });

    // $(".collection_name").keyup(function(){
    //     var Text = $(this).val();
    //     var id = $(this).attr('id').split("-").pop();
    //     console.log(id);
    //     $(`#slug-${id}`).val(generateSlug(Text));    
    // });
    $(".custom-select option").each(function() {
        $(this).siblings('[value="'+ this.value +'"]').remove();
    });

</script>
@endsection