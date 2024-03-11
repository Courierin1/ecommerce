<div class="cart">
        <div class="cart__overlay"></div>
        <div class="cart__contents">
            <div class="cart__products">
                <h2>Your Cart</h2>
                <p class="microcopy">An overview of your selected products.</p>
                <?php $items = \Cart::session(Auth()->user()->id)->getContent(); ?>
                            @foreach($items as $row)
                <div class="products">
                    <div class="product">
                        <div class="product__1">
                            <div class="product__thumbnail">
                                <img src="{{isset(json_decode($row->associatedModel->gallery_images,true)[0]) ? json_decode($row->associatedModel->gallery_images,true)[0] : ''}}" class="img-fluid" alt="">
                            </div>
                            <div class="product__details">
                                <div style="margin-bottom: 8px;"><b>{{$row->name}}</b></div>
                                <div style="font-size: 90%;">Price: <span class="tertiary">${{$row->price}}</span></div>
                            </div>
                        </div>
                        <div class="product__2">
                            <div>
                                <div class="input input--select input--small">
                                    <label for="size">Quantity</label>
                                    <form action="#" class="d-flex">
                                        <!-- <div class="qtyminus1" onclick='decreaseCount({{$row->id}})'>-</div> -->
                                        <input type="number" name="qty" value="{{$row->quantity}}" min="1" max="{{$row->associatedModel->in_stock}}" class="qty1" disabled>
                                        <!-- <div class="qtyplus1" onclick='increaseCount({{$row->id}})'>+</div> -->
                                    </form>
                                </div>
                            </div>
                            <div class="product__price"><b>${{\Cart::get($row->id)->getPriceSum()}}</b></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="cart__totals">
                <table class="totals">
                    <tbody>
                        <tr>
                            <th class="align-left font-normal tertiary">Subtotal :</th>
                            <td class="align-right">${{\Cart::session(Auth()->user()->id)->getSubTotal()}}</td>
                        </tr>
                       
                        <tr>
                            <th class="align-left">Total :</th>
                            <td class="align-right"><b>${{\Cart::session(Auth()->user()->id)->getTotal()}}</b></td>
                        </tr>
                    </tbody>
                    <tfoot>
                       
                    </tfoot>
                </table>
                <a href="{{route('cart')}}" class="btn four ml-0 theme-btn">View Cart</a>
            </div>
        </div>
    </div>
    <script>
        $('.js-toggle-cart, .cart__overlay').on('click', function() {
    $('.cart').toggleClass('is-hidden');
});
    </script>