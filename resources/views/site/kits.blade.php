@extends('layout.site.app')
<script src="https://js.stripe.com/v3/"></script>

@section('title', 'Kits')
<style>
    .kits2{
        background: #f6931e;
        color: #571e7b;
        padding: 10px 10px;
        height: 100%;
        box-shadow: -1px 1px 10px #f6931e;
        margin-bottom: 25px !important
    }
    .kit{
        height: 21% !important;
        color: #6d0018 !important
    }
    .kitsec h2{
        color: #571e7b !important
    }
    .kit_font{font-size: 32px; font-weight: bolder }
    .kit h3{color : #6d0018 !important}
</style>
@section('content')
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
                <img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}"
                    class="img-fluid pull-left {{isset(Auth()->user()->consultant['image']) ? '' : 'styling_class' }}" alt="">

                <div class="pull-left">
                    <h3 class="replicated-rep-company-or-name">
                        {{ Auth()->user()->consultant['name'] }}
                    </h3>

                </div>
                <div class="text-right pull-right">
                    <p class="replicated-rep-social-media">
                        <br>
                        {{ Auth()->user()->consultant['phone'] }}<br>
                        <a
                            href="mailto:{{ Auth()->user()->consultant['email'] }}">{{ Auth()->user()->consultant['email'] }}</a><br>
                        ID # {{ Auth()->user()->consultant['unique_id'] }}<br>
                    </p>
                </div>
            </div>
        </div>
    @else
        {{-- <div class="alert alert-danger " role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
            </button>
            <h2 style="text-align: center; background: none; padding-bottom: 0;">It looks like you haven't selected a
                Consultant yet!</h2>
            <p style="text-align: center;"><span>...were you just wanting to browse or were you looking to shop and pick
                    a Consultant to shop under?</span></p>
            <div class="text-center">
                <button type="button" class="btn btn-pink" data-dismiss="alert">
                    <span aria-hidden="true">Just Browsing</span>
                </button>
                <a class="btn btn-pink" href="#step-1">
                    Choose a Consultant
                </a>
            </div>
        </div> --}}
    @endif
</div>
<!-- Banner Section -->

<!-- Banner Section -->


<!-- product Category -->

@if($errors->any())
                            <div class="alert alert-danger">
                                <p><strong>Opps Something went wrong</strong></p>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif

