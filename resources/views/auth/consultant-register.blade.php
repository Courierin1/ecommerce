@extends('layout.site.app')

@section('content')
<style>
    .input-container > p > strong {
        color: #fff;
        font-size: 14px;
        font-weight: 300;
    }
    .user_options-forms{
        left : 25% !important;
    }
</style>
<!-- Coins sec -->
<!-- Banner Section -->
<!-- Banner Section -->
{{-- <section class="innerbanner">
    <div class="inner-image">
        <img src="images/jwelleryforparty.png" class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Signup</h2>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Product Sec -->
<section class="user1 bg-img">
    <div class="user_options-container">

        <div class="user_options-forms bounceLeft" id="user_options-forms">
            <div class="user_forms-signup">
                <h2 class="forms_title">{{ __('Consultant Register') }}</h2>
                <form class="forms_form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <fieldset class="forms_fieldset">
                        {{-- <!-- username -->
                        <div class="input-container">
                            <input id="user_name" type="text" class=" @error('user_name') is-invalid @enderror" name="user_name"
                                value="{{ old('user_name') }}" required autocomplete="user_name">

                            @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>{{ __('User Name') }}</label>
                            <p class="pt-1"><strong>Must be at least 8 characters. You may use letters, numbers and @ . + - _ characters.</strong></p>


                        </div> --}}
                        <!-- email -->
                         <input type="hidden" name="role" value="3">
                        <div class="input-container">
                            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>{{ __('E-Mail Address') }}</label>
                        </div>
                        <!-- name -->
                        <div class="input-container">
                            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>Full Name</label>
                        </div>
                        <!-- phone -->
                        <div class="input-container">
                            <input type="text" id="phone" class=" @error('phone') is-invalid @enderror" name="phone"required="" autocomplete="phone"  />
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>Phone</label>
                        </div>
                        <!-- address -->
                        <div class="input-container">
                            <input type="text" id="address" class=" @error('address') is-invalid @enderror" name="address"required="" autocomplete="address" />
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>Address</label>
                        </div>
                        <!-- alt address -->
                        <div class="input-container">
                            <input type="text" id="alt_address" class=" @error('alt_address') is-invalid @enderror" name="alt_address" autocomplete="alt_address" />
                            @error('alt_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>Address2</label>
                        </div>
                        <div class="row">
                            <!-- zip -->
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="input-container">
                                    <input type="text" id="zip" class=" @error('zip') is-invalid @enderror" name="zip"required="" autocomplete="zip" />
                                    @error('zip')
                                    <span id="zipcode_error"class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Zip Code</label>
                                </div>
                            </div>
                            <!-- city -->
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="input-container">
                                    <input type="text" id="city" class=" @error('city') is-invalid @enderror" name="city"required="" autocomplete="city"  />
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>City</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- state -->
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="input-container">
                                    <input type="text" id="state" class=" @error('state') is-invalid @enderror" name="state"required="" autocomplete="state"  />
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>State</label>
                                </div>
                            </div>
                            <!-- country -->
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="input-container">
                                    <input type="text" id="country" class=" @error('country') is-invalid @enderror" name="country"required="" autocomplete="country"  />
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Country</label>
                                </div>
                            </div>

                        </div>
                        <!-- password -->
                        <div class="input-container">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label>{{ __('Password') }}</label>
                        </div>
                        <!-- confirm password -->
                        <div class="input-container">
                            <input id="password-confirm" type="password" class="" name="password_confirmation" required
                                autocomplete="new-password">
                            <label>{{ __('Confirm Password') }}</label>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" required id="flexCheckDefault" style="margin-top: 22px">
                                    <label class="" for="flexCheckDefault" style="color: #fff; font-size : 15px">
                                      I agree to the <a href="{{route('privacy-policy')}}">Privacy policy</a>
                                    </label>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" required id="flexCheckDefault" style="margin-top: 18px">
                                    <label class="" for="flexCheckDefault" style="color: #fff; font-size : 15px">
                                      I agree to the <a href="{{route('compansation-policy')}}">Compensation policy</a>
                                    </label>
                                  </div>
                            </div>
                        </div>



                    </fieldset>
                    <div class="forms_buttons">
                        <button type="submit" class="theme-btn">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="user_options-text bounceRight">

            <div class="user_options-registered">
                <h2 class="user_registered-title">Have an account?</h2>
                <p class="user_registered-text">Banjo tote bag bicycle rights, High Life sartorial cray craft beer
                    whatever street art fap.</p>
                <a href="{{route('login')}}" class="theme-btn">Login</a>
            </div>
        </div> --}}
    </div>
</section>


@endsection

@section('afterScript')
<script type="text/javascript">

    $("#zip").keyup(function(){
        var zipcode = parseInt($(this).val());
        if($(this).val().length >= 5)
        {
            if(!Number.isNaN(zipcode))
            {
                $.ajax({
                    url: `/api/zip/${zipcode}`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        if(res.success){
                            let {city, state, state_fullname} = res.success;
                            $('#city').val(city)
                            $('#state').val(state_fullname)
                            $('#country').val("United States")
                            console.log(city, state, state_fullname);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            }
            else{
                console.log("Given input is not a zip code");
            }
        }
    });
</script>
@endsection
