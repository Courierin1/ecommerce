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
                        <h2>CATEGORY</h2>
                    </div>
                    <div class="card-body py-4">
                        <p class="pb-4">*This form is to create parent category!</p>
                        <form action="{{route('admin.category.store')}}" method="POSt" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Name" name="category_name" id="category_name" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Slug" name="category_slug" id="category_slug" readonly />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload" name="category_image" />
                                        <p class="pb-4"><strong>*Image size should be 5MB!</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <!-- <textarea type="text" class="form-control" name="category_desc" placeholder="Category Description"></textarea> -->
                                    <div id="short_description"></div>
                                </div>
                            </div>
                            <div class="data-target"></div>
                            <br/>
                            <br/>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary w-100">
                                        ADD CATEGORY
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="content topsCategory">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header mainHeading">
                        <h2>SUB CATEGORY</h2>
                    </div>
                    <div class="card-body py-4">
                        <p class="pb-4">*This form is to create sub category on bases of top level category!</p>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Parent Category</label>
                                <div class="col-sm-10">
                                    <select class="custom-select form-control ml-0 w-100" name="parent_category">
                                        <option value="">- Select Category -</option>
                                        @if($category)
                                        @foreach($category as $item)
                                        <option value="{{$item['category_id']}}">{{$item['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Name" name="sub_category_name" id="sub_category_name" />
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Category Slug" name="sub_category_slug" id="sub_category_slug" readonly />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="sub_category_desc"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload" name="sub_category_image" />
                                        <p class="pb-4"><strong>*Image size should be 5MB!</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary w-100">
                                        ADD SUB CATEGORY
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


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