<!-- product Category -->
<!-- consult sec -->
<section class="consult-sec bg-img py-5" id="consultant">
    <div class="container yellow-bg shadow rounded">
        <h2 class="text-center text-red">Become a Consultant Today!</h2>
        <p class="text-center text-purple">JUST FOLLOW THESE 4 EASY STEPS</p>
        <div class="stepwizard ">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step prev">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle" disabled>1</a>
                    <p class="text-purple">Choose Your Sponsor <span class="d-block">Step 1</span></p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p class="text-purple">Choose a Kit <span class="d-block">Step 2</span></p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p class="text-purple">Checkout <span class="d-block">Step 3</span></p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p class="text-purple">Start the Party <span class="d-block">Step 4</span></p>
                </div>
            </div>
        </div>


        <div class="row setup-content d-none" id="step-1">
            <div class="col-xs-6 col-md-6 col-12">


                <div
                    class="text-center one {{ isset(Auth()->user()->consultant)? 'd-block' : 'd-none' }}">
                    <div class="join-become-chosen-items">
                        <div class="join-become-chosen-consultant js-join-become-chosen-consultant">
                            <h5>Your Sponsor</h5>
                            <p>{{isset(Auth()->user()->consultant) ? Auth()->user()->consultant['name'] : ''}} (<a
                                    href="javascript:change_sponsor();">change</a>)</p>
                            <p><img src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : '/images/shellie-logo.jpg'}}"
                    class="img-fluid consultant_img {{isset(Auth()->user()->consultant['image']) ? '' : 'styling_class' }}""
                                    alt=""></p>
                        </div>
                    </div>
                    <p class="join-become-find-sponsor-buttons js-join-become-find-sponsor-buttons">
                        <a href="javascript:;" class="btn btn-pink btn-lg nextBtn">Use the Sponsor Above</a>
                    </p>
                </div>

                <div
                    class="two {{ isset(Auth()->user()->consultant)? 'd-none' : 'd-block' }}">

                    <div class="col-md-12">
                        <h3>SEARCH FOR A CONSULTANT</h3>

                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#zip-code" role="tab"
                                    aria-controls="pills-zip-code" aria-selected="true">Zip Code</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#consultant-name" role="tab"
                                    aria-controls="pills-consultant-name" aria-selected="false">Consultant Name</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#rep-number" role="tab"
                                    aria-controls="pills-rep-number" aria-selected="false">Consultant Number</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="zip-code" role="tabpanel"
                                aria-labelledby="zip-code-tab">
                                <label for="">Zip Code or Account Number</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" value = "">
                                <a href="javascript:;" onclick="getZipCode();"
                                    class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                            </div>
                            <div class="tab-pane fade" id="consultant-name" role="tabpanel"
                                aria-labelledby="consultant-name-tab">
                                <div class="form-grpup">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" value = "">
                                    <a href="javascript:;" onclick="getFullName();"
                                        class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rep-number" role="tabpanel" aria-labelledby="rep-number-tab">
                                <div class="form-grpup">
                                    <label for="">Rep Number</label>
                                    <input type="number" class="form-control" name="repnumber" id="repnumber" value = "">
                                    <a href="javascript:;" onclick="getRepNum();"
                                        class="btn btn-primary btn-lg pull-right mt-2">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 two {{ isset(Auth()->user()->consultant)? 'd-none' : 'd-block' }}">
                <div class="myContainer">
                    <div class="form-container animated">
                        <h4 class="text-center form-title mb-0">THESE ARE CONSULTANTS IN YOUR AREA
                        </h4>
                        <div class="row" id="all_consultant">

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="consultant-image">
                                    <div class="modal-content-wrapper" id="consult">
                                        <!-- <div class="image-modal-content">
                                            <img src="images/app-286487-v6.png.100x100_q85_crop_upscale.png"
                                                data-title="Rosalinda Molina" data-description="" data-url=""
                                                data-repo="" alt="">
                                        </div> -->

                                    </div>
                                    <!-- modal popup (displayed none by default) -->
                                    <div class="image-modal-popup">
                                        <div class="wrapper">
                                            <span>&times;</span>
                                            <img src="" alt="Image Modal">
                                            <div class="description">
                                                <h4></h4>
                                                <p></p>
                                                <p class=""><a id="mail" href="mailto:"></a>
                                                </p>
                                                <input type="text" hidden name="choose_consultant_id"
                                                    id="choose_consultant_id" value="" />
                                                <!-- nextBtn -->
                                                <button class="btn btn-primary nextBtn btn-lg" id=""
                                                    onclick="chooseConsultant();" type="button">Choose
                                                    this Consultant</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-md-12">
                <div class="sponsor-box">
                    <h5>Your Sponsor<button class="prevBtn btn-sm" type="button">(Change)</button></h5>
                    <p class="spn-name">{{isset(Auth()->user()->consultant) ? Auth()->user()->consultant['name'] : ''}}</p>

                    <img class="spn-image img-fluid" src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : 'images/app-286487-v6.png.100x100_q85_crop_upscale.png'}}" alt="">
                </div>
                @if(isset($kits))
                    <h5 class="text-center mt-4">PLEASE CHOOSE A KIT</h5>
                    <div class="row">
                        @foreach($kits as $kit)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="partypack">
                                    <a type="button"
                                        href="javascript:getKit({{ $kit['collection_id'] }})"
                                        class="nextBtn">
                                        <h4>{{ $kit['name'] }}</h4>
                                        <h6>${{ $kit['sale_price'] }}</h6>
                                        <img src="{{isset($kit['image'])? $kit['image'] : 'images/product-img.png'}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                @endif
                <!-- <button class="btn btn-primary prevBtn btn-lg pull-left mt-3" type="button">Previous</button>
                    <button class="btn btn-primary nextBtn btn-lg pull-right mt-3" type="button">Next</button> -->
            </div>
        </div>
    </div>
    <form method="POST" id="form" action="{{route('collection.buy')}}">
    <div class="row setup-content" id="step-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 offset-md-2">
                    <div class="yourkit">
                        <h4>Your Sponsor<button class="firstBtn btn-sm" type="button">(Change)</button></h4>
                        <h6 class="spn-name">{{isset(Auth()->user()->consultant) ? Auth()->user()->consultant['name'] : ''}}</h6>
                        <img class="spn-image img-fluid" src="{{isset(Auth()->user()->consultant['image']) ? Auth()->user()->consultant['image'] : 'images/app-286487-v6.png.100x100_q85_crop_upscale.png'}}" alt="">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">

                    <div class="yourkit">
                    <h4>Your Kit<button class='prevBtn btn-sm' type='button'>(Change)</button></h4>
                        <h6 class="kit-name"></h6>
                        <h6 class="kit-price"></h6>
                        <img class="kit-image img-fluid" src="images/product-img.png" alt="">
                    </div>

                </div>
            </div>

                @csrf
                <h4 class="basic">Basic Information</h4>
                <div class="row join-become-field-wrapper js-join-become-field-wrapper">
                    <div class="col-sm-6 pop">
                        <div id="div_signup_id_first_name" class="form-group">
                            <label for="signup_id_first_name" class="control-label">
                                First Name<span class=" asteriskField ">*</span> </label>
                            <div class="controls "> <input type="text" name="first_name" maxlength="50"
                                    class="textinput textInput form-control" required id="signup_id_first_name" value="{{isset($detail,$detail->first_name) ? $detail->first_name : old('first_name')}}"> </div>
                        </div>
                        <div id="div_signup_id_last_name " class="form-group ">
                            <label for="signup_id_last_name " class="control-label "> Last Name<span
                                    class="asteriskField ">*</span> </label>
                            <div class="controls "> <input type="text " name="last_name" maxlength="50 "
                                    class="textinput textInput form-control " required=" " id="signup_id_last_name " value="{{isset($detail,$detail->last_name) ? $detail->last_name : old('last_name')}}">
                            </div>
                        </div>
                        <div id="div_signup_id_date_of_birth " class="form-group ">
                            <label for="signup_id_date_of_birth " class="control-label"> Date Of Birth<span
                                    class="asteriskField">*</span> </label>
                            <div class="controls ">
                                <input type="date" name="date_of_birth" class="textinput textInput form-control"
                                    required="" id="signup_id_date_of_birth " value="{{isset($detail,$detail->dob) ? $detail->dob : old('date_of_birth')}}">
                                <div id="hint_signup_id_date_of_birth " class="help-block ">mm/dd/yyyy or yyyy-mm-dd
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 pop">
                        <div id="div_signup_id_social_security_number " class="form-group">
                            <label for="signup_id_social_security_number " class="control-label"> Social
                                Security Number<span class=" asteriskField ">*</span> </label>
                            <div class="controls "> <input type="text " name="social_security_number"
                                    class="textinput textInput form-control " required=" "
                                    id="signup_id_social_security_number " value="{{isset($detail,$detail->ssn) ? $detail->ssn : old('social_security_number')}}" > </div>
                        </div>
                        <div id="div_signup_id_preferred_language " class="form-group ">
                            <label for="signup_id_preferred_language " class="control-label"> Preferred
                                Language<span class=" asteriskField ">*</span> </label>
                            <div class="controls ">
                                <select name="preferred_language" class="select form-control " required=" "
                                    id="signup_id_preferred_language">
                                    <option value="" selected disabled>---------</option>
                                    <option value="en" {{isset($detail,$detail->language) && $detail->language=='en' ? 'selected' : ''}}">English</option>
                                    <option value="es" {{isset($detail,$detail->language) && $detail->language=='es' ? 'selected' : ''}}">Spanish</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 pop">
                        <p><button type="button" class="btn btn-primary js-join-become-btn-next test">Next</button> </p>

                    </div>
                    <div class="col-md-12 col-12 ">
                        <ul class="p-0 ">
                            <li class="billing "><a href="javascript:; ">Billing/Shipping Information</a></li>
                            <div class="shipping_info ">
                                            <!-- <div class="alert alert-primary" role="alert ">
                                                This is a primary alert—check it out!
                                            </div> -->
                                            <label for="ship_check"></label>

                                            <input type="checkbox" id="ship" class="ship_check" name="ship" value="1">
                                            <span>My shipping information is the same as my billing information</span>
                                            <div class="row ">
                                                <div class="col-sm-6 ">
                                        <div id="div_signup_id_bill_street_1" class="form-group">
                                            <label for="signup_id_bill_street_1 " class="control-label ">
                                                Bill Street 1<span class="asteriskField ">*</span> </label>
                                            <div class="controls "> <input type="text " name="bill_street_1"
                                                    maxlength="50 " class="textinput textInput form-control "
                                                    required=" " id="signup_id_bill_street_1 " value="{{isset($detail,$detail->bill_street_1) ? $detail->bill_street_1 : ''}}"> </div>
                                        </div>
                                        <div id="div_signup_id_bill_street_2 " class="form-group ">
                                            <label for="signup_id_bill_street_2 " class="control-label ">
                                                Bill Street 2
                                            </label>
                                            <div class="controls"> <input type="text " name="bill_street_2"
                                                    maxlength="50 " class="textinput textInput form-control "
                                                    id="signup_id_bill_street_2 " value="{{isset($detail,$detail->bill_street_2) ? $detail->bill_street_2 : ''}}"> </div>
                                        </div>
                                        <div id="div_signup_id_bill_postal_code " class="form-group ">
                                            <label for="signup_id_bill_postal_code " class="control-label ">
                                                Bill Postal Code<span class="asteriskField ">*</span> </label>
                                            <div class="controls "> <input type="text " name="bill_postal_code"
                                                    class="textinput textInput form-control " required=" "
                                                    id="signup_id_bill_postal_code " value="{{isset($detail,$detail->bill_postal_code) ? $detail->bill_postal_code : ''}}">
                                            </div>
                                        </div>
                                        <div id="div_signup_id_bill_city " class="form-group">
                                            <label for="signup_id_bill_city " class="control-label ">
                                                Bill City<span class="asteriskField ">*</span> </label>
                                            <div class="controls ">
                                                <input type="text " name="bill_city" maxlength="50 "
                                                    class="textinput textInput form-control " required=" "
                                                    id="signup_id_bill_city " tabindex="-1 " title=" Bill City* " value="{{isset($detail,$detail->bill_city) ? $detail->bill_city : ''}}">
                                            </div>
                                        </div>
                                        <div id="div_signup_id_bill_state " class="form-group ">
                                            <label for="signup_id_bill_state " class="control-label requiredField ">
                                                Bill State<span class="asteriskField ">*</span> </label>
                                            <div class="controls ">
                                                <input type="text " name="bill_state" maxlength="50 "
                                                    class="textinput textInput form-control " required=" "
                                                    id="signup_id_bill_state " tabindex="-1 " title=" Bill State* " value="{{isset($detail,$detail->bill_state) ? $detail->bill_state : ''}}">
                                            </div>
                                        </div>
                                        <div id="div_signup_id_bill_county " class="form-group ">
                                            <label for="signup_id_bill_county " class="control-label requiredField ">
                                                Bill County<span class="asteriskField ">*</span> </label>
                                            <div class="controls ">
                                                <input type="text " name="bill_county" maxlength="50 "
                                                    class="textinput textInput form-control " required=" "
                                                    id="signup_id_bill_county " tabindex="-1 " title=" Bill County* " value="{{isset($detail,$detail->bill_county) ? $detail->bill_county : ''}}">
                                                    </div>
                                                    </div>
                                                    <div id=" div_signup_id_bill_country " class=" form-group ">
                                                        <label for=" signup_id_bill_country "
                                                            class=" control-label requiredField ">
                                                            Bill Country<span class=" asteriskField ">*</span> </label>
                                                        <div class=" controls ">
                                                            <select name="bill_country" class=" select form-control "
                                                                required=" " id=" signup_id_bill_country ">
                                                                <option value="" selected disabled>---------</option>
                                                                <option value="USA">USA</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class=" col-sm-6 ship_fields ship ">
                                                    <div id=" div_signup_id_ship_street_1 " class=" form-group ">
                                                        <label for=" signup_id_ship_street_1 "
                                                            class=" control-label requiredField ">
                                                            Ship Street 1<span class=" asteriskField ">*</span> </label>
                                                        <div class=" controls "> <input type=" text "
                                                                name="ship_street_1" maxlength=" 50 "
                                                                class=" textinput textInput form-control " required=" "
                                                                id=" signup_id_ship_street_1 " value="{{isset($detail,$detail->ship_street_1) ? $detail->ship_street_1 : ''}}"> </div>
                                                    </div>
                                                    <div id=" div_signup_id_ship_street_2 " class=" form-group ">
                                                        <label for=" signup_id_ship_street_2 " class=" control-label ">
                                                            Ship Street 2
                                                        </label>
                                                        <div class=" controls "> <input type=" text "
                                                                name="ship_street_2" maxlength=" 50 "
                                                                class=" textinput textInput form-control "
                                                                id=" signup_id_ship_street_2 " value="{{isset($detail,$detail->ship_street_2) ? $detail->ship_street_2 : ''}}"> </div>
                                                    </div>
                                                    <div id=" div_signup_id_ship_postal_code " class=" form-group ">
                                                        <label for=" signup_id_ship_postal_code "
                                                            class=" control-label requiredField ">
                                                            Ship Postal Code<span class=" asteriskField ">*</span>
                                                        </label>
                                                        <div class=" controls "> <input type=" text "
                                                                name="ship_postal_code"
                                                                class=" textinput textInput form-control " required=" "
                                                                id=" signup_id_ship_postal_code " value="{{isset($detail,$detail->ship_postal_code) ? $detail->ship_postal_code : ''}}">
                                                        </div>
                                                    </div>
                                                    <div id=" div_signup_id_ship_city " class=" form-group ">
                                                        <label for=" signup_id_ship_city "
                                                            class=" control-label requiredField ">
                                                            Ship City<span class=" asteriskField ">*</span> </label>
                                                        <div class=" controls ">
                                                            <input type=" text " name="ship_city" maxlength=" 50 "
                                                                class=" textinput textInput form-control " required=" "
                                                                id=" signup_id_ship_city " tabindex=" -1 "
                                                                title=" ship City* " value="{{isset($detail,$detail->ship_city) ? $detail->ship_city : ''}}">
                                                        </div>
                                                    </div>
                                                    <div id=" div_signup_id_ship_state " class=" form-group ">
                                                        <label for=" signup_id_ship_state "
                                                            class=" control-label requiredField ">
                                                            Ship State<span class=" asteriskField ">*</span> </label>
                                                        <div class=" controls ">
                                                            <input type=" text " name="ship_state" maxlength=" 50 "
                                                                class=" textinput textInput form-control " required=" "
                                                                id=" signup_id_ship_state " tabindex=" -1 "
                                                                title=" ship State* " value="{{isset($detail,$detail->ship_state) ? $detail->ship_state : ''}}">
                                                        </div>
                                                    </div>
                                                    <div id=" div_signup_id_ship_county " class=" form-group ">
                                                        <label for=" signup_id_ship_county "
                                                            class=" control-label requiredField ">
                                                            Ship County<span class=" asteriskField ">*</span> </label>
                                                        <div class=" controls ">
                                                            <input type=" text " name="ship_county" maxlength=" 50 "
                                                                class=" textinput textInput form-control " required=" "
                                                                id=" signup_id_ship_county " tabindex=" -1 "
                                                                title=" ship County* " value="{{isset($detail,$detail->ship_county) ? $detail->ship_county : ''}}">

                                            </div>
                                        </div>
                                        <div id=" div_signup_id_ship_country " class=" form-group ">
                                            <label for=" signup_id_ship_country " class=" control-label ">
                                                Ship Country<span class=" asteriskField ">*</span> </label>
                                            <div class=" controls ">
                                                <select name="ship_country" class=" select
                                                                form-control " required=" "
                                                    id=" signup_id_ship_country ">
                                                    <option value="" selected disabled>---------</option>
                                                    <option value="USA">USA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                        <p><button type="button" class="btn btn-primary js-join-become-btn-next test1">Next</button> </p>

                    </div>
                                </div>
                            </div>
                            <li><a href=" javascript:; " class=" contact_div ">Contact Information</a></li>
                            <div class=" contact_information ">
                                <label for=" ">Email*</label>
                                <input type=" email " class=" form-control " name="email" id="email" value="{{Auth::check() ? Auth()->user()->email : ''}}">
                                <div class=" form-row mt-3 ">
                                    <div class=" col-md-6 ">
                                        <label for=" ">Home Phone*</label>
                                        <input type=" text " class=" form-control " name="hphone" id="hphone" value="{{isset($detail,$detail->hphone) ? $detail->hphone : ''}}">
                                    </div>
                                    <div class=" col-md-6 ">
                                        <label for=" ">Work Phone</label>
                                        <input type=" text " class=" form-control " name="wphone" id="wphone" value="{{isset($detail,$detail->wphone) ? $detail->wphone : ''}}">
                                    </div>
                                </div>
                                <div class=" form-row mt-3 ">
                                    <div class=" col-md-6 ">
                                        <label for=" ">Cell Phone*</label>
                                        <input type=" phone " class=" form-control " name="cphone" id="cphone" value="{{isset($detail,$detail->cphone) ? $detail->cphone : ''}}">
                                    </div>
                                    <div class=" col-md-6 ">
                                        <label for=" ">Fax Number</label>
                                        <input type=" number " class=" form-control " name="fax" id="fax" value="{{isset($detail,$detail->fax) ? $detail->fax : ''}}">
                                    </div>
                                    <div class="col-sm-12">
                        <p><button type="button" class="btn btn-primary js-join-become-btn-next test2">Next</button> </p>

                    </div>
                                </div>

                            </div>
                            <li><a href=" javascript:; " class=" payment_div ">Payout Information</a></li>
                            <div class=" payment_information ">
                                <div class=" alert alert-primary " role=" alert ">
                                    Please select how you would like to receive your commissions. Commissions are
                                    paid monthly either by Direct Deposit (FREE) or Check ($2.50 fee).
                                </div>
                                <label for="pm">Payout Method*</label>
                                <select name="pm" class=" form-control " id="pm">
                                    <option value="DIRECT" {{isset($detail,$detail->pm) && $detail->pm=='DIRECT'? 'selected' : ''}} >Direct Deposit</option>
                                    <option value="CHECK" {{isset($detail,$detail->pm) && $detail->pm=='CHECK'? 'selected' : ''}} >Mail Physical Check</option>
                                </select>
                                <div class=" form-row ">
                                    <div class=" col-md-3 form-group">
                                        <label for=" ">Bank Name*</label>
                                        <input type=" text " class=" form-control " name="bank" id="bank" value="{{isset($detail,$detail->bank) ? $detail->bank : ''}}">
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for=" ">Routing Number*</label>
                                        <input type=" text " class=" form-control " name="routing" id="routing" value="{{isset($detail,$detail->routing) ? $detail->routing : ''}}">
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for=" ">Account Number*</label>
                                        <input type=" text " class=" form-control " name="acc_no" id="acc_no" value="{{isset($detail,$detail->acc_no) ? $detail->acc_no : ''}}">
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for=" ">Account Type*</label>
                                        <select name="acc_type" class=" form-control " id="acc_type">
                                    <option value="Savings" {{isset($detail,$detail->acc_type) && $detail->pm=='Savings'? 'selected' : ''}} >Savings</option>
                                    <option value="Current" {{isset($detail,$detail->acc_type) && $detail->pm=='Current'? 'selected' : ''}} >Current</option>
                                </select>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                        <p><button type="button" class="btn btn-primary js-join-become-btn-next test3">Next</button> </p>

                    </div>
                            </div>
                            <!-- <li><a href=" javascript:; " class=" office_div ">Payout Information</a></li>
                            <div class=" office_info ">
                                <div class=" alert alert-primary " role=" alert ">
                                    This is the password that you, as a Consultant, will use to access the Back
                                    Office.
                                </div>
                                <div class=" form-row ">
                                    <div class=" col-md-6 ">
                                        <label for=" ">Back Office Password</label>
                                        <input type=" password " class=" form-control " name=" " id=" ">
                                    </div>
                                    <div class=" col-md-6 ">
                                        <label for=" ">Confirm Password*</label>
                                        <input type=" password " class=" form-control " name=" " id=" ">
                                    </div>
                                </div>
                                <div class=" password_details ">
                                    <p>Your password can't be too similar to your other personal information.
                                    </p>
                                    <p>Your password must contain at least 8 characters.</p>
                                    <p>Your password can't be a commonly used password.</p>
                                    <p>Your password can't be entirely numeric.</p>
                                    <p>Your password shouldn't include any of these characters: @</p>
                                </div> -->
                                <!-- <button class="btn-primary test3">next</button>
                            </div> -->
                            <li><a href="javascript:;" class="terms_div">Card Verification</a>
                            </li>
                            <div class="terms_text2">
                                <div id="card-element">
                                    <div>
                                        <label for="card-number">Card Number</label>
                                        <div id="card-number"></div>
                                    </div>
                                    <input type="hidden" name="stripeToken" id="stripeToken" value="">
                                    <button type="button" class="btn btn-primary js-join-become-btn-next test6"style="margin-top: 20px;" >Next</button>

                                </div>
                            </div>
                            <li><a href="javascript:;" class="terms_div">Enrollment Terms & Conditions</a>
                            </li>
                            <div class="terms_text">
                                <p>1. I understand that as an Independent Consultant for Christian Creations
                                    Unlimited (“Christian Creations Unlimited”): a. I have the right to offer for
                                    sale Christian Creations Unlimited products and services in
                                    accordance with these Terms and Conditions. b. I have the right to enroll
                                    persons in Christian Creations Unlimited. c. If qualified, I have the right to
                                    earn commissions pursuant to the Christian Creations Unlimited
                                    Compensation Plan. 2. I agree to present the Christian Creations Unlimited
                                    Marketing and Compensation Plan and Christian Creations Unlimited products and
                                    services as set forth in official Christian Creations
                                    Unlimited literature. 3. I agree that, as a Christian Creations Unlimited
                                    Consultant, I am an independent contractor and not an employee, partner, legal
                                    representative, or franchisee of Christian Creations Unlimited.
                                    I agree that I will be solely responsible for paying all expenses which I incur
                                    in my business, including, but not limited to, travel, food, lodging,
                                    secretarial, office, long distance telephone and other expenses.
                                    I UNDERSTAND THAT I SHALL NOT BE TREATED AS AN EMPLOYEE OF Christian Creations
                                    Unlimited FOR FEDERAL OR STATE TAX PURPOSES. Christian Creations Unlimited is
                                    not responsible for withholding and shall not withhold
                                    or deduct from my bonuses and commissions, if any, FICA or taxes of any kind
                                    unless required by law. 4. I have carefully read and agree to comply with the
                                    Christian Creations Unlimited Policies and Procedures,
                                    the Christian Creations Unlimited Marketing and Compensation Plan, which are
                                    incorporated into and made a part of these Terms and Conditions (these three
                                    documents shall be collectively referred to as the “Agreement”).
                                    I understand that I must be in good standing and not in violation of the
                                    Agreement to be eligible for bonuses or commissions from Christian Creations
                                    Unlimited. I understand that the Christian Creations Unlimited
                                    Policies and Procedures and/or the Christian Creations Unlimited Marketing and
                                    Compensation Plan may be amended at the sole discretion of Christian Creations
                                    Unlimited, and I agree to abide by all such amendments.
                                    Notification of amendments shall be posted on Christian Creations Unlimited’s
                                    website. Amendments shall become effective 30 days after publication. The
                                    continuation of my Christian Creations Unlimited business
                                    or my acceptance of bonuses or commissions shall constitute my acceptance of any
                                    and all amendments. 5. The term of this Agreement is one year. If I fail to
                                    annually renew my Christian Creations Unlimited business
                                    through the purchase of inventory, or if it is canceled or terminated for any
                                    reason, I understand that I will permanently lose all rights as a Consultant. I
                                    shall not be eligible to sell Christian Creations
                                    Unlimited products and services, nor shall I be eligible to receive commissions,
                                    bonuses, or other income resulting from the activities of my former downline
                                    sales organization. In the event of cancellation,
                                    termination, or nonrenewal, I waive all rights I have, including, but not
                                    limited to, property rights to my former downline organization and to any
                                    bonuses, commissions or other remuneration derived through
                                    the sales and other activities of my former downline organization. Christian
                                    Creations Unlimited reserves the right to terminate all Consultant Agreements
                                    upon 30 days notice if the Company elects to: (1) cease
                                    business operations; (2) dissolve as a business entity; or (3) terminate
                                    distribution of its products and/or services via direct selling channels.
                                    Consultant may cancel this Agreement at any time and for any
                                    reason upon written notice to Christian Creations Unlimited at its principal
                                    business address.
                                </p>
                                <label for=""></label>
                                <input type="checkbox" name="terms" id="terms" value="1">
                                <span>I agree to the Enrollment Terms & Conditions as presented here.*</span>
                                <button type="button" class="btn btn-primary js-join-become-btn-next nextBtn">Next</button>
                            </div>
                            <li><a href="javascript:;" class="">Start Selling</a>
                            </li>
                            <div class="start_selling d-none" >
                                <h3>Thank you for the registration.</h3>
                                <p>Submit this form and start selling.</p>
                            </div>

                        </ul>
                    </div>
                </div>

        </div>
    </div>
    <div class="row setup-content" id="step-4">
            <div class="col-xs-6 col-md-6 col-12">
            <div class="start_selling" >
                                <h3>Thank you for the registration.</h3>
                                <p>Submit this form and start selling.</p>
            </div>
            <button class=" btn btn-primary prevBtn btn-lg pull-left" type=" button ">Previous</button>
                <button class=" btn btn-success btn-lg pull-right test4" type="submit">Submit</button>
        </div>
        </div>

    </div>
    </form>
