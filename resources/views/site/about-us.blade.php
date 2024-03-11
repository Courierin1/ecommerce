@extends('layout.site.app')
@section('title', 'About Us')

@section('content')
<style>
    .about-image img {
        width: 325px;
        max-width: 338px !important;
    }
    .about-text h2{
        color: #551d7c !important
    }
    .about-text p{
        color: #d00 !important
    }
    .about-image:before{
        content: none !important;
    }
    .about-image:after{
        height: 75% !important;
    }
    section.story-sec {
    background-color: #F6931E;
    color: #fff;
    position: relative;
    padding: 90px 0;
    z-index: 1;
}
    section.story-sec:before {
    position: absolute;
    content: "";
    /* background: url("{{asset('./images/BG.png')}}") center; */
    width: 100%;
    height: 100%;
    background-size: contain;
    z-index: -1;
    top: 50px;
}
.about-text p {
    color: #6d0018 !important;
    font-size: 20px;
}
section.categorysec{
    border-top: 0px !important
}
</style>
<!-- Coins sec -->
<!-- Banner Section -->
<div class="container">
    {{-- @if(isset(Auth()->user()->consultant))
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
    @endif --}}
</div>
<section class="innerbanner">
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <!-- <div class="inner-image">
        <img src="images/about.png" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- Banner Section -->
{{-- <section id="banner_section">
    <div class="container h-100">

            <div class="row h-100">
                <div class="col-md-12 d-flex justify-content-center align-items-start flex-column">
                    <h2 class="index">
                        About Us
                    </h2>
                </div>
            </div>


    </div>
    <div class="img_about">
        <img src="{{asset('images/about_us_img.png')}}" alt="" class="img-fluid">
    </div>
</section> --}}

<!-- product Category -->
<section class="categorysec">
    <div class="container">
        @if (isset($categories))
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-{{ceil(abs(12/count($categories)))}} col-sm-4 col-xs-6 col-4">
                <div class="category-heading text-center">
                    <a href="{{route('shop')}}?id={{$category['slug']}}-tab"
                        class="text-white">{{$category['name']}}</a>

                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
</section>
<!-- product Category -->
<!-- Team sec -->
<section class="story-sec bg-img yellow-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="about-text yellow-bg p-4 rounded border-red">
                    <h2>OUR STORY</h2>
                    <p>To share with you the story of how Christian Creations Unlimited was created is to tell of him. For it is God that is in the details of my life and this business.

                        As a little girl, I grew up in the church, yet as I got older, I stopped going to church on Sundays and only went on special occasions with my family.
                        I keep running and searching for happiness in all the wrong places, all the while doing things that pushed me to some very dark places. As I kept running and running, </p>
                        <p>Jesus kept reaching and reaching.
                            Then in October of 2013 I had a near death experience where I clung to my faith reaching to God for answers, my brokenness brought me to him nd he did not disappoint! It was in that moment I understood what Jesus had done by dying for my sins. In that moment, he had forgiven me for anything I had done previously washing me white as snow. With his amazing grace I realized the magnitude of God’s love and power.
                            I am thankful for my scars without them I would not know God’s heart. He is the goodness in my life</p>

                    </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                <div class="about-image position-relative">
                    <img src="images/me.jpg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 about-text yellow-bg p-4 border-red rounded">
                <p>
                        In an instance I became a born again Christian and was on fire for the Father, the Son and the Holy Spirit.
The power of the trinity brought me a blessing out of a tragedy. Through this profound moment I realized I am a breathing living Miracle and now my passion is to live my life in a way that testifies to the almighty goodness.
                    </p>
                    <p>
                        Fully aware that Jesus was living inside me I was a new creation ready to share his amazing grace with the world in a unique way.
Going forward one thing I wanted to do is wear a cross every day. I looked around for different crosses but could only find plain gold and silver crosses, but I wanted crosses that were bold that matched my spirit as well as my outfits.
                    </p>
                    <p>
                        So I went to many wholesale stores in Chicago where they had a variety and the boldness I was looking for.
I was buying them for myself until I started think if I am searching for this variety maybe others are as well.
                    </p>
                    <p>
                        Then the Lord showed me that this is the new purpose in my life, to share the love of Jesus by selling unique Christian jewelry.
This was not a totally new venture as I used to sell homemade sweatshirts and jewelry when I was younger.
                    </p>
                    <p>
                        Back then the name of the business was Creations Unlimited, so the Lord said change it to Christian Creations Unlimited. Unlimited being the unlimited variety in Christian Jewelry. From my near-death experience to the miracle of starting a business that gives all the glory to God Christian Creations Unlimited was born.

                    </p>
                    <p>
                        I first started selling my Christian Jewelry at my church, then I would also do ladies events selling my Christian Jewelry there.
This led to selling my Christian Jewelry on Facebook and throwing home parties.
Soon I thought more and more about how could I reach more people and share the Love of Jesus with them
God put the thought in my head to expand and involve others in selling my jewelry as well.
So now I am hiring Christian Creations Unlimited Consultants to join me in selling Christian Jewelry.
                    </p>
                    <p>
                        So when I was born again I started seeing 4”s all the time, in phone numbers, license plates, time of day, receipts, etc.
I kept seeing 444 and other series of repeating numbers, each time this occurred and I would look up bible verses related to these numbers to see what God was trying to tell me.
Soon I realized that these numbers and messages needed to be an intergraded into the prices of my jewelry.
Now I bring this jewelry to you and ask you to join me in this crusade to spread the Love of Jesus

                    </p>
                    <p>
                        Let’s keep it simple Love God, Love People and love what we do!
                    </p>
            </div>
        </div>
    </div>
</section>
<!-- Team sec -->
@endsection


@section('afterScript')
@endsection
