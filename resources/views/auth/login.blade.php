@extends('layout.site.app')
<style>
.user {
    padding: 266px 0px !important
}
.user_options-forms{
    left: -19% !important;
}
.user_options-forms {
    position: absolute;
    top: 50%;
    left: 30px;
    width: calc(50% - 30px);
    min-height: 420px;
    background-color: #1d1d1d;
    border-radius: 3px;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    -webkit-transform: translate3d(100%, -50%, 0);
    transform: translate3d(100%, -50%, 0);
    -webkit-transition: -webkit-transform 0.4s ease-in-out;
    transition: -webkit-transform 0.4s ease-in-out;
    transition: transform 0.4s ease-in-out;
    transition: transform 0.4s ease-in-out, -webkit-transform 0.4s ease-in-out;
    padding: 80px 50px;
    margin: 10px auto !important;
}
.user {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center;
    width: 100%;
    background: url(../images/bg.png) #f6931e center !important;
    background-size: initial;
    padding: 150px 0;
}
@media screen and (max-width: 992px) {
    .user_options-forms{
        width: 100% !important;
        left: -99% !important;
    }

}
</style>
@section('content')
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
                    <h2>Login</h2>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Product Sec -->
<section class="user">
    <div class="user_options-container">
        {{-- <div class="user_options-text">
            <div class="user_options-unregistered">
                <h2 class="user_unregistered-title">Don't have an account?</h2>
                <p class="user_unregistered-text">Banjo tote bag bicycle rights, High Life sartorial cray craft beer
                    whatever street art fap.</p>
                <a href="{{route('register')}}" class="theme-btn">Sign Up</a>
                <a href="{{route('register.consultant')}}" class="theme-btn">Sign Up Consultant</a>


            </div>
        </div> --}}

        <div class="user_options-forms" id="user_options-forms">
            <div class="user_forms-login">
                <h2 class="forms_title">Login</h2>
                <form class="forms_form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <fieldset class="forms_fieldset">
                        <div class="input-container">
                            <input type="text" id="email" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus />
                            <label>{{ __('E-Mail Address') }}</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-container">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" />
                            <label>{{ __('Password') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-container mb-0">
                            <input class="" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                            <label>{{ __('Remember Me') }}</label>
                        </div>
                    </fieldset>
                    <div class="forms_buttons">
                            <button type="submit" class="theme-btn">
                                    {{ __('Login') }}
                            </button>
{{--
                            @if (Route::has('password.request'))
                            <a class="theme-btn" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Product Sec -->
@endsection
