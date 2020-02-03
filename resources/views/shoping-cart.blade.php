@extends('layouts/index')

@section('title', 'My Cart')

@section('container')

@if (Session::has('cart'))




<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row cart-row">
      <div class="col-md-12 ftco-animate">
        <div id="cart" class="cart-list"> 
          <table id="cart" class="table" >
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>Image</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody class="cart-item">
              
              {{-- @php
              
              dd($products);
              @endphp --}}
              
              
              @foreach ($products as $product)
              
              {{-- @php
                  dd($product['item']->id);
              @endphp --}}
              
              <tr class="text-center">

                <td class="product-remove">
                  <a class="hapus-product" href="{{ route('product.removeCart', ['id' => $product['item']->id])}}"><span class="ion-ios-close"></span></a>
                </td>
                
                <td class="image-prod">
                  <img src="{{asset('storage/'. $product['item']['avatar'])}}" width="100" alt="">
                </td>

                <td class="product-name">
                  <h3>{{$product['item']['product_name']}}</h3>
                </td>
                
                <td class="price">Rp. {{$product['price']}}</td>
                
                <td class="quantity">
                  {{$product['qty']}}
                </td>
                <td class="total">Rp. {{ $product['price'] * $product['qty']}}</td>
              </tr><!-- END TR-->
              
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="row justify-content-end">
        <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">
            <h3>Estimate shipping and tax</h3>
            <p>Enter your destination to get a shipping estimate</p>
            <form action="#" class="info">
              <div class="form-group">
                <label for="">Country</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
              <div class="form-group">
                <label for="country">State/Province</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
              <div class="form-group">
                <label for="country">Zip/Postal Code</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
            </form>
          </div>
          <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
        </div>
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
              <span>Subtotal</span>
              <span>Rp. {{$totalPrice}}</span>
            </p>
            <p class="d-flex">
              <span>Delivery</span>
              <span>$0.00</span>
            </p>
            <p class="d-flex">
              <span>Discount</span>
              <span>$3.00</span>
            </p>
            <hr>
            <p class="d-flex total-price">
              <span>Total</span>
              <span>$17.60</span>
            </p>
          </div>
          <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Checkout</a></p>
        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-6">
        <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
        <span>Get e-mail updates about our latest shops and special offers</span>
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <form action="#" class="subscribe-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control" placeholder="Enter email address">
            <input type="submit" value="Subscribe" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</section> -->
@else

<script>alert('Keranjang belanja kosong, silahkan belanja terlebih dahulu')</script>2

@endif

@endsection