@extends('layout.site.app')
@section('title', 'Product Detail')

@section('content')

<link href="{{asset('css/smoothproducts.css')}}" rel="stylesheet" type="text/css">
<!-- Coins sec -->
<!-- Banner Section -->
<!-- Banner Section -->
<section class="innerbanner">
@if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
    <div class="inner-image">
        <img src="/images/jwelleryforparty.png" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Product Detail</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->
<!-- Banner Section -->


<!-- Product Sec -->
<section class="detail-sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-6">
                <!-- <div class="main-slide-chk">
                        <div class="slider slider-for">
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/product-detail.jpg') }}"></div>
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/product-detail.jpg') }}"></div>
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/pro-1.jpg') }}"></div>
                        </div>

                    </div>
                    <div class="product-list">
                        <div class="col-md-6 no-margin">
                            <div class="slider slider-nav">
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/product-detail.jpg') }}"></div>
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/product-detail.jpg') }}"></div>
                                <div><img alt="" class="img-fluid" src="{{ asset ('images/pro-1.jpg') }}"></div>
                            </div>
                        </div>
                    </div> -->
                <div class="sp-loading"><img src="{{asset('images/sp-loading.gif')}}" alt=""><br>LOADING IMAGES</div>
                <div class="sp-wrap">

                    @foreach(json_decode($product->gallery_images,true) as $image)
                    @php $count=1; @endphp
                    @foreach(json_decode($product->gallery_images,true) as $image)
                    @if($count!=1)
                    <a href="{{$image}}"><img src="{{$image}}" alt=""></a>
                    <!-- <a href="{{asset('images/64207_completelook_1.jpg.960x960_q85.jpg')}}"><img src="{{asset('images/64207_completelook_1.jpg.960x960_q85.jpg')}}" alt=""></a> -->
                    @endif
                        @php $count++ @endphp
                        @endforeach


                    @endforeach
                </div>
            </div>
            <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="custom_detail">
                    <h2>{{$product->name}}</h2>

                    <br>
                    @if(isset($product->short_description)  && strip_tags($product->short_description) != ''|| isset($product->long_description) && strip_tags($product->long_description) != '')
                    <h4 style="color: #06255d;">Product Description</h4>
                    @endif

                    @if(isset($product->short_description) && strip_tags($product->short_description) != '')
                    {!! $product->short_description !!}
                    @endif
                    <br>
                    @if(isset($product->long_description) && strip_tags($product->long_description) != '')
                    {!! $product->long_description !!}
                    @endif
                    <br>
                    <h5><span style="color: #06255d;">SKU #</span> {{$product->sku}}</h5>
                    <br>
                    <div class="box-labels">
                    </div>
                    <h3><del></del>${{$product->sale_price}}</h3>
                    <div class="box-labels">
                        <!-- <ul class="color-variant p-0">
                                <li class="bg-light0"></li>
                                <li class="bg-light1"></li>
                                <li class="bg-light2"></li>
                            </ul> -->
                    </div>
                    <div class="product-count">
                        <label for="size">Quantity</label>
                        <form action="#" class="d-flex">
                            <div class="qtyminus">-</div>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{$product->in_stock}}" class="qty" disabled>
                            <div class="qtyplus">+</div>
                        </form>
                        <div class="mt-4">
                            <a href="javascript:addToCart({{$product->product_id}}); " class="btn third ml-0 theme-btn">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cart_sec">

</section>
<!-- Product Sec -->
@endsection


@section('afterScript')
<script src="{{asset('js/smoothproducts.min.js')}}"></script>
<script type="text/javascript">
    /* wait for images to load */
    $(window).load(function () {
        $('.sp-wrap').smoothproducts();
    });

    function addToCart(id){
         @if(Auth::check() && Auth()->user()->consultant_id ==null)
            errortoast('Please Become Consultant To Use This Feature!');

        @elseif(!Auth::check())
            window.location = '/signup-options'
        // errortoast("Login To add to cart");
            @else
        var qty=$("#quantity").val();

        $.ajax({
            url: "{{ route('add.to.cart') }}",
            method: "POST",
            data: {
                id: id,
                qty: qty,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#cart-quantity').text(data.quantity);
                    successtoast(data.message);

                }
                else if (data.status == 2) {
                    errortoast(data.message);

                }
                else if(data.status == 3) {
                    $(".cart_sec").html(data.view);
                    $('.cart').toggleClass('is-hidden');
                }
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
        @endif
    }

    function decreaseCount(id){

var count=$("#"+id).val();
if(count == 1){

    errortoast('Can not be zero!');
}
else{
$.ajax({
        url: "{{ route('minus.quantity') }}",
        method: "GET",
        data: {
           id:id,
        },
        success: function (data) {
            if (data.status == 1) {
                $(".cart__section--inner").html(data.view);


            } else {
                errortoast('something went wrong');
            }
        },
        error: function (error) {
            errortoast('something went wrong');

        }
    });
}

}

function increaseCount(id){

$.ajax({
        url: "{{ route('plus.quantity') }}",
        method: "GET",
        data: {
            id:id,
        },
        success: function (data) {
            if (data.status == 1) {
                $(".cart__section--inner").html(data.view);


            }
            else if (data.status == 2){
                successtoast(data.message);
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
