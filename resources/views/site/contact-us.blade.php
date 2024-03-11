@extends('layout.site.app')
@section('title', 'Contact Us')

@section('content')
<style>
    .navigation-wrap {
    /* background-color: #000; */
    background-color: #551d7c;
    padding: 25px 0 30px;
    box-shadow: inset 2px 0px 20px 7px #1A0627;
}
.contact-banner{
    box-shadow: unset !important
}
</style>
<!-- Coins sec -->
<div class="container-fluid">
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
{{-- <div class="alert alert-danger " role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <span aria-hidden="true">×</span>
    </button>
    <h2 style="text-align: center; background: none; padding-bottom: 0;color : #d00;">It looks like you haven't selected a Consultant yet!</h2>
<p style="text-align: center;  color:#551d7c; font-size: 18px"><span>...were you just wanting to browse or were you looking to shop and pick a Consultant to shop under?</span></p>
    <div class="text-center">
    <button type="button" class="btn btn-pink" data-dismiss="alert">
      <span aria-hidden="true">Just Browsing</span>
    </button>
      <a class="btn btn-pink" href="{{route('consultant')}}">
        Choose a Consultant
      </a>
    </div>
  </div> --}}
@endif

                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
</div>
<!-- Banner Section -->
<!-- Banner Section -->
<section class="innerbanner">


<!--
    <div class="inner-image">
        <img src="images/about.png" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- Banner Section -->
<div class="contact-banner border-red">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <div class="yellow-bg border-red text-center">
                    <h1 class="text-purple">Need More Help?</h1>
                    <h2 class="text-purple">Contact Us!</h2>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section -->

<!-- Contact Category -->
<div class="bg-img">

    <section class="contactsec">
        <div class="container border-red p-2">
            <div class="row wpb_row vc_row-fluid">
                <div class="contact-text wpb_column vc_column_container col-sm-12 col-lg-3 col-md-3">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper ">
                                    <h3 class="text-purple">Contact Us</h3>

                                </div>
                            </div>

                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <ul>
                                        <li><i class="fa fa-home" aria-hidden="true"></i><br>
                                            <h4 class="text-purple">Address</h4>
                                            <p class="text-purple">P.O. Box 1411<br>Plainfield, IL 60544-9998</p>
                                        </li>
                                        <li><i class="fa fa-envelope-open-o" aria-hidden="true"></i><br>
                                            <h4 class="text-purple">Phone</h4>
                                            <p class="text-purple">Mobile: (1) 888-871-2350<br></p>
                                        </li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i><br>
                                            <h4 class="text-purple">Email</h4>
                                            <p class="text-purple">christiancreationsunlimited@gmail.com<br>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wpb_column column_container col-sm-12 col-lg-1 col-md-1 hidden-sm">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper"></div>
                    </div>
                </div>
                <div class="contact-form wpb_column vc_column_container col-sm-12 col-lg-8 col-md-8">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <h3 class="text-purple">Tell Us Your Message</h3>

                                </div>
                            </div>
                            <div role="form" class="wpcf7" id="wpcf7-f5-p74-o1" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form action="{{route('contact.us')}}" method="post" novalidate="novalidate">
                                        @csrf
                                    <p><label class="text-purple"> Your Name (required)<br>
                                            <span class="wpcf7-form-control-wrap your-name "><input type="text"
                                                    name="name" value="{{old('name')}}" size="40"
                                                    aria-required="true" aria-invalid="false"></span> </label>
                                                    @if ($errors->has('name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif</p>
                                    <p><label class="text-purple"> Your Email (required)<br>
                                            <span class="wpcf7-form-control-wrap your-email"><input type="email"
                                                    name="email" value="{{old('email')}}" size="40"
                                                    class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                    aria-required="true" aria-invalid="false"></span> </label>
                                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif</p>
                                    <p><label class="text-purple"> Subject (required)<br>
                                            <span class="wpcf7-form-control-wrap your-subject"><input type="text"
                                                    name="subject" value="{{old('subject')}}" size="40"
                                                    class="wpcf7-form-control wpcf7-text" aria-invalid="false"></span>
                                        </label>
                                        @if ($errors->has('subject'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif</p>
                                    <p><label class="text-purple"> Your Message (required)<br>
                                            <span class="wpcf7-form-control-wrap your-message"><textarea name="message"
                                                    cols="40" rows="5" class="wpcf7-form-control wpcf7-textarea"
                                                    aria-invalid="false">{{old('message')}}</textarea></span> </label></p>
                                    <p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit"><span
                                            class="ajax-loader"></span>
                                            @if ($errors->has('message'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif</p>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Contact Category -->
@endsection


@section('afterScript')
@endsection
