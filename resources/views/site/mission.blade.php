@extends('layout.site.app')

<style>

/* .mission-text {
    background-color: #000000e8;
    box-shadow: -1px 1px 10px #f6931e;
    padding: 40px 40px;
    margin-bottom: 30px;
    height: 250px;
} */
section.innerbanner .container {
    position: static !important;
}
</style>


@section('title', 'Mission')

@section('content')
<style>
    .mission-text p{
        font-size: 20px !important
    }
</style>
<!-- Coins sec -->
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    @if(isset(Auth()->user()->consultant))
    <div class="replicated-rep-container">
        <div class="replicated-rep clearfix">



            <img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}" class="img-fluid pull-left {{isset(Auth()->user()->consultant['image']) ? '' : 'styling_class' }}" alt="">

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
    <!-- <div class="alert alert-danger " role="alert">
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
    </div> -->
    @endif
</div>
<!-- Banner Section -->
<section class="innerbanner py-4 bg-img">

    {{-- <div class="inner-image">
        <img src="images/missionbg1.png" class="img-fluid w-100" alt="">
    </div> --}}
    <div class="container yellow-bg ">
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="innercaption py-2 border-red">
                    <h2 class="text-center text-red">Mission</h2>
                    <p class="text-center">Sharing the love of Jesus through Selling Christian Jewelry</p>
<br>
                    <h2 class="text-center text-red">Vision</h2>
                    <p class="text-center">To move hearts closer to Jesus by Styling with the Spirit</p>

                    <h2 class="text-center text-red">Values</h2>
                    <p class="text-center">Love, Faith ,Hope

                    </p>

                    <h2 class="text-center text-red">Love</h2>
                    <p class="text-center">Love God, Love People and Love what you do

                    </p>

                    <h2 class="text-center text-red">Faith</h2>
                    <p class="text-center">Have faith that God will fulfill your Purpose

                    </p>

                    <h2 class="text-center text-red">Hope</h2>
                    <p class="text-center">Hope that the Love of Jesus reaches many people

                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->

<!-- product Category -->
<!-- <section class="categorysec">
    <div class="container">
        @if (isset($categories))
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-{{ceil(abs(12/count($categories)))}} col-sm-4 col-xs-6 col-4">
                <div class="category-heading text-center">
                    <a href="{{route('shop')}}?id={{$category['slug']}}-tab" class="text-white">{{$category['name']}}</a>

                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
</section> -->
<!-- product Category -->

<!-- Mission sec -->
{{-- <section class="mission-sec py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mission-text">
                    <h2>Values</h2>
                    <p class="text-white">Love, Faith ,Hope
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mission-text">
                    <h2>Love </h2>
                    <p class="text-white">Love God, Love People and Love what you do</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mission-text">
                    <h2>Faith</h2>
                    <p class="text-white">Have faith that God will fulfill your Purpose</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="mission-text">
                    <h2>Hope</h2>
                    <p class="text-white">Hope that the Love of Jesus reaches many people</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-6 col-xs-12">

            </div>
        </div>
    </div>
</section> --}}

@endsection


@section('afterScript')
@endsection
