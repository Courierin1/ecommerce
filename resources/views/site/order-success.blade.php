@extends('layout.site.app')
@section('title', 'Home')

@section('content')

<section class="py-md-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Your Order Has Been Placed</h2>
        <h3 class="text-center">Thank you for your Order, it’s processing</h3>

        <p class="text-center">Your order # is: {{$order->order_id}}</p>
        <p class="text-center">You will receive an order confirmation email with details of your order.</p>
        <center>
          <div class="btn-group" style="margin-top:20px;">
            <a href="{{route('home')}}" class="btn btn-lg theme-btn">CONTINUE</a>
          </div>
        </center>
      </div>
    </div>
  </div>
</section>

@endsection