</section>
<section class="kitsec bg-img">
    <div class="container">
        <h2 class="text-center border-red p-2 yellow-bg">Starter Kits</h2>
        @if(isset($kits))
            <div class="row">
                @foreach($kits as $kit)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="kit" id="style-9">
                            <ul class="force-overflow p-0 border-red">
                                <h4 class="kit_font">{{ $kit['name'] }}</h4>
                                <h5>${{ $kit['sale_price'] }}</h5>
                                {{-- <p>{!! $kit['description'] !!}</p> --}}
                            </ul>
                        </div>
                        <div class="kits2 " id="style-9">
                            <ul class="force-overflow p-0 border-red p-2">

                                <p>{!! $kit['description'] !!}</p>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" onclick="pickNow()" class="theme-btn d-inline-block text-yellow">Pick
                            Now</a>
                    </div>
                    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="kit" id="style-9">
                    <ul class="force-overflow p-0">
                        <h4>Small Kit</h4>
                        <h5>$144.44</h5>
                        <li>Includes:</li>
                        <li>14 Earrings</li>
                        <li>9 Bracelets</li>
                        <li>9 Necklaces</li>
                    </ul>
                </div>
                <a href="{{ route ('pricing') }}" class="theme-btn d-inline-block">Pick Now</a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="kit" id="style-9">
                    <ul class="force-overflow p-0">
                        <h4>Large Kit</h4>
                        <h5>$244.44</h5>
                        <li>Includes:</li>
                        <li>14 Earrings</li>
                        <li>9 Bracelets</li>
                        <li>9 Necklaces</li>
                        <li>10 Sets (Earrings and Necklace Sets)</li>
                    </ul>
                </div>
                <a href="{{ route ('pricing') }}" class="theme-btn d-inline-block">Pick Now</a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="kit" id="style-9">
                    <ul class="force-overflow p-0">
                        <h4>Executive Kit</h4>
                        <h5>$444.44</h5>
                        <li>Includes:</li>
                        <li>14 Earrings</li>
                        <li>18 Bracelets</li>
                        <li>18 Necklaces</li>
                        <li>20 Sets (Earring and Necklace Sets)</li>
                    </ul>
                </div>
                <a href="{{ route ('pricing') }}" class="theme-btn d-inline-block">Pick Now</a>
            </div> -->
                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- consult sec -->
