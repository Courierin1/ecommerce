@extends('layout.admin.app')

@section('content')
<!-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> -->
<style>
    /* .close:focus {
        outline: none;
    }

    .close {
        position: absolute;
        top: 5px;
        right: 0%;
        padding: 15px;
        margin: 0px;
        z-index: 1;
    }

    .close span {
        float: right;
        margin: 15px;
    } */

    img.thumb {
        width: 200px;
        padding: 10px;
        object-fit: contain;
    }

    #thumb-output {
        display: inline-flex;
    }

    #thumb-output div {
        position: relative;
    }

 

    .image-remove {
        /* position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100; */
        float: left;
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        /* opacity: .5; */
        position: absolute;
        top: 0px;
        left: 0px;
        padding: 10px;
        margin: 0px;
        z-index: 1;
        cursor: pointer;
    }

</style>
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
                        <h2>Edit {{$category['name']}} details:</h2>
                    </div>
                    <div class="card-body py-4">
                        <!-- <p class="pb-4">*This form is to create parent category!</p> -->
                        <form action="{{route('admin.category.edit',$category['category_id'])}}" method="POSt" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Name" name="category_name" id="category_name" value="{{$category['name']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Slug" name="category_slug" id="category_slug" value="{{$category['slug']}}" readonly />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload" name="category_image" />
                                        <p class="pb-4"><strong>*Image size should be 5MB!</strong></p>
                                        <div id="thumb-output">
                                            <div onclick="remove();">
                                                <span class="image-remove">&times;</span>
                                                <img src="{{($category['image']) ? $category['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="thumb" width="300" />
                                                <input type="text" class="form-control" name="old_category_image" value="{{$category['image']}}" hidden/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <!-- <textarea type="text" class="form-control" name="category_desc" placeholder="Category Description"></textarea> -->
                                    <div id="short_description">{!! html_entity_decode($category['description']) !!}</div>
                                </div>
                            </div>
                            <div class="data-target"></div>
                            <br/>
                            <br/>
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
                                {!! $statusChkArr[$category['status']] !!}
                                
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary w-100">
                                    UPDATE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection

@section('afterScript')
<script>
    function generateSlug(str) {
        str = str.toLowerCase();
        str = str.replace(/ /g, '-').replace(/[-]+/g, '-').replace(/[^\w-]+/g, '');
        return str;
    }
    $("#category_name").keyup(function() {
        var Text = $(this).val();
        $("#category_slug").val(generateSlug(Text));
    });
    $("#sub_category_name").keyup(function() {
        var Text = $(this).val();
        $("#sub_category_slug").val(generateSlug(Text));
    });
    // $("#submit").click(function(){
    //     var Text = $('#slug').val();
    //     $("#slug").val(generateSlug(Text));   
    //     // alert(generateSlug(Text)) 
    // });
    function remove() {
        $('#thumb-output').remove();


    };
</script>
<script>
     var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];
     const quillDefaultOptions = {
        theme: "snow",
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Compose an epic...',
        formats: [
            'background',
            'bold',
            'color',
            'font',
            'code',
            'italic',
            'link',
            'size',
            'strike',
            'script',
            'underline',
            'blockquote',
            'header',
            'indent',
            'list',
            'align',
            'direction',
            'code-block',
            'formula'
        ],

    }
    let shortDescriptionEditor = new Quill('#short_description', quillDefaultOptions);
    
    $('form').on('submit', function(e) {
        // TODO: Validate User data at the FE as well
        e.preventDefault();
        const postData = {
            category_desc: shortDescriptionEditor.root.innerHTML,
            
            
        }
        for (let key in postData) {
            $('.data-target').append(`<input name="${key}" type="hidden" class="d-none" />`)
            $(`input[name=${key}]`).val(postData[key])
        }
        $('form').unbind('submit');
        $('form').submit();
    })
</script>


@endsection