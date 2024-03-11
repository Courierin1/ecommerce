@extends('layout.site.app')
@section('title', 'Cart')

@section('content')
<!-- Coins sec -->
<!-- Banner Section -->
<div class="container">
@if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
</div>
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
<section class="cart__section section--padding">
    <div class="container">
        <div class="cart__section--inner">
            <form action="#">
                <h2 class="cart__title mb-40">Shopping Cart</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list">Quantity</th>
                                        <th class="cart__table--header__list">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    <tr class="cart__table--body__items">
                                        @if(\Cart::session('sessioncart')->isEmpty())
                                        <td></td>
                                        <td></td>
                                        <td style="color:red;font-size:30px;font-weight:bold">No Products Available!</td>
                                        </td></td>
                                        @else
                                        <?php $items = \Cart::session('sessioncart')->getContent(); ?>
                                        @foreach($items as $row)
                                        <td class="cart__table--body__list">
                                            <div class="cart__product d-flex align-items-center">
                                                <button class="cart__remove--btn" aria-label="search button"
                                                    type="button" onclick="removeProduct({{$row->id}})">
                                                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" width="16px" height="16px">
                                                        <path
                                                            d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <div class="cart__thumbnail">
                                                    <a href="product-details.html"><img class="border-radius-5"
                                                            src="{{isset(json_decode($row->associatedModel->gallery_images,true)[1]) ? json_decode($row->associatedModel->gallery_images,true)[1] : ''}}" alt="cart-product"></a>
                                                </div>
                                                <div class="cart__content">
                                                    <h4 class="cart__content--title"><a
                                                            href="product-details.html">{{$row->name}}</a></h4>
                                                            @foreach($row->attributes as $attr)
                                                    <span class="cart__content--variant">{{$attr}}</span>

                                                            @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price">${{$row->price}}</span>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <div class='counter'>
                                                <div class='down' onclick='decreaseCount({{$row->id}})'>-</div>
                                                <input type='number' id="{{$row->id}}" min="1" max="{{$row->associatedModel->in_stock}}" value="{{$row->quantity}}" disabled>
                                                <div class='up' onclick='increaseCount({{$row->id}})'>+</div>
                                            </div>
                                        </td>
                                        <td class="cart__table--body__list">
                                            <span class="cart__price end" id="sum{{$row->id}}">${{\Cart::get($row->id)->getPriceSum()}}</span>
                                        </td>
                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="{{route('shop')}}">Continue shopping</a>
                                <a class="continue__shopping--clear" onclick="javascript:clearCart();">Clear Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__summary border-radius-10">

                            <!-- <div class="cart__note mb-20">
                                <h3 class="cart__note--title">Note</h3>
                                <p class="cart__note--desc">Add special instructions for your seller...</p>
                                <textarea class="cart__note--textarea border-radius-5"></textarea>
                            </div> -->
                            <div class="cart__summary--total mb-20">
                                <table class="cart__summary--total__table">
                                    <tbody>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">SUBTOTAL</td>
                                            <td class="cart__summary--amount text-right">${{\Cart::session('sessioncart')->getSubTotal()}}</td>
                                        </tr>
                                        <!-- <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">GRAND TOTAL</td>
                                            <td class="cart__summary--amount text-right">${{\Cart::session('sessioncart')->getTotal()}}</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart__summary--footer">
                                <p class="cart__summary--footer__desc">Shipping &amp; taxes calculated at checkout
                                </p>
                                <ul class="d-flex justify-content-bet
                                een p-0">
                                    @if(\Cart::session('sessioncart')->isEmpty())
                                    <li><a class="primary__btn checkout theme-btn" data-toggle="modal" data-target="#exampleModal">Check
                                            Out</a></li>
                                    @else
                                    <li><a class="primary__btn checkout theme-btn" href="{{route('checkout')}}">Check
                                            Out</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:red;">WARNING</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 style="color:red;">Can Not Checkout When Cart Is Empty!</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Sec -->
@endsection


@section('afterScript')
<script type="text/javascript">
function clearCart(){

        $.ajax({
            url: "{{ route('clear.cart') }}",
            method: "GET",
            data: {

            },
            success: function (data) {
                if (data.status == 1) {
                    $(".cart__section--inner").html(data.view);
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

function decreaseCount(id){

    var count=$("#"+id).val();
    if(count == 1){

        errortoast('Can not be zero!');
    }
    else{
    $.ajax({
            url: "{{ route('minus.quantity') }}",
            method: "GET",
            data: {
               id:id,
            },
            success: function (data) {
                if (data.status == 1) {
                    $(".cart__section--inner").html(data.view);


                } else {
                    errortoast('something went wrong');
                }
            },
            error: function (error) {
                errortoast('something went wrong');

            }
        });
    }

}

function increaseCount(id){

    $.ajax({
            url: "{{ route('plus.quantity') }}",
            method: "GET",
            data: {
                id:id,
            },
            success: function (data) {
                if (data.status == 1) {
                    $(".cart__section--inner").html(data.view);


                }
                else if (data.status == 2){
                    errortoast(data.message);
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

function removeProduct(id){
    $.ajax({
            url: "{{ route('remove.product') }}",
            method: "GET",
            data: {
                id:id,
            },
            success: function (data) {
                if (data.status == 1) {
                    $(".cart__section--inner").html(data.view);


                } else {
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
