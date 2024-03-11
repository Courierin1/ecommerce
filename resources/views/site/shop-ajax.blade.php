
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row">

        @foreach($products as $product)
        @php
$price=0;
if ($user == 1) {
    $price=$product->sale_price;
}else {
     switch($product->categories[0]->slug){
            case 'earrings':
            $price=4.44;
                break;
            case 'bracelets':
            $price=8.88;
                break;
            case 'necklaces':
            $price=8.88;
                break;
            case 'earrings-necklace-sets':
            $price=14.44;
                break;
            case 'earrings-necklace':
            $price=14.44;
                break;
            case 'earrings--necklace':
            $price=14.44;
                break;



        }
}
        // dd($product->categories[0]->slug);
        @endphp
        <div class="col-md-4 col-sm-6 col-xs-12">
            <a href="/product-detail/{{$product->slug}}">
                <div class="product-image">
                    @if(isset(json_decode($product->gallery_images,true)[1]))
                    <img src="{{ json_decode($product->gallery_images,true)[1] }}" alt="">
                    @else
                    <img src="{{ asset('admin_assets/assets/img/null_thumbnail.png') }}" alt="">
                   @endif
                    <h4>{{$product->name}}</h4>
                    </a>
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <p>$ {{$price}}</p>
                        </div>

                        <div class="col-sm-6 col-6 d-flex justify-content-end ">
                            <button class="btn btn-addToCart"
                            onclick="javascript:addToCart('{{$product->product_id}}');"

                            /* @if($is_auth == "1")
                            @else

                                onclick="javascript:window.location='/login'"
                            @endif */
                            >
                            Add
                            </button>
                        </div>
                    </div>
                </div>

        </div>
        @endforeach
    </div>
</div>
@if (method_exists($products, 'links'))
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@endif
