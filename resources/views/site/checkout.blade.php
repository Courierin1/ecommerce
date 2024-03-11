@extends('layout.site.app')
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {


    })


    </script>

@section('title', 'Checkout')

@section('content')
<!-- Coins sec -->
<!-- Banner Section -->
<!-- Banner Section -->
<section class="innerbanner">

    <div class="inner-image">
        <img src="images/shopbanner.png " class="img-fluid w-100" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="innercaption">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section -->
<!-- Banner Section -->


<!-- Product Sec -->
<div class="main-content-wrapper">
    <div class="checkout-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Area Start -->
                    <div class="checkout-area ptb--60">
                        <div class="row">
                            <div class="col-12">
                            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p><strong>Errors!</strong></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                            </div>
                            <div class="col-lg-7">
                                <div class="custom-title">
                                    <h2>Billing Details</h2>
                                </div>

                                <div class="checkout-form">
                                    {{-- <form action="{{route('payment')}}" method="post" class="form"> --}}
                                        {{-- <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"> --}}
                                            <form role="form" method="POST" id="paymentForm">

                                        @csrf
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="first_name" class="zeref-input-form"
                                                    placeholder="First Name *" value="{{Auth::user()->detail['first_name'] ?? ''}}" disabled>
                                            </div>
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="last_name" class="zeref-input-form"
                                                    placeholder="Last Name *" value="{{Auth::user()->detail['last_name'] ?? ''}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-md-12">
                                                <input type="email" required name="email" class="zeref-input-form"
                                                    placeholder="Email *" value="{{Auth::user()->email ?? ''}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="bill_city" class="zeref-input-form"
                                                    placeholder="City *" value="{{Auth::user()->detail['bill_city'] ?? ''}}">
                                            </div>
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="bill_state" id="state"
                                                    class="zeref-input-form" placeholder="State *" value="{{Auth::user()->detail['bill_state'] ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="bill_postal_code" id="zip" class="zeref-input-form"
                                                    placeholder="Zip Code *" value="{{Auth::user()->detail['bill_postal_code'] ?? ''}}">
                                            </div>
                                            <div class="zeref-form-group col-md-6">
                                                <select class="country_select" name="bill_country">
                                                    <option value="" disabled>---Please Select---</option>
                                                    <option value="USA" {{Auth::user()->detail['bill_country']=='USA' ? 'selected' : ''?? ''}}>United States</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-12">
                                                <input type="text" name="bill_street_1" class="zeref-input-form"
                                                    placeholder="Address *" value="{{Auth::user()->detail['bill_street_1'] ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-12">
                                                <input type="text" name="bill_street_2" class="zeref-input-form"
                                                    placeholder="Apartment, suite, unit etc. *" value="{{Auth::user()->detail['bill_street_2'] ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="cphone" class="zeref-input-form"
                                                    placeholder="Telephone *" value="{{Auth::user()->detail['cphone'] ?? ''}}">
                                            </div>
                                            <div class="zeref-form-group col-md-6">
                                                <input type="text" name="fax" class="zeref-input-form"
                                                    placeholder="Fax" value="{{Auth::user()->detail['fax'] ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="zeref-form-group col-12">
                                                <textarea class="zeref-input-form zeref-input-form--textarea" rows="5"
                                                    id="orderNotes" name="note"
                                                    placeholder="Notes about your order, e.g. special notes for delivery.">{{old('orderNotes')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="zeref-form-group col-12">

                                        <input type="checkbox" name="update">
                                        <labe>  Update Your Current Billing Address To This Address?</label>

                                            </div>
                                        </div>
                                        <!-- <input type="submit" value="Submit Order" class="theme-btn" name="" id=""> -->

                                </div>
                            </div>
                            <div class="col-lg-5 mt-md--30" >
                                <div id="paste">
                                <div class="custom-title">
                                    <h2>Your Order</h2>
                                </div>
                                <div class="order-details mb--30">
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\Cart::session('sessioncart')->getContent() as $order)
                                            <tr>
                                                <td>{{$order->name}}</td>
                                                <td>${{$order->price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <td>Cart Subtotal</td>
                                                <td>${{\Cart::session('sessioncart')->getSubTotal()}}</td>
                                            </tr>
                                            @if($site->shipping>0)
                                            <tr class="cart-subtotal">
                                                <td>Shipping</td>
                                                <td>${{$site->shipping}}</td>
                                            </tr>
                                            @endif
                                            @if(!Session::has('coupon'))
                                            <tr>
                                            <td>   <div class="coupon__code mb-30">
                               <h3 class="coupon__code--title">Coupon</h3>
                                <p class="coupon__code--desc">Enter your coupon code if you have one.</p></td>
                                <td> <div class="coupon__code--field">
                                    <label>
                                        <input class="coupon__code--field__input border-radius-5"
                                            placeholder="Coupon code" name="coupon" id="coupon" type="text">
                                    </label>
                                    <a href="javascript:applyCoupon();" class="theme-btn">Apply</a>
                                </div>
                                 </div></td>

                                            </tr>
                                            @else
                                            <?php $cpn=\Cart::session('sessioncart')->getTotal()*(Session::get('coupon')['discount']/100) ?>
                                            <tr class="order-total">
                                                <td>Coupon (<a href="javascript:removeCoupon();"><small style="color:red;">Remove</small></a>)</td>
                                                <td>${{$cpn}}</td>
                                            </tr>
                                            @endif
                                            <tr class="order-total">
                                                <td>Order Total</td>
                                                <td>${{\Cart::session('sessioncart')->getTotal()-($cpn ?? 0)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                                {{-- <div class="checkout-payment"> --}}

                                    {{-- <button type="submit" class="btn btn-warning"><img src="images/download.svg" alt=""> Checkout</button> --}}
                                    @foreach (['danger', 'success'] as $status)
                                        @if(Session::has($status))
                                            <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                        @endif
                                    @endforeach
<div id="card-element">
    <div>
        <label for="card-number">Card Number</label>
        <div id="card-number"></div>
    </div>

</div>

                                        {{-- <button class="subscribe btn btn-primary btn-block" type="submit"> Confirm </button> --}}
                                        <button type="button" class="btn btn-primary btn-block" id="submitPaymentForm"style="
                                        margin-top: 20px;
                                    ">Confirm</button>

                                        </form>
                                     </div>


                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Checkout Area End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Sec -->
@endsection


@section('afterScript')

<script>
    $(document).ready(function(){
        var stripe = Stripe('pk_test_51MmZDEI9ULwTCm44vOW5zUvqSWyg11m2y9zPKr3LbEcZmAa5sTJXg0ym3OhPBwcPRT84F9ezVV2PJCAW18lwq7vk009NI3EiLw'); // Replace with your actual publishable key
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-number');
    $('#submitPaymentForm').on('click', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    var token = result.token.id;
                    // alert(token);

                    // Collect the form data
                    var formData = new FormData($('#paymentForm')[0]);

                    // Append the token to the form data
                    formData.append('stripeToken', token);

                    // Send the form data to your Laravel controller via AJAX
                    $.ajax({
                        url: '<?php echo route("payment"); ?>' ,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                // alert('Payment successful!');
                                location.href = data.response;
                                // Optionally, you can redirect or perform other actions here
                            } else {
                                alert('Payment failed.');
                            }
                        },
                        error: function(error) {
                            console.error('Error: ' + error.responseText);
                        }
                    });
                }
            });
        });
    });
</script>




<script>
 function applyCoupon(){
    var val=$('#coupon').val();
    if(val==""){
        errortoast('Please Enter A Valid Coupon Code');
        return false;
    }
    $.ajax({
            url: "{{ route('apply.coupon') }}",
            method: "POST",
            data: {
                code: val,
                _token: "{{ csrf_token() }}",

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#paste').html(data.view);


                }
                else if (data.status == 2) {
                    successtoast(data.message);

                }
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });


 }

 function removeCoupon(){
    $.ajax({
            url: "{{ route('remove.coupon') }}",
            method: "GET",
            data: {

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#paste').html(data.view);


                }
                else if (data.status == 2) {
                    successtoast(data.message);

                }
                else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });


 }


</script>
@endsection
