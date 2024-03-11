@extends('layout.site.app')
@section('title', 'Pricing')

@section('content')
<div class="container">
@if(isset(Auth()->user()->consultant))
<div class="replicated-rep-container">
  <div class="replicated-rep clearfix">
    
    
      
  <img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}"
                    class="img-fluid pull-left {{isset(Auth()->user()->consultant['image']) ? '' : 'styling_class' }}" alt="">
      
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
</div>
<!-- Coins sec -->
    <!-- Banner Section -->
    <section class="innerbanner">
        <div class="inner-image">
            <img src="images/6.jpg" class="img-fluid w-100" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="innercaption">
                        <h2>Pricing</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section -->

    <!-- product Category -->
    <section class="categorysec">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="category-heading">
                        <a href="{{route('shop')}}?id={{$category['slug']}}-tab" class="text-white">{{ucfirst($category->name)}}</a>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <!-- product Category -->

    <!-- Pricing Sec -->
    <section class="pricing-sec py-5">
        <div class="container">
            <div class="text-center">
                <h2 class="text-center">CHOOSE YOUR</h2>
                <img src="images/sparkly-text-starter-kit.png" class="img-fluid" alt="">
            </div>
            <div class="row mt-5">
                @foreach($kits as $kit)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="pricing-box text-center">
                        <img src="{{isset($kit->image)? $kit->image : 'images/product-img.png'}}" class="img-fluid" alt="">
                        <h3>${{$kit->sale_price}}</h3>
                        <h5>{{$kit->name}}</h5>
                        <div>{!! $kit->description !!}</div>
                        <a href="{{route('party')}}" class="theme-btn">Buy Now</a>
                    </div>
                </div>
                @endforeach
           
            </div>
        </div>
    </section>
    <!-- Pricing Sec -->
@endsection


@section('afterScript')
@endsection
