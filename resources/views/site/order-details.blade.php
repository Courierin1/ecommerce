<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>



  
<style>
    @font-face {
    font-family: 'Ink Free';
    src: url('/fonts/InkFree.eot');
    src: url('/fonts/InkFree.eot?#iefix') format('embedded-opentype'), url('/fonts/InkFree.woff2') format('woff2'), url('/fonts/InkFree.woff') format('woff'), url('/fonts/InkFree.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
* {
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

body {
  background: #223344;
  font-family: 'Ink Free' !important;
  font-weight: 600;
}
* {
  font-weight: bold;
}

.email-wrapper {
  padding: 24px;
  border-radius: 2px;
  background-color: #000;
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
  width: 200px;
  height: auto;
  margin-bottom: 16px;
}
.email-preheader > .tagline {
  display: block;
  color: #555;
}

.email-title {
  font-size: 21px;
  width: 100%;
  margin-bottom: 15px;
  color: #f6931e;
  text-transform: uppercase;
  border-bottom: 2px solid #f6931e;
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
  color: #333;
  font-size: 16px;
  margin: 0;
  padding: 0;
}

.content-title {
  font-size: 20px;
  color: #555;
  margin-bottom: 8px;
  margin-top: 16px;
}
.address .content-title {
    border-bottom: 2px solid #f6931e;
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
  background-color: #f6931e;
  color: #FFF;
}
.btn.-teal a {
  color: #fff;
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
  color: #fff;
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
  color: #fff;
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
.email-container svg {
    width: 25px;
    margin: 0 auto;
    display: block;
    fill: #f6931e;
}
img.w-25 {
    width: 100px;
}
table.products tr {
    border-top: 1px solid #ccc;
}

table.products tr td {
    padding: 10px 0;
}
table.products th {
    padding: 10px 0;
    text-align: left;
}
table.products.table-responsive {
    width: 100%;
}
table.float-right {
    display: flex;
    justify-content: right;
}
table.ship {
    width: 100%;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    display: flex;
    justify-content: right;
}

table.ship tr td {
    padding: 5px 0 10px 10px;
}
img.w-25 {
    width: 100px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 3px 3px 6px #ccc;
}
table.order tr td {
    padding-right: 20px;
}
</style>
</head>
<body>
  


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class='email-wrapper'>
  <div class='email-preheader'>
  <img src="https://staging2.yourdesigndemo.net/images/shellie-logo.jpg" class="img-fluid" alt="logo image">
  </div>
  <div class='container'>
  <div class='email-container'>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm0 400H48V80h352v352zm-35.864-241.724L191.547 361.48c-4.705 4.667-12.303 4.637-16.97-.068l-90.781-91.516c-4.667-4.705-4.637-12.303.069-16.971l22.719-22.536c4.705-4.667 12.303-4.637 16.97.069l59.792 60.277 141.352-140.216c4.705-4.667 12.303-4.637 16.97.068l22.536 22.718c4.667 4.706 4.637 12.304-.068 16.971z"/></svg>
      <h4 class='tagline text-center'><strong>Thank you for your order</strong></h4>
    <div class='email-title'>
      order summary
    </div>
    <div>
 
    </div>
    <table class="order">
      <tr>
        <td class="text-muted">Order Ref:</td>
        <td>{{$order->order_id}}</td>
      </tr>
      <tr>
        <td class="text-muted">Paid with:</td>
        <td>PayPal</td>
      </tr>
      <tr>
        <td class="text-muted">Order Date:</td>
        <td>{{date('d/M/Y',strtotime($order->created_at))}}</td>
      </tr>
      <tr>
        <td class="text-muted">No. of Items:</td>
        <td>{{$order->orderProducts->count()}}</td>
      </tr>
      <tr>
        <td class="text-muted">Grand Total:</td>
        <td>${{number_format($order->grand_total,2)}}</td>
      </tr>
    </table>
    <div class='row'>
      <div class='col-md-6'>
        <div class='address'>
          <div class='content-title'>
            <strong>Billing address:</strong>
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
            <strong>Shipping address:</strong>
          </div>
          <p class='text'>Street 1:
           {{$order->ship_street_1}}
          </p>
          <p class='text'>Street 2:
          {{$order->ship_street_2}}
          </p>
          <p class='text'>City:
          {{$order->ship_city}}, {{$order->ship_postal_code}}
          </p>
          <p class='text'>State:
          {{$order->ship_state}}
          </p>
          <p class='text'>Country:
          {{$order->ship_country}}
          </p>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-12'>
        <div class='content-title -centered'>
          <h4><strong>Products</strong></h4>
        </div>
      </div>
    </div>

    <table class="products table-responsive" id="countit">
      <thead>
        <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->orderProducts as $product)
            @if($order->is_kit==0)
        <tr>
            <td><img src="{{isset(json_decode($product->product['gallery_images'] ?? '',true)[0]) ? json_decode($product->product['gallery_images'] ?? '',true)[0] :  ''}}" class="w-25" alt="product-img"></td>
            <td>{{$product->name}}</td>
            <td>{{$product->qty}}</td>
            <td>${{$product->price}}</td>
        </tr>
        @else
        <tr>
          <td><img src="{{ isset($product->kit['image']) ? $product->kit['image'] : 'images/product-img.png' }}" class="w-25" alt="product-img"></td>
          <td>{{$product->name}}</td>
          <td>1</td>
          <td>${{$product->price}}</td>
        </tr>
        @endif
        @endforeach
      </tbody>
    
    </table>
    <table class="ship">
    @if(isset($order->shipping) && $order->is_kit==0)
      <tr>
        <td>Shipping Charges:</td>
        <td> ${{number_format($order->shipping,2)}}</td>
      </tr>
    @endif  
      @if(isset($order->coupon))
      <tr>
        <td>Coupon Discount:</td>
        <td>{{$order->coupon['discount']}}%</td>
      </tr>
      @endif
      @if(isset($order->note))
      <tr>
        <td>Order Note</td>
        <td>{{$order->note}}</td>
      </tr>
      @endif
      <tr>
        <td>Total Amount:</td>
        <td>${{$order->grand_total}}</td>
      </tr>
    </table>

    <table>

    </table>
 
    </div>

</div>

    <div class='btn-container'>

      <div class='btn -teal'>
       <a href="{{route ('home')}}" class="text-white">Back</a>
      </div>
    </div>
    <div class='row'>
    <div class='email-footer'>
    <div class='link'>
      <a class='title' href="{{route('contact-us')}}">Contact Us</a>
      <a class='title' href='#'>Return Policy</a>
      <a class='title' href='#'>Privacy Policy</a>
    </div>
    <div class='copywrite'>
      <p>© 2022 Chiritian-Creations-Unlimited. All Rights Reserved.</p>
    </div>
  </div>
    </div>
  </div>

</div>

</body>
</html>






