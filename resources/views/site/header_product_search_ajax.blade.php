

            @foreach($products as $key => $product)

            <a href="{{route('product-detail', $product->slug)}}" target="_blank">
                <div class="post">
                    <div class="imgsize">
                        <img src="{{json_decode($product->gallery_images,true)[0]}}" class="img-fluid w-100" alt="">
                    </div>
                    <div class="descriptionopp">
                        <p class="mt-3">{{$product->name}}</p>
                        <p>Price: <span>$ {{$product->sale_price}}</span></p>
                    </div>
                </div>
            </a>


            @endforeach