@endsection

@section('afterScript')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/forms.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>
      $(document).ready(function(){
        var stripe = Stripe('pk_test_51MmZDEI9ULwTCm44vOW5zUvqSWyg11m2y9zPKr3LbEcZmAa5sTJXg0ym3OhPBwcPRT84F9ezVV2PJCAW18lwq7vk009NI3EiLw'); // Replace with your actual publishable key
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-number');
    $('.test6').on('click', function(event) {

            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    var token = result.token.id;
                    $("#stripeToken").val(token);
                 $(".terms_text2").toggle(500);
                $(".terms_text").toggle(500);




                }
            });
        });

        });
    $(document).ready(function () {
        $(window).scrollTop(0);
    });

    $(document).ready(function () {

        $("input[name='social_security_number']").inputmask('999-99-9999');
        $("input[name='routing']").inputmask('999999999');
        // $(".billing").click(function () {
        //     $(".shipping_info").toggle(500);
        // });
        // $(".contact_div").click(function () {
        //     $(".contact_information").toggle(500);
        // });
        // $(".payment_div").click(function () {
        //     $(".payment_information").toggle(500);
        // });
        // $(".office_div").click(function () {
        //     $(".office_info").toggle(500);
        // });
        // $(".terms_div").click(function () {
        //     $(".terms_text").toggle(500);
        // });
    });
    $(".ship").show();
    $(".ship_check").click(function () {
        if ($(this).is(":checked")) {
            $(".ship_fields").hide();
        } else {
            $(".ship_fields").show();
        }
    });
    $('.js-anchor-link').click(function (e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            var scrollTo = target.offset().top;
            $('body, html').animate({
                scrollTop: scrollTo + 'px'
            }, 800);
        }
    });

