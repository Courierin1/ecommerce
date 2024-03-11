@extends('layout.admin.app')


@section('content')
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
                        <h2>Edit {{$collection['name']}} details:</h2>
                    </div>
                    <div class="card-body py-4">
                        <form action="{{route('admin.collection.edit',$collection['collection_id'])}}" method="POSt" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Kit Name" value="{{$collection['name']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="slug" id="slug" readonly placeholder="Kit Slug" value="{{$collection['slug']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Regular Price $</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="regular_price" name="regular_price" pattern="^\d*(\.\d{0,2})?$" placeholder="0.00" value="{{$collection['regular_price']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Sale Price $</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="sale_price" name="sale_price" pattern="^\d*(\.\d{0,2})?$" placeholder="0.00" value="{{$collection['sale_price']}}" />
                                    <p class="pb-4"><strong>*If you don't want to apply discount use the regular price!</strong></p>

                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Upload Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload" name="image" />
                                        <p class="pb-4"><strong>*Image size should be 5MB!</strong></p>
                                        <div id="thumb-output">
                                            <div onclick="remove();">
                                                <span class="image-remove">&times;</span>
                                                <img src="{{($collection['image']) ? $collection['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="thumb" width="300" />
                                                <input type="text" class="form-control" name="old_image" value="{{$collection['image']}}" hidden/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                <!-- <textarea type="text"  class="form-control"  name="desc"  placeholder=" Kit Description"></textarea> -->
                                    <div id="short_description">{!! html_entity_decode($collection['description']) !!}</div>
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
                                {!! $statusChkArr[$collection['status']] !!}

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
    function generateSlug(str){
        str = str.toLowerCase();
        str = str.replace(/ /g,'-').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
        return str;
    }
    $("#name").keyup(function(){
        var Text = $(this).val();
        $("#slug").val(generateSlug(Text));
    });
    $("#regular_price").keyup(function(){
        var Text = $(this).val();
        $("#sale_price").val(Text);
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

        [{ 'color': ['#6d0018','#f6931e','#263238'] }, { 'background': [] }],          // dropdown with defaults from theme
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
            desc: shortDescriptionEditor.root.innerHTML,


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
