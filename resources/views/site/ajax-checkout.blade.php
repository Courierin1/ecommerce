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
                                            @foreach(\Cart::session(Auth()->user()->id)->getContent() as $order)
                                            <tr>
                                                <td>{{$order->name}}</td>
                                                <td>${{$order->price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <td>Cart Subtotal</td>
                                                <td>${{\Cart::session(Auth()->user()->id)->getSubTotal()}}</td>
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
                                            <?php $cpn=\Cart::session(Auth()->user()->id)->getTotal()*(Session::get('coupon')['discount']/100) ?>
                                            <tr class="order-total">
                                            <td>Coupon (<a href="javascript:removeCoupon();"><small style="color:red;">Remove</small></a>)</td>
                                                <td>${{$cpn}}</td>
                                            </tr>
                                            @endif

                                            <tr class="order-total">
                                                <td>Order Total</td>
                                                <td>${{\Cart::session(Auth()->user()->id)->getTotal()-($cpn?? 0)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                