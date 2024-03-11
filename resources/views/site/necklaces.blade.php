@extends('layout.site.app')
@section('title', 'Necklaces')

@section('content')
<!-- Coins sec -->
<!-- Banner Section -->
<!-- Banner Section -->
<section class="innerbanner">
    <div class="inner-image">
        <img src="images/necklace.png " class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Necklaces</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->
<!-- Banner Section -->


<!-- Product Sec -->
<section class="productsec">

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3 class="text-center">Shop / Necklaces</h3>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-image">
                            <a href="{{route('product-detail')}}"><img src="images/product-img.png" alt=""></a>
                            <h4>Turquoise Wire Cross Set</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>$20.00</p>
                                </div>
                                <div class="col-sm-6">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Sec -->
@endsection


@section('afterScript')
@endsection
