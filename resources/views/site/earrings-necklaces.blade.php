@extends('layout.site.app')
@section('title', 'Earrings and Necklaces')

@section('content')
<!-- Coins sec -->
<!-- Banner Section -->
<!-- Banner Section -->
<section class="innerbanner">
@if(isset(Auth()->user()->consultant))
<div class="replicated-rep-container">
  <div class="replicated-rep clearfix">
    
    
      
        <img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : 'https://storage.googleapis.com/vw-paparazzi/thumbnails/users/app-487731-v2.png.100x100_q85_crop_upscale.png'}}" class="img-responsive pull-left" alt="">
      
      <div class="pull-left">
        <h3 class="replicated-rep-company-or-name">
          {{Auth()->user()->consultant['name']}}
        </h3>
        
      </div>
      <div class="text-right pull-right">
        <p class="replicated-rep-social-media">
          <br>
          {{Auth()->user()->consultant['phone']}}<br>
          <a href="mailto:{{Auth()->user()->consultant['email']}}">{{Auth()->user()->consultant['email']}}</a><br>
          ID # {{Auth()->user()->consultant['unique_id']}}<br>
        </p>
       

        
      </div>
    
    

    
  </div>

  
</div>
@else
<div class="alert alert-danger " role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <span aria-hidden="true">×</span>
    </button>
    <h2 style="text-align: center; background: none; padding-bottom: 0;">It looks like you haven't selected a Consultant yet!</h2>
<p style="text-align: center;"><span>...were you just wanting to browse or were you looking to shop and pick a Consultant to shop under?</span></p>
    <div class="text-center">
    <button type="button" class="btn btn-pink" data-dismiss="alert">
      <span aria-hidden="true">Just Browsing</span>
    </button>
      <a class="btn btn-pink" href="{{route('consultant')}}">
        Choose a Consultant
      </a>
    </div>
  </div>
@endif
    <div class="inner-image">
        <img src="images/Smiling-Model-Emerald-Jewelry-Earrings-Necklace-Ring.png " class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Earrings and Necklaces</h2>
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
                <h3 class="text-center">Shop / Earrings</h3>
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