</script>
<script>
    var dataObject = {};

    function getZipCode() {
        dataObject = {};
        let zipCode = parseInt($("#zipcode").val())
        if (!isNaN(zipCode)) {
            dataObject['zipcode'] = zipCode;
        } else {
            errortoast("Please enter a valid zip code to find the consultant.");
            return false;

        }
        fetchData(dataObject)
    }

    function getFullName() {
        dataObject = {};
        let name = $("#fullname").val();
        if (name != "") {
            dataObject['name'] = name;
        } else {
            errortoast("Please enter a valid name to find the consultant.");
            return false;
        }
        fetchData(dataObject)
    }

    function getRepNum() {
        dataObject = {};
        let rep = parseInt($("#repnumber").val())
        if (!isNaN(rep)) {
            dataObject['rep'] = rep;
        } else {
            errortoast("Please enter a valid rep number to find the consultant.");
            return false;
        }
        fetchData(dataObject)
    }

    function chooseConsultant() {

        $.ajax({
            url: "{{ route('add.consultant') }}",
            method: "POST",
            data: {
                id: $('#choose_consultant_id').val(),
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {

                    $('.spn-name').html(
                        data.consultant);
                    $(".spn-image"). attr("src",data.image);

                    successtoast(data.message);
                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

    function fetchData(object) {

        $.ajax({
            url: "{{route('find')}}",
            method: "POST",
            data: {
                req: object,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                var response = JSON.parse(data)
                console.log(response)
                if (response.length > 0) {
                    var html = '';
                    response.forEach(element => {
                        if(element.image!=null){
                        html += `
                            <div class="image-modal-content">
                                <img src="${element.image}"
                                    data-title="${element.name}" data-description="" data-url="${element.email}"
                                    data-id="${element.id}" alt="">
                            </div>
                            `;
                        }
                        else{
                            html += `
                            <div class="image-modal-content">
                                <img src="images/shellie-logo.jpg"
                                    data-title="${element.name}" data-description="" data-url="${element.email}"
                                    data-id="${element.id}" alt="">
                            </div>
                            `;
                        }
                    });
                    $(`#consult`).html(html);

                    // Consultant Modal
                    // all images inside the image modal content class
                    const lightboxImages = document.querySelectorAll('.image-modal-content img');

                    // dynamically selects all elements inside modal popup
                    const modalElement = element =>
                        document.querySelector(`.image-modal-popup ${element}`);

                    const body = document.querySelector('body');

                    // closes modal on clicking anywhere and adds overflow back
                    document.addEventListener('click', () => {
                        body.style.overflow = 'auto';
                        modalPopup.style.display = 'none';
                    });

                    const modalPopup = document.querySelector('.image-modal-popup');

                    // loops over each modal content img and adds click event functionality
                    lightboxImages.forEach(img => {
                        const data = img.dataset;
                        img.addEventListener('click', e => {
                            body.style.overflow = 'hidden';
                            e.stopPropagation();
                            console.log(data.id)
                            modalPopup.style.display = 'block';
                            modalElement('h4').innerHTML = data.title;
                            modalElement('p').innerHTML = data.description;
                            modalElement('#mail').textContent = data.url;
                            modalElement('#mail').href = "mailto:" + data.url;
                            modalElement('img').src = img.src;
                            $('input#choose_consultant_id').val(data.id)
                        });
                    });

                }
                else{
                    $(`#consult`).html(`
                <div class="alert alert-warning">
                    <strong>Darn.</strong> Doesn't look like your search resulted any matches. You can
                    change your search fields or try a different search.
                </div>
                `);
                }
            },
            error: function (error) {
                $(`#consult`).html(`
                <div class="alert alert-warning">
                    <strong>Darn.</strong> Doesn't look like your search resulted any matches. You can
                    change your search fields or try a different search.
                </div>
                `);

            }
        });
    }

    function getKit(kit) {
        $.ajax({
            url: "{{ route('session.kit') }}",
            method: "POST",
            data: {
                kit: kit,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                    $('.kit-name').html(
                        data.name);
                    $('.kit-price').html(
                        data.price
                        );
                        $(".kit-image"). attr("src",data.image);
                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

    $(document).ready(function () {
        // $('#submit12').removeAttr('disabled');
        $('.test').click(function (e) {
            let fname = check_field('first_name');
            let lname = check_field('last_name');
            let dob = check_field('date_of_birth');
            let ssn = check_field('social_security_number');
            let pl = check_select('preferred_language');

            if (fname === true && lname === true && dob === true && pl === true && ssn === true) {
                // $('#submit12').attr('disabled', 'disabled');
                $(".pop").toggle(500);
                $(".shipping_info").toggle(500);
            } else {
                e.preventDefault();
            }
        });

        $('.test1').click(function (e) {
            let bst1 = check_field('bill_street_1');
            let bst2 = check_field('bill_street_2');
            let bpc = check_field('bill_postal_code');
            let bc = check_field('bill_city');
            let bs = check_field('bill_state');
            let bcty = check_field('bill_county');
            let bctry = check_select('bill_country');
            let sst1 = false;
            let sst2 = false;
            let spc = false;
            let sc = false;
            let ss = false;
            let scty = false;
            let sctry = false;
            if(!$("#ship").is(':checked')){
            sst1 = check_field('ship_street_1');
            sst2 = check_field('ship_street_2');
            spc = check_field('ship_postal_code');
            sc = check_field('ship_city');
            ss = check_field('ship_state');
            scty = check_field('ship_county');
            sctry = check_select('ship_country');
            }

            if (bst1 === true && bst2 === true && bpc === true && bc === true && bs === true && bcty === true && bctry === true) {
                if(!$("#ship").is(':checked')){
                    if(sst1 === true && sst2 === true && spc === true && sc === true && ss === true && scty === true && sctry === true){
                        $(".shipping_info").toggle(500);
                        $(".contact_information").toggle(500);

                    }

                }
                else{
                $(".shipping_info").toggle(500);
                $(".contact_information").toggle(500);
                }
            } else {
                e.preventDefault();
            }
        });

        $('.test2').click(function (e) {
            let email = check_field('email');
            let hphone = check_field('hphone');
            let cphone = check_field('cphone');


            if (email === true && hphone === true && cphone === true) {
                // $('#submit12').attr('disabled', 'disabled');

                $(".contact_information").toggle(500);
                $(".payment_information").toggle(500);
            } else {
               e.preventDefault();
            }
        });

        $('.test3').click(function (e) {
            let pm = check_select('pm');
            let bank = check_field('bank');
            let routing = check_field('routing');
            let acc_no = check_field('acc_no');
            let acc_type = check_select('acc_type');

            if (pm === true && bank === true && routing === true && acc_no === true && acc_type === true) {

                $(".payment_information").toggle(500);
                $(".terms_text2").toggle(500);
            } else {
               e.preventDefault();
            }
        });

        // $('.test6').click(function (e) {
        //     let pm = check_select('pm');
        //     let bank = check_field('bank');
        //     let routing = check_field('routing');
        //     let acc_no = check_field('acc_no');
        //     let acc_type = check_select('acc_type');

        //     // if (pm === true && bank === true && routing === true && acc_no === true && acc_type === true) {

        //         $(".terms_text2").toggle(500);
        //         $(".terms_text").toggle(500);
        //     // } else {
        //     //    e.preventDefault();
        //     // }
        // });


        $('.test4').click(function (e) {
            if($("#terms").is(':checked')){
                $("#form").submit();


            } else {
               e.preventDefault();
            }
        });
        $('.test5').click(function (e) {
            if($("#terms").is(':checked')){
                $('.terms_text').addClass('d-none')
                $('.start_selling').removeClass('d-none')


            } else {
               e.preventDefault();
            }
        });


    });

    function check_field(name) {
        // console.log(name);
        // social_security_number
        var ssn_re = new RegExp(/^(?!(000|666|9))\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/);
        var routing_re=new RegExp(/^(\d{9})$/);
        var no_re=new RegExp(/^[0-9]{6,17}$/);
        let field = $("input[name=" + name + "]");


        var value = field.val();
        field.closest('.form-group').find('span.error').length ? field.closest('.form-group').find('span.error')
        .remove() : '';
        if (name == 'social_security_number') {
            console.log(ssn_re.test(field));
            if(!ssn_re.test(value)) {
                field.css({
                    "border": "1px solid red",
                    "padding": "10px"
                });
                field.after('<span style="font-size:13px; color:#900;" class="error">Incorrect SSN pattern i.e: 111-11-1111</span>');
                field.focus();
                return false;
            }
        }
        if (name == 'routing') {
            if(!routing_re.test(value)) {
                field.css({
                    "border": "1px solid red",
                    "padding": "10px"
                });
                field.after('<span style="font-size:13px; color:#900;" class="error">Incorrect Routing number i.e: 111111111</span>');
                field.focus();
                return false;
            }
        }
        if (name == 'acc_no') {
            if(!no_re.test(value)) {
                field.css({
                    "border": "1px solid red",
                    "padding": "10px"
                });
                field.after('<span style="font-size:13px; color:#900;" class="error">Account Number should be between 6 to 17 digits.</span>');
                field.focus();
                return false;
            }
        }
        if (value.length < 1) {
            field.css({
                "border": "1px solid red",
                "padding": "10px"
            });
            field.after('<span style="font-size:13px; color:#900;" class="error">This Field is required</span>');
            field.focus();
            return false;
        } else {
            field.css({
                "border": "2px solid green",
                "padding": "10px"
            });
            return true;
        }
    }

    function change_sponsor() {
        $('.one').removeClass('d-block').addClass('d-none');
        $('.two').removeClass('d-none').addClass('d-block');

    }
    //end of function
    function check_select(name) {
        var field = $("select[name=" + name + "]");
        var value = field.val();
        field.closest('.form-group').find('span.error').length ? field.closest('.form-group').find('span.error').remove() : '';
        if (value == null) {
            field.css({ "border": "1px solid red" });
            field.after('<span style="font-size:13px; color:#900;" class="error">This field is required</span>');
            field.focus();
            return false;
        } else {
            field.css({ "border": "2px solid green", "padding": "5px" });
            return true;
        }
    } //end of function

    $(document).ready(function(){
  // Add smooth scrolling to all links
  $("a.btn.btn-pink").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});

function pickNow(){

    @if(Auth::check())

        window.location = "/pricing"

    @else
        window.location = "/register-consultant"

    @endif
}
</script>

@endsection
