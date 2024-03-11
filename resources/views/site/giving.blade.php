@extends('layout.site.app')
@section('title', 'Giving')

@section('content')
<!-- Coins sec -->
<!-- Banner Section -->
<section class="innerbanner">
@if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
    <!-- <div class="inner-image">
        <img src="images/accessories.jpg" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Giving</h2>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- Banner Section -->

<!-- product Category -->
<section class="clientlogo bg-img py-5">
    <div class="container">
        <h2 class="text-center yellow-bg p-3 text-purple border-red">10% of all profits go to charity.</h2>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://forlivesofwomen.org/">
                        <img src="images/original.png" class="img-fluid" alt="">
                    </a>
                    <h6>You can help save animals today. </h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.klove.com/">
                        <img src="images/k-love.png" class="img-fluid" alt="">
                    </a>
                    <h6>Positive Encouraging K-LOVE</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.shine.fm/">
                        <img src="images/logo.svg" class="img-fluid" alt="">
                    </a>
                    <h6>Home - MorningStar Mission </h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.salvationarmyusa.org/usn/">
                        <img src="images/slavation.png" class="img-fluid" alt="">
                    </a>
                    <h6>Donate to The Salvation Army National Donation Page </h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.redcross.org/">
                        <img src="images/redcross-logo.png.img.png" class="img-fluid" alt="">
                    </a>
                    <h6>American Red Cross | Help Those Affected by Disasters </h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://secure.aspca.org/donate/donate">
                        <img src="images/navlogo-022316.png" class="img-fluid" alt="">
                    </a>
                    <h6>You can help save animals today. | ASPCA</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://morningstarmission.org/">
                        <img src="images/Latest-Logo.png" class="img-fluid" alt="">
                    </a>
                    <h6>Home - MorningStar Mission</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.feedthechildren.org/">
                        <img src="images/FTC-Logo-Color.png" class="img-fluid" alt="">
                    </a>
                    <h6>Feed the Children</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://joycemeyer.org/">
                        <img src="images/logo-custom.svg" class="img-fluid filter" alt="">
                    </a>
                    <h6>Joyce Meyer Ministries Help Children, Families </h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://cure.org/">
                        <img src="images/crue.svg" class="img-fluid" alt="">
                    </a>
                    <h6>CURE International</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://www.charitywater.org/">
                        <img src="images/charity.png" class="img-fluid" alt="">
                    </a>
                    <h6>Charity Water</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://wck.org/">
                        <img src="images/wok.png" class="img-fluid" alt="" style="width: 130px;">
                    </a>
                    <h6>World Central Kitchen</h6>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="logoimage">
                    <a href="https://showerup.org/">
                        <img src="images/showerup.png" class="img-fluid" alt="">
                    </a>
                    <h6>Showerup </h6>
                </div>
            </div>
            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="logoimage">
                        <a href="https://communityincrisis.org/">
                            <img src="images/Community-in-Crisis-1x.png" class="img-fluid" alt="">
                        </a>
                        <h6>Communities in Crisis</h6>
                    </div>
                </div> -->
        </div>
    </div>
</section>
<!-- product Category -->
@endsection


@section('afterScript')
@endsection
