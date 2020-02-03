@extends('layouts/index1')

@section('title', 'My Cart')

@section('container')

<div class="hero-wrap hero-bread" style="background-image: url('https://lunarian-id.com/toko-online/storage/image_banner/light-green-solid-color.jpg');">
  <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
              {{-- <span class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></span> --}}
              <h1 class="mb-0 bread">Keranjang Belanja</h1>
          </div>
      </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row cart-row">
      <div class="col-md-12 ftco-animate">
        <div>
          @if (session()->has('success'))
          <div class="alert alert-success">
            {{session()->get('success')}}
          </div>
          @endif

        </div>
        {{-- @dd($code) --}}

        <a href="{{route('belanja')}}" class="btn btn-primary mt-3 mb-3">Lanjutkan Belanja</a>

        @if (Cart::count() > 0)

        <div id="cart" class="cart-list">
          <table id="cart" class="table" >
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody class="cart-item">

              @foreach (Cart::content() as $item)

              @php
              // dd($item);
              @endphp

              <tr class="text-center">
                <td>
                  {{-- @php
                    $user_id = Auth::user()->id;
                    @endphp --}}
                    {{-- @dd($user_id) --}}
                    <a href="{{route('cart.destroy', $item->rowId)}}" onclick="event.preventDefault();
                      document.getElementById('hapus-form').submit();">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <form id="hapus-form" action="{{route('cart.destroy', $item->rowId)}}" method="POST" style="display: none;">
                      @csrf
                      {{ method_field('DELETE')}}
                      {{-- <button type="submit" style="background-color: white; "><i class="fas fa-trash-alt"></i></button> --}}
                    </form>
                  </td>

                  <td class="image-prod">
                    <img src="{{asset('storage/'. $item->model->avatar)}}" width="100" alt="">
                  </td>

                  <td class="product-name">
                    <a href="{{url('/show', $item->model->id)}}">
                      <h3>{{$item->model->product_name}}</h3>
                    </a>
                  </td>
                  <td>{{$item->qty}}</td>
                  <td class="price">{{$item->model->price}}</td>

                </tr><!-- END TR-->

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">

            <p class="d-flex">
              <span>Sub Total</span>
              <span>Rp. {{number_format(Cart::total())}}</span>
            </p>
          </div>
          <p class="ml-auto"><a href="{{route('checkout.index')}}" class="btn btn-primary py-3 px-4">Checkout</a></p>
        </div>

      </div>
      @elseif (Cart::count() == 0)

      <div class="row justify-content-center">
        <img src="{{asset('images/empty-cart.png')}}" class="img-responsive m-5 w-50">
      </div>


      @endif

    </section>
    {{-- </div> --}}

    @endsection
