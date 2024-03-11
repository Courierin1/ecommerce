<style>

* {
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

body {
  background: #223344;
  display: flex;
  justify-content: center;
  font-family: "Open Sans", sans-serif;
}

.email-wrapper {
  width: 600px;
  margin: 80px 0;
  padding: 24px;
  border-radius: 2px;
  background-color: #F3F3F3;
  position: relative;
}

.email-container {
  width: auto;
  padding: 24px;
  border-radius: 2px;
  background-color: #FFF;
}

.email-preheader {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.email-preheader > img {
  width: 105px;
  height: auto;
  margin-bottom: 16px;
}
.email-preheader > .tagline {
  display: block;
  color: #555;
}

.email-title {
  font-size: 21px;
  text-align: center;
  width: 100%;
  margin-bottom: 24px;
  color: #595959;
  text-transform: uppercase;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.content > .name {
  font-size: 18px;
  color: #555;
  margin: 8px 0;
  font-weight: bold;
}
.content > .description {
  color: #595959;
  text-align: center;
}
.content > .note {
  font-size: 12px;
  font-style: italic;
  color: #595959;
  margin-top: 16px;
}
.content > .earn {
  color: #30ADA5;
  font-size: 18px;
  font-weight: bold;
}

.col-title {
  color: #555;
  font-size: 13px;
}

.col-text {
  margin-top: 4px;
  font-weight: bold;
  font-size: 13px;
  color: #888;
}
.col-text.-main {
  color: #d00;
}

.address {
  margin-top: 16px;
}
.address > .text {
  color: #888;
  font-size: 13px;
  margin: 0;
  padding: 0;
}

.content-title {
  font-size: 16px;
  color: #555;
  text-transform: uppercase;
  margin-bottom: 8px;
  margin-top: 16px;
}
.content-title.-centered {
  text-align: center;
}

.content-area {
  color: #888;
  text-align: justify;
  font-size: 13px;
  line-height: 20px;
}

.col-xs-15,
.col-sm-15,
.col-md-15,
.col-lg-15 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.col-xs-15 {
  width: 20%;
  float: left;
}

@media (min-width: 768px) {
  .col-sm-15 {
    width: 20%;
    float: left;
  }
}
@media (min-width: 992px) {
  .col-md-15 {
    width: 20%;
    float: left;
  }
}
@media (min-width: 1200px) {
  .col-lg-15 {
    width: 20%;
    float: left;
  }
}
.artwork-card {
  border: 1px solid #B1C4C9;
  border-radius: 3px;
  box-shadow: 0 1px 2px 0 rgba(232, 241, 243, 0.5);
  background: white;
  width: 225px;
  display: flex;
  flex-direction: column;
  margin-bottom: 16px;
}
.artwork-card > .artwork-card-info {
  padding: 10px;
  text-align: left;
}
.artwork-card > .shipping-info {
  margin: 0 10px;
  padding: 10px 0;
  text-align: left;
  border-top: 1px solid #B1C4C9;
}

.shipping-info .subject {
  font-size: 12px;
  text-transform: capitalize;
  color: #78949C;
}
.shipping-info > .info {
  position: relative;
}
.shipping-info .price {
  position: absolute;
  font-weight: 700;
  top: 0;
  right: 0;
  color: #227097;
  font-size: 12px;
}
.shipping-info .logo {
  width: 40px;
  position: absolute;
  right: 0;
  bottom: 0;
}
.shipping-info img {
  width: 100%;
  height: 100%;
}

.artwork-card-info > .title {
  font-size: 16px;
  font-weight: bold;
  color: #234;
}
.artwork-card-info > .info {
  position: relative;
}
.artwork-card-info .subject {
  font-size: 12px;
  text-transform: capitalize;
  color: #78949C;
}
.artwork-card-info .price {
  position: absolute;
  font-weight: 700;
  top: 0;
  right: 0;
  color: #30ada4;
  font-size: 12px;
}

.artwork-card-image {
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  width: 100%;
  height: 235px;
}
.artwork-card-image > img {
  height: 100%;
  object-fit: cover;
  width: 100%;
}

.btn {
  padding: 16px 24px;
  font-size: 13px;
  border-radius: 2px;
  font-weight: bold;
}
.btn.-teal {
  background-color: #30ADA5;
  color: #FFF;
}

.btn-container {
  margin-top: 32px;
  display: flex;
  justify-content: center;
}

.email-footer {
  padding: 20px;
  color: #4F5E66;
  font-size: 13px;
  font-weight: 400;
}
.email-footer > .link {
  display: flex;
  justify-content: center;
  align-items: center;
}
.email-footer > .link > .title {
  margin-bottom: 10px;
  color: #4F5E66;
}
.email-footer > .link > .title:hover, .email-footer > .link > .title:focus {
  color: #223344;
  text-decoration: none;
}
.email-footer > .link > .title:nth-child(n+2), .email-footer > .address > .name:nth-child(n+2) {
  margin-left: 10px;
  border-left: 1px solid #DCE7EA;
  padding-left: 10px;
}
.email-footer p {
  margin: 0 0 10px;
}
.email-footer > .email {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.email-footer > .copywrite {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.email-footer > .address {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class='email-wrapper'>
  <div class='email-preheader'>
  <img src="{{asset('images/shellie-logo.jpg')}}" class="img-fluid" alt="">
    <p class='tagline'>Thank you for your order</p>
  </div>
  <div class='email-container'>
    <div class='email-title'>
      order summary
    </div>
    <div class='row'>
      <div class='col-md-15'>
        <small class='col-title'>Order Ref.</small>
        <div class='col-text -main'>{{$order->order_id}}</div>
      </div>
      <div class='col-md-15'>
        <small class='col-title'>Paid with</small>
        <div class='col-text'>PayPal</div>
      </div>
      <div class='col-md-15'>
        <small class='col-title'>Order Date</small>
        <div class='col-text'>{{date('d/M/Y',strtotime($order->created_at))}}</div>
      </div>
      <div class='col-md-15'>
        <small class='col-title'>No. of Items</small>
        <div class='col-text'>{{$order->orderProducts->count()}}</div>
      </div>
      <div class='col-md-15'>
        <small class='col-title'>Grand Total</small>
        <div class='col-text'>${{number_format($order->grand_total,2)}}</div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-6'>
        <div class='address'>
          <div class='content-title'>
            Billing address
          </div>
          <p class='text'>
           {{$order->bill_street_1}}
          </p>
          <p class='text'>
          {{$order->bill_street_2}}
          </p>
          <p class='text'>
          {{$order->bill_city}}, {{$order->bill_postal_code}}
          </p>
          <p class='text'>
          {{$order->bill_state}}
          </p>
          <p class='text'>
          {{$order->bill_country}}
          </p>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='address'>
          <div class='content-title'>
            Shipping address
          </div>
          <p class='text'>
           {{$order->ship_street_1}}
          </p>
          <p class='text'>
          {{$order->ship_street_2}}
          </p>
          <p class='text'>
          {{$order->ship_city}}, {{$order->ship_postal_code}}
          </p>
          <p class='text'>
          {{$order->ship_state}}
          </p>
          <p class='text'>
          {{$order->ship_country}}
          </p>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-12'>
        <div class='content-title -centered'>
         Products Ordered
        </div>
      </div>
    </div>
    <div class='row'>
        @foreach($order->orderProducts as $product)
            @if($order->is_kit==0)
      <div class='col-md-6'>
        <div class='artwork-card'>
          <div class='artwork-card-image'>
         
            <img src="{{json_decode($product->product['gallery_images'],true)[0]}}" alt="product-img">
          
          </div>
          <div class='artwork-card-info'>
            <div class='title'>
             {{$product->name}}
            </div>
            <div class='info'>
              
              <div class='subject'>
                {!! $product->product['short_description'] !!}
              </div>
              <div class='price'>
                ${{$product->price}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class='col-md-6'>
        <div class='artwork-card'>
          <div class='artwork-card-image'>
         
            <img src="{{asset('images/product-img.png')}}" alt="product-img">
          
          </div>
          <div class='artwork-card-info'>
            <div class='title'>
             {{$product->name}}
            </div>
            <div class='info'>
              
              <div class='subject'>
                {!! $product->kit['description'] !!}
              </div>
              <div class='price'>
                ${{$product->price}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    @endif
      @endforeach
    <div class='row'>
      <div class='col-md-12'>
        <div class='content-title -centered'>
         SHIPPING CHARGES
        </div>
        <div class='content-area text-center'>
            ${{number_format($order->shipping,2)}}
        </div>
      </div>
    @if(isset($order->note))
    <div class='col-md-12'>
        <div class='content-title -centered'>
         Order Note
        </div>
        <div class='content-area text-center'>
            {{$order->note}}
        </div>
      </div>
   
    @endif
    </div>
    
  </div>

