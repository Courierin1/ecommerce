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
                                    @if(\Cart::session('sessioncart)->isEmpty())
                                        <td></td>
                                        <td></td>
                                        <td style="color:red;font-size:30px;font-weight:bold">No Products Available!</td>
                                        </td></td>
                                        @else
                                        <?php $items = \Cart::session('sessioncart)->getContent(); ?>
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
                                                            src="{{isset(json_decode($row->associatedModel->gallery_images,true)[0]) ? json_decode($row->associatedModel->gallery_images,true)[0] : ''}}" alt="cart-product"></a>
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
                                                <input type='text' id="{{$row->id}}" value="{{$row->quantity}}">
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
                                <button class="continue__shopping--clear" onclick="javascript:clearCart();">Clear Cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__summary border-radius-10">


                            <div class="cart__summary--total mb-20">
                                <table class="cart__summary--total__table">
                                    <tbody>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">SUBTOTAL</td>
                                            <td class="cart__summary--amount text-right">${{\Cart::session('sessioncart)->getSubTotal()}}</td>
                                        </tr>
                                        <!-- <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">GRAND TOTAL</td>
                                            <td class="cart__summary--amount text-right">${{\Cart::session('sessioncart)->getTotal()}}</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart__summary--footer">
                                <p class="cart__summary--footer__desc">Shipping &amp; taxes calculated at checkout
                                </p>
                                <ul class="d-flex justify-content-between p-0">
                                    <li><a class="primary__btn checkout theme-btn" href="{{route('checkout')}}">Check
                                            Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
