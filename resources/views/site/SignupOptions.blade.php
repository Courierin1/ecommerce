@extends('layout.site.app')
@section('title', 'Signup Options')

@section('content')
<style>
    body{
        background: #000
    }
    .plus{
        width: 20px;
        height: 20px;
        border: 1px solid #571e7b;
        line-height: 1;
        border-radius: 50% !important;
        display: inline-block;
    }
</style>
<section class="productsec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center signup-heading border-red">
                <h2 >Choose an option here to signup</h2>
            </div>
            <div class="col-md-6 my-2">
                <div class="bb border-red yellow-bg">
                    <h2 class="p-2" style="background: #f6931e; color : #6d0018">Sign Up As New Member</h2>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto aliquid alias ipsa dolorem possimus cumque minima placeat? Modi, odio blanditiis!</p> --}}
                    <a href="{{ route('register') }}" class="btn btn-signup"> <span class="plus"> + </span> Sign up Here</a>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="bb border-red yellow-bg">
                    <h2 class="p-2" style="background: #f6931e; color : #6d0018">Sign Up As New Consultant</h2>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto aliquid alias ipsa dolorem possimus cumque minima placeat? Modi, odio blanditiis!</p> --}}
                    <a href="{{  route('register.consultant') }}" class="btn btn-signup"><span class="plus"> + </span>  Sign up Here</a>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="bb border-red yellow-bg">
                    <h2 class="p-2" style="background: #f6931e; color : #6d0018">Login As Member (Existing)</h2>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto aliquid alias ipsa dolorem possimus cumque minima placeat? Modi, odio blanditiis!</p> --}}
                    <a href="{{ route('login') }}" class="btn btn-signup"><span class="plus"> + </span >  Login</a>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="bb border-red yellow-bg">
                    <h2 class="p-2" style="background: #f6931e; color : #6d0018">Login As Consultant (Existing)</h2>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto aliquid alias ipsa dolorem possimus cumque minima placeat? Modi, odio blanditiis!</p> --}}
                    <a href="{{ route('consultant-login') }}" class="btn btn-signup"> <span class="plus"> + </span>  Login</a>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection


@section('afterScript')
@endsection
