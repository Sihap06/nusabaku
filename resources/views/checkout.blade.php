@extends('layouts/index1')

@section('title', 'Checkout')

@section('container')

@php
$data = \DB::table('temp_order')->where('user_id', Auth::user()->id)->get()->all();
foreach ($data as $item) {
  # code...
}
// @dd($item->nama_depan);
$cek = count($data);
@endphp
{{-- @dd($cek) --}}

@if ($cek > 0)

<section class="ftco-section">
  <div class="container">
    <div class="bg-success">
        <p class="text-light p-4">Untuk transaksi menggunakan fitur COD, dengan menggunakan aplikasi whatsapp. Silahkan hubungi nomor <strong>0001-1011-3333</strong> untuk informasi lebih lanjut</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-7 ftco-animate">
        <form action="{{url('cekOngkir')}}" method="POST" class="billing-form">
          @csrf
          <input type="hidden" name="province_origin" value="11">
          <input type="hidden" name="city_origin" id="city_origin" value="160">
          <input type="hidden" name="weight" id="weight" value="{{Cart::instance('default')->count()*1000}}">
          {{-- @dd(Cart::instance('default')->count()*1000) --}}
          <h3 class="mb-4 billing-heading">Data Pemesanan</h3>
          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">Nama Depan</label>
                <input value="{{$item->nama_depan}}" name="nama_depan" type="text" class="form-control is-valid @error('nama_depan') is-invalid @enderror" placeholder="">
                @error('nama_depan') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Nama Belakang</label>
                <input value="{{$item->nama_belakang}}" name="nama_belakang" type="text" class="form-control @error('nama_belakang') is-invalid @enderror" placeholder="">
                @error('nama_belakang') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">No Telepon</label>
                <input value="{{$item->telepon}}" name="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="">
                @error('telepon') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="emailaddress">Alamat Email</label>
                <input value="{{$item->email}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="">
                @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="country">Provinsi</label>
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  @php
                      $provinsi = \DB::table('provinces')->where('province_id', $item->provinsi)->get()->all();
                      foreach ($provinsi as $prov) {
                        # code...
                      }
                      // dd($prov);
                  @endphp
                  <select value="{{$prov->province_id}}" name="province_destination" id="province_destination" class="form-control @error('province_destination') is-invalid @enderror">
                    <option value="{{$prov->province_id}}">{{$prov->title}}</option>
                    @foreach ($provinces as $province => $value)
                    <option value="{{$province}}">{{$value}}</option>
                    @endforeach
                  </select>
                  @error('province_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Kota</label>
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  @php
                      $city = \DB::table('cities')->where('city_id', $item->kota)->get()->all();
                      foreach ($city as $kota) {
                        # code...
                      }
                      // dd($kota);
                  @endphp
                  <select value="{{old('city_destination')}}" name="city_destination" id="city_destination" class="form-control  @error('city_destination') is-invalid @enderror">
                    <option value="{{$kota->city_id}}">{{$kota->title}}</option>
                  </select>
                  @error('city_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Detail Alamat</label>
                <input value="{{$item->alamat}}" name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="House number and street name">
                @error('alamat') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>

            {{-- <div class="col-md-6">
              <div class="form-group">
                <label for="postcodezip">Kode Pos</label>
                <input value="{{$item->kode_pos}}" name="pos" type="text" class="form-control @error('pos') is-invalid @enderror" placeholder="">
                @error('pos') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div> --}}
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group mt-3">
                <div class="form-check">
                  <input class="form-check-input @error('mou') is-invalid @enderror" type="checkbox" value="1" name="mou">
                  <label>
                    Agree to terms and conditions
                  </label>
                  @error('mou') <div class="invalid-feedback">You must agree before submitting.</div> @enderror
                  {{-- <div class="invalid-feedback">
                    You must agree before submitting.
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Place Order</button>
          {{-- <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ongkirModal">Cek Biaya Pengiriman</button> --}}
        </div>
        <div class="col-xl-5">
          <div class="row mt-5 pt-3">
            <div class="col-md-12 mb-3">
              <div class="cart-detail cart-total p-3 p-md-4">
                <h3 class="billing-heading mb-4">Detail Produk</h3>
                @foreach (Cart::content() as $item)

                <input type="hidden" name="id_produk" value="{{$item->model->id}}">
                <input type="hidden" name="qty" value="{{$item->qty}}">
                <input type="hidden" name="harga" value="{{$item->model->price}}">
                <p class="d-flex">
                  <span>{{$item->model->product_name}}</span>
                  <span>{{$item->qty}}</span>
                  <span>Rp. {{number_format($item->model->price)}}</span>
                </p>
                @endforeach
              </div>
            </div>
            <div class="col-md-12">
              <div class="cart-detail cart-total p-3 p-md-4">
                <p class="d-flex total-price">
                  <span>Total</span>
                  <span>Rp. {{Cart::total()}}</span>
                </p>
              </div>
            </div>
          </div>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </form><!-- END -->
</section> <!-- .section -->

@else



<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 ftco-animate">
        <form action="{{url('cekOngkir')}}" method="POST" class="billing-form">
          @csrf
          <input type="hidden" name="province_origin" value="11">
          <input type="hidden" name="city_origin" id="city_origin" value="160">
          <input type="hidden" name="weight" id="weight" value="{{Cart::instance('default')->count()*1000}}">
          {{-- @dd(Cart::instance('default')->count()*1000) --}}
          <h3 class="mb-4 billing-heading">Data Pemesanan</h3>
          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">Nama Depan</label>
                <input value="{{old('nama_depan')}}" name="nama_depan" type="text" class="form-control is-valid @error('nama_depan') is-invalid @enderror" placeholder="">
                @error('nama_depan') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Nama Belakang</label>
                <input value="{{old('nama_belakang')}}" name="nama_belakang" type="text" class="form-control @error('nama_belakang') is-invalid @enderror" placeholder="">
                @error('nama_belakang') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">No Telepon</label>
                <input value="{{old('telepon')}}" name="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="">
                @error('telepon') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="emailaddress">Alamat Email</label>
                <input value="{{old('email')}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="">
                @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="country">Provinsi</label>
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <select value="{{old('province_destination')}}" name="province_destination" id="province_destination" class="form-control @error('province_destination') is-invalid @enderror">
                    <option value="">--Provinsi--</option>
                    @foreach ($provinces as $province => $value)
                    <option value="{{$province}}">{{$value}}</option>
                    @endforeach
                  </select>
                  @error('province_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Kota</label>
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <select value="{{old('city_destination')}}" name="city_destination" id="city_destination" class="form-control  @error('city_destination') is-invalid @enderror">
                    <option>--Kota--</option>
                  </select>
                  @error('city_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Detail Alamat</label>
                <input value="{{old('alamat')}}" name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="House number and street name">
                @error('alamat') <div class="invalid-feedback">{{$message}}</div> @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group mt-3">
                <div class="form-check">
                  <input class="form-check-input @error('mou') is-invalid @enderror" type="checkbox" value="1" name="mou">
                  <label>
                    Agree to terms and conditions
                  </label>
                  @error('mou') <div class="invalid-feedback">You must agree before submitting.</div> @enderror
                  {{-- <div class="invalid-feedback">
                    You must agree before submitting.
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Place Order</button>
          {{-- <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ongkirModal">Cek Biaya Pengiriman</button> --}}
        </div>
        <div class="col-xl-5">
          <div class="row mt-5 pt-3">
            <div class="col-md-12 mb-3">
              <div class="cart-detail cart-total p-3 p-md-4">
                <h3 class="billing-heading mb-4">Detail Produk</h3>
                @foreach (Cart::content() as $item)

                <input type="hidden" name="id_produk" value="{{$item->model->id}}">
                <input type="hidden" name="qty" value="{{$item->qty}}">
                <input type="hidden" name="harga" value="{{$item->model->price}}">
                <p class="d-flex">
                  <span>{{$item->model->product_name}}</span>
                  <span>{{$item->qty}}</span>
                  <span>Rp. {{number_format($item->model->price)}}</span>
                </p>
                @endforeach
              </div>
            </div>
            <div class="col-md-12">
              <div class="cart-detail cart-total p-3 p-md-4">
                <p class="d-flex total-price">
                  <span>Biaya Pengiriman</span>
                  <span>Rp. {{number_format(2000)}}</span>
                </p>
                <p class="d-flex total-price">
                  <span>Total</span>
                  <span>Rp. {{number_format(Cart::total() + 2000)}}</span>
                </p>
              </div>
            </div>
          </div>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </form><!-- END -->
</section> <!-- .section -->

@endif



@endsection

@section('section-footer')
<script>
  $(document).ready(function(){
    $('select[name="province_destination"]').on('change', function(){
      let provinceId = $(this).val();
      // console.log(provinceId);

      if (provinceId) {
        jQuery.ajax({
          url: "{{url('province')}}"+'/'+provinceId+'/cities',
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('select[name="city_destination"]').empty();
            $.each(data, function(key, value) {
              $('select[name="city_destination"]').append('<option value="'+ key +'">'+ value +'</option> ');
            });
          },
        });
      }else {
        $('select[name="city_destination"]').empty();
      }
    });



  });
</script>
@stop
