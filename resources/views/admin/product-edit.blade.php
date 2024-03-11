@extends('layout.admin.app')

@section('content')
<style>
    .close:focus {
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
    }

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

    #feature-image {
        display: inline-flex;
        position: inherit;
    }

    .image-remove {
        /* position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100; */
        float: right;
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        /* opacity: .5; */
        position: absolute;
        top: 0px;
        right: 0%;
        padding: 10px;
        margin: 0px;
        z-index: 1;
        cursor: pointer;
    }

</style>
<div class="content-wrapper">
    <div class="content addProduct">
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
                        <h2>Edit PRODUCT {{$product['name']}}</h2>
                    </div>
                    <div class="card-body pt-4">
                        <!-- <p>Here is the list of plugins with the official documentation. We are thankful to each of them.</p> -->
                        <form action="{{route('admin.product.edit',$product['product_id'])}}" method="POSt" enctype="multipart/form-data">
                            {{csrf_field()}}
                            
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product['name']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_slug" name="product_slug" readonly value="{{$product['slug']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product SKU</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_sku" name="product_sku" value="{{$product['sku']}}" disabled/>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Regular Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="regular_price" name="regular_price" pattern="^\d*(\.\d{0,2})?$" value="{{$product['regular_price']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Sale Price</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="sale_price" name="sale_price" pattern="^\d*(\.\d{0,2})?$" value="{{$product['sale_price']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Stock QTY</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="in_stock" name="in_stock" value="{{$product['in_stock']}}" />
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control ml-0 w-100 selectpicker" multiple data-live-search="true" id="product_category" name="product_category[]">
                                        <option value="" disabled>- Select Category -</option>
                                        @if($product['categories'])
                                        @foreach($product['categories'] as $item)
                                        <option value="{{$item['category_id']}}" selected>{{$item['name']}}</option>
                                        @endforeach
                                        <option disabled>──────────</option>
                                        @endif
                                        @if($category)
                                        @foreach($category as $item)
                                            <option value="{{$item['category_id']}}">{{$item['name']}}</option>
                                            @if(isset($item['subcategories']))
                                            @foreach($item['subcategories'] as $subItem)
                                                <option value="{{$subItem['category_id']}}">&nbsp;&nbsp; - {{$subItem['name']}}</option>

                                                @endforeach
                                            @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                           
                            
                            <!-- <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="file-upload" id="product_image" name="product_image" />
                                        <div>
                                            <span><img src="{{($product['image']) ? $product['image'] : asset('admin_assets/assets/img/null_thumbnail.png')}}" class="img-thumbnail" width="300" /></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Image</label>
                                <div class="col-sm-10">
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple="multiple"/>
                                        <span class="text-danger">
                                        {{ $errors->first('gallery_images') }}
                                        </span>
                                        <div id="thumb-output">
                                        @if (isset($product['gallery_images']))
                                        <?php $gallery_images = json_decode($product['gallery_images'], true); ?>
                                        @foreach($gallery_images as $key => $value)
                                        <div id="{{$key}}" onclick="remove({{$key}});">
                                            <span class="image-remove">&times;</span><img class="thumb" src="{{$value}}">
                                            <input type="text" class="form-control" name="old_gallery_images[]" value="{{$value}}" hidden/>
                                        </div>
                                        @endforeach
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Short Description</label>
                                <div class="col-sm-10">
                                    
                                    <div id="short_description">
                                        {!! html_entity_decode($product['short_description']) !!}
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row mt-2">
                                <label for="" class="col-sm-2 col-form-label">Product Long Description</label>
                                <div class="col-sm-10">
                                    
                                    <div id="long_description">
                                        {!! html_entity_decode($product['long_description']) !!}
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="data-target"></div>
                            <div class="form-group row mt-2">
                                @if($product['status'])
                                <div class="col-sm-10">
                                        <label class="col-sm-2 control control-checkbox">Active
                                            <input type="checkbox" checked="checked" name="status" value="1" />
                                            <div class="control-indicator"></div>
                                        </label>
                                </div>
                                
                                @else
                                <div class="col-sm-10">
                                        <label class="col-sm-2 control control-checkbox">In-Active
                                            <input type="checkbox" name="status" value="0" />
                                            <div class="control-indicator"></div>
                                        </label>
                                </div>
                                @endif
                                
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-sm-10 offset-sm-2 text-center">
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
    $("#product_name").keyup(function() {
        var Text = $(this).val();
        $("#product_slug").val(generateSlug(Text));
    });
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
    $("#product_category option").each(function() {
        $(this).siblings('[value="'+ this.value +'"]').remove();
    });

</script>
<script>
$(document).ready(function () {
        var count = 0
        $('#gallery_images').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {

                var data = $(this)[0].files; //this file data
                var oldLength = data.length;
                var newLength = $('#thumb-output > div').length;
                if(newLength > 0){
                    oldLength += newLength;
                    count += newLength;
                }
                if (oldLength <= 5) {
                    // $('#thumb-output').empty();
                    $.each(data, function (index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function (
                                file) { //trigger function on successful read
                                count++;
                                return function (e) {
                                    var img = $('<img/>').addClass('thumb').attr(
                                        'src', e.target.result
                                    ); //create image element
                                    var html = $(
                                        `<div id="${index+newLength}" onclick=remove(${index+newLength});><span class="image-remove">&times;</span>`
                                    ).append(img);
                                    $('#thumb-output').append(
                                        html); //append image to output element
                                };
                            })(file);

                            fRead.readAsDataURL(file); //URL representing the file's data.

                            // console.log(index)
                            // console.log(file)

                        }
                    });
                } else {
                    alert("Limit exceed!")
                }


            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }


        });

    });

    function FileListItems(files) {
        var b = new ClipboardEvent("").clipboardData || new DataTransfer()
        for (var i = 0, len = files.length; i < len; i++) b.items.add(files[i])
        return b.files
    }

    function remove(id) {
        $(`#${id}`).remove();
        var data = $('#gallery_images').prop('files')
        data = Array.from(data)
        var files = data.splice(id, 1)
        $('#gallery_images').prop('files', new FileListItems(data))

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
    let longDescriptionEditor = new Quill('#long_description', quillDefaultOptions);
    $('form').on('submit', function(e) {
        // TODO: Validate User data at the FE as well
        e.preventDefault();
        const postData = {
            short_description: shortDescriptionEditor.root.innerHTML,
            long_description: longDescriptionEditor.root.innerHTML,
            